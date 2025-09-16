<?php
/**
 * Authentication Helper Class
 * Provides utility functions for user authentication, JWT handling, and validation
 */

require_once(APP_PATH . '/config/auth_config.php');
require_once 'vendor/autoload.php';
include 'protected/include/phpqrcode/phpqrcode.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
class AuthHelper {
    
    private static $redis = null;
    
    /**
     * Get Redis connection
     */
    private static function getRedis() {
        if (self::$redis === null) {
            self::$redis = new Redis();
            self::$redis->connect(REDIS_HOST, REDIS_PORT);
            if (!empty(REDIS_PASSWORD)) {
                self::$redis->auth(REDIS_PASSWORD);
            }
        }
        return self::$redis;
    }
    
    /**
     * Validate phone number format
     */
    public static function validatePhone($phone) {
        return preg_match('/^1[3-9]\d{9}$/', $phone);
    }
    
    /**
     * Generate verification code
     */
    public static function generateVerificationCode($length = SMS_CODE_LENGTH) {
        return sprintf("%0{$length}d", mt_rand(0, pow(10, $length) - 1));
    }
    
    /**
     * Check SMS rate limiting
     */
    public static function checkSmsRateLimit($phone) {
        $redis = self::getRedis();
        
        // Check per-minute rate limit
        $rate_key = "sms_rate_" . $phone;
        $last_send = $redis->get($rate_key);
        
        if ($last_send && (time() - $last_send) < SMS_RATE_LIMIT_INTERVAL) {
            return array('allowed' => false, 'message' => '发送验证码过于频繁，请稍后再试');
        }
        
        // Check daily limit
        $daily_key = "sms_daily_" . $phone . "_" . date('Y-m-d');
        $daily_count = $redis->get($daily_key);
        
        if ($daily_count && $daily_count >= SMS_DAILY_LIMIT) {
            return array('allowed' => false, 'message' => '今日验证码发送次数已达上限，请明日再试');
        }
        
        return array('allowed' => true);
    }
    
    /**
     * Store SMS verification code
     */
    public static function storeSmsCode($phone, $code, $type = 'register') {
        $redis = self::getRedis();
        
        // Store verification code
        $code_key = "sms_code_{$type}_" . $phone;
        $redis->setex($code_key, SMS_CODE_EXPIRY, $code);
        
        // Update rate limiting counters
        $rate_key = "sms_rate_" . $phone;
        $redis->setex($rate_key, SMS_RATE_LIMIT_INTERVAL, time());
        
        $daily_key = "sms_daily_" . $phone . "_" . date('Y-m-d');
        $redis->incr($daily_key);
        $redis->expire($daily_key, 86400); // 24 hours
    }
    
    /**
     * Verify SMS code
     */
    public static function verifySmsCode($phone, $code, $type = 'register') {
        $redis = self::getRedis();
        $code_key = "sms_code_{$type}_" . $phone;
        $stored_code = $redis->get($code_key);
        
        if (!$stored_code || $stored_code !== $code) {
            return false;
        }
        
        // Clear the used code
        $redis->del($code_key);
        return true;
    }
    
    /**
     * Generate and store captcha
     */
    public static function generateCaptcha() {
        session_start();
        
        // Generate captcha string
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $captcha = '';
        for ($i = 0; $i < CAPTCHA_LENGTH; $i++) {
            $captcha .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        
        $_SESSION['captcha'] = $captcha;
        $_SESSION['captcha_time'] = time();
        
        return $captcha;
    }
    
    /**
     * Verify captcha
     */
    public static function verifyCaptcha($input) {
        session_start();
        
        if (!isset($_SESSION['captcha']) || !isset($_SESSION['captcha_time'])) {
            return false;
        }
        
        // Check if captcha has expired
        if ((time() - $_SESSION['captcha_time']) > CAPTCHA_EXPIRY) {
            unset($_SESSION['captcha']);
            unset($_SESSION['captcha_time']);
            return false;
        }
        
        $valid = strtolower($input) === strtolower($_SESSION['captcha']);
        
        if ($valid) {
            // Clear captcha after successful verification
            unset($_SESSION['captcha']);
            unset($_SESSION['captcha_time']);
        }
        
        return $valid;
    }
    
    /**
     * Generate JWT token
     */
    public static function generateJWT($payload) {
        $payload['exp'] = time() + JWT_EXPIRE_TIME;
        return JWT::encode($payload, JWT_SECRET_KEY, 'HS256');
    }
    
    /**
     * Verify JWT token
     */
    public static function verifyJWT($token) {
        try {
            return JWT::decode($token, JWT_SECRET_KEY, array('HS256'));
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Store OAuth state for security
     */
    public static function storeOAuthState($state, $type = 'wechat') {
        $redis = self::getRedis();
        $redis->setex("{$type}_state_" . $state, 600, $state); // 10 minutes
    }
    
    /**
     * Verify OAuth state
     */
    public static function verifyOAuthState($state, $type = 'wechat') {
        $redis = self::getRedis();
        $stored_state = $redis->get("{$type}_state_" . $state);
        
        if ($stored_state && $stored_state === $state) {
            $redis->del("{$type}_state_" . $state);
            return true;
        }
        
        return false;
    }
    
    /**
     * Store login result for polling (WeChat QR code login)
     */
    public static function storeLoginResult($state, $data) {
        $redis = self::getRedis();
        $redis->setex("wechat_login_" . $state, 300, json_encode($data)); // 5 minutes
    }
    
    /**
     * Get login result for polling
     */
    public static function getLoginResult($state) {
        $redis = self::getRedis();
        $data = $redis->get("wechat_login_" . $state);
        
        if ($data) {
            $redis->del("wechat_login_" . $state);
            return json_decode($data, true);
        }
        
        return null;
    }
    
    /**
     * CURL helper for OAuth requests
     */
    public static function curlRequest($url, $data = null, $method = 'GET') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        if ($method === 'POST' && $data) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? http_build_query($data) : $data);
        }
        
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code !== 200) {
            throw new Exception("HTTP request failed with code: " . $http_code);
        }
        
        return $result;
    }
    
    /**
     * Sanitize user input
     */
    public static function sanitizeInput($input, $type = 'string') {
        switch ($type) {
            case 'phone':
                return preg_replace('/[^0-9]/', '', $input);
            case 'username':
                return trim(strip_tags($input));
            case 'email':
                return filter_var($input, FILTER_SANITIZE_EMAIL);
            default:
                return trim(strip_tags($input));
        }
    }
    
    /**
     * Log authentication events
     */
    public static function logAuthEvent($user_id, $event, $details = array()) {
        $log_data = array(
            'user_id' => $user_id,
            'event' => $event,
            'details' => json_encode($details),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'timestamp' => time()
        );
        
        // You can implement your logging mechanism here
        // For now, we'll use error_log
        error_log("Auth Event: " . json_encode($log_data));
    }
    
    /**
     * Generate secure random state for OAuth
     */
    public static function generateSecureState() {
        return md5(uniqid(mt_rand(), true) . time());
    }
    
    /**
     * Get user by different identifiers
     */
    public static function getUserBy($field, $value, $table = 'qt_users') {
        $allowed_fields = array('id', 'phone', 'wechat_openid', 'weibo_uid', 'username', 'email');
        
        if (!in_array($field, $allowed_fields)) {
            return false;
        }
        
        $model_class = $table === 'qt_users' ? 'QtUsers' : 'ZdUsers';
        
        if (!class_exists($model_class)) {
            return false;
        }
        
        $model = new $model_class();
        return $model->find(array($field => $value));
    }
    
    /**
     * Create new user
     */
    public static function createUser($data, $table = 'qt_users') {
        $model_class = $table === 'qt_users' ? 'QtUsers' : 'ZdUsers';
        
        if (!class_exists($model_class)) {
            return false;
        }
        
        // Set default values
        $defaults = array(
            'status' => 1,
            'register_time' => $table === 'qt_users' ? time() : date('Y-m-d H:i:s'),
            'last_login_time' => $table === 'qt_users' ? time() : date('Y-m-d H:i:s')
        );
        
        $data = array_merge($defaults, $data);
        
        $model = new $model_class();
        $userId = $model->create($data);
        
        // 如果用户创建成功，处理推荐关系
        if ($userId) {
            // 引入推荐处理脚本
            require_once APP_PATH . '/../referral_process.php';
            processReferralRegistration($userId);
        }
        
        return $userId;
    }
    
    /**
     * Update user last login time
     */
    public static function updateLastLogin($user_id, $table = 'qt_users') {
        $model_class = $table === 'qt_users' ? 'QtUsers' : 'ZdUsers';
        
        if (!class_exists($model_class)) {
            return false;
        }
        
        $update_data = array(
            'last_login_time' => $table === 'qt_users' ? time() : date('Y-m-d H:i:s')
        );
        
        $model = new $model_class();
        return $model->update(array('id' => $user_id), $update_data);
    }
}