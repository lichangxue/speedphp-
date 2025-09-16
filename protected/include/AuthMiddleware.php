<?php
/**
 * Authentication Middleware
 * Handles JWT token verification and session management
 */

require_once(APP_PATH . '/include/AuthHelper.php');
require_once(APP_PATH . '/config/auth_config.php');

class AuthMiddleware {
    
    /**
     * Verify JWT token from request
     */
    public static function verifyToken($required = true) {
        $token = self::getTokenFromRequest();
        
        if (!$token) {
            if ($required) {
                self::sendUnauthorizedResponse('Token缺失');
            }
            return null;
        }
        
        $payload = AuthHelper::verifyJWT($token);
        
        if (!$payload) {
            if ($required) {
                self::sendUnauthorizedResponse('Token无效或已过期');
            }
            return null;
        }
        
        // Get user info
        $user_id = $payload->userId;
        $user = AuthHelper::getUserBy('id', $user_id);
        
        if (!$user) {
            if ($required) {
                self::sendUnauthorizedResponse('用户不存在');
            }
            return null;
        }
        
        if ($user['status'] != 1) {
            if ($required) {
                self::sendUnauthorizedResponse('账户已被禁用');
            }
            return null;
        }
        
        return $user;
    }
    
    /**
     * Get token from request headers or parameters
     */
    private static function getTokenFromRequest() {
        // Try Authorization header first
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $auth_header = $_SERVER['HTTP_AUTHORIZATION'];
            if (preg_match('/Bearer\s+(.*)$/i', $auth_header, $matches)) {
                return $matches[1];
            }
        }
        
        // Try X-Auth-Token header
        if (isset($_SERVER['HTTP_X_AUTH_TOKEN'])) {
            return $_SERVER['HTTP_X_AUTH_TOKEN'];
        }
        
        // Try token parameter
        if (isset($_POST['token'])) {
            return $_POST['token'];
        }
        
        if (isset($_GET['token'])) {
            return $_GET['token'];
        }
        
        return null;
    }
    
    /**
     * Send unauthorized response
     */
    private static function sendUnauthorizedResponse($message = '未授权访问') {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => 401,
            'msg' => $message,
            'data' => null
        ));
        exit;
    }
    
    /**
     * Check if user has specific permission
     */
    public static function checkPermission($user, $permission) {
        // For now, we'll implement basic role-based permissions
        // You can extend this based on your requirements
        
        if (!$user) {
            return false;
        }
        
        // Admin users have all permissions
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        
        // Check user-specific permissions
        // This is a placeholder - implement your permission system
        switch ($permission) {
            case 'user.read':
            case 'user.update':
                return true; // All authenticated users can read/update their profile
            
            case 'admin.access':
                return isset($user['role']) && in_array($user['role'], array('admin', 'moderator'));
            
            default:
                return false;
        }
    }
    
    /**
     * Require specific permission
     */
    public static function requirePermission($user, $permission) {
        if (!self::checkPermission($user, $permission)) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(array(
                'status' => 403,
                'msg' => '权限不足',
                'data' => null
            ));
            exit;
        }
    }
    
    /**
     * Get current user from session/token
     */
    public static function getCurrentUser($required = false) {
        return self::verifyToken($required);
    }
    
    /**
     * Login user (set session/token)
     */
    public static function loginUser($user) {
        // Generate JWT token
        $jwt_payload = array(
            'userId' => $user['id'],
            'phone' => $user['phone'],
            'username' => $user['username']
        );
        
        // Add social identifiers if present
        if (isset($user['wechat_openid'])) {
            $jwt_payload['wechat_openid'] = $user['wechat_openid'];
        }
        
        if (isset($user['weibo_uid'])) {
            $jwt_payload['weibo_uid'] = $user['weibo_uid'];
        }
        
        $token = AuthHelper::generateJWT($jwt_payload);
        
        // Log login event
        AuthHelper::logAuthEvent($user['id'], 'login_success', array(
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ));
        
        return $token;
    }
    
    /**
     * Logout user (invalidate session/token)
     */
    public static function logoutUser($user_id = null) {
        if (!$user_id) {
            $user = self::getCurrentUser();
            $user_id = $user ? $user['id'] : null;
        }
        
        if ($user_id) {
            AuthHelper::logAuthEvent($user_id, 'logout', array(
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
            ));
        }
        
        // For JWT, we can't invalidate tokens on server side without a blacklist
        // In a production environment, you might want to implement token blacklisting
        return true;
    }
    
    /**
     * Refresh token
     */
    public static function refreshToken($user) {
        return self::loginUser($user);
    }
    
    /**
     * Check if request is from authenticated user
     */
    public static function isAuthenticated() {
        $user = self::verifyToken(false);
        return $user !== null;
    }
    
    /**
     * Rate limiting middleware
     */
    public static function rateLimit($key, $limit = 60, $window = 60) {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        
        $current = $redis->get($key);
        
        if ($current === false) {
            // First request
            $redis->setex($key, $window, 1);
            return true;
        }
        
        if ($current >= $limit) {
            // Rate limit exceeded
            return false;
        }
        
        // Increment counter
        $redis->incr($key);
        return true;
    }
    
    /**
     * Apply rate limiting with error response
     */
    public static function applyRateLimit($key, $limit = 60, $window = 60, $message = '请求过于频繁，请稍后再试') {
        if (!self::rateLimit($key, $limit, $window)) {
            http_response_code(429);
            header('Content-Type: application/json');
            echo json_encode(array(
                'status' => 429,
                'msg' => $message,
                'data' => null
            ));
            exit;
        }
    }
    
    /**
     * CORS headers for API requests
     */
    public static function setCorsHeaders() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Auth-Token");
        
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }
    
    /**
     * Security headers
     */
    public static function setSecurityHeaders() {
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("Referrer-Policy: strict-origin-when-cross-origin");
    }
    
    /**
     * Initialize authentication middleware
     */
    public static function init() {
        self::setCorsHeaders();
        self::setSecurityHeaders();
    }
}