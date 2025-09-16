# PhoenixFM Authentication System

## 概述

这是一个基于SpeedPHP框架的完整认证系统实现，支持多种登录方式：手机号短信验证码、微信登录和微博登录。系统采用JWT（JSON Web Token）进行用户会话管理，包含完整的安全验证、频率限制和中间件支持。

## 功能特性

### 🔐 多种认证方式
- **手机号SMS登录/注册**: 短信验证码登录和注册
- **微信登录**: 微信扫码登录（OAuth 2.0）
- **微博登录**: 微博授权登录（OAuth 2.0）

### 🛡️ 安全特性
- JWT Token身份认证
- 图形验证码防护
- SMS发送频率限制（1分钟1次，每日10次）
- CSRF防护
- 安全头部设置
- 输入数据验证和清理

### 🚀 其他特性
- Redis缓存支持
- 认证中间件
- 详细的操作日志
- 响应式登录界面
- 完整的测试套件

## 文件结构

```
├── protected/
│   ├── controller/web/
│   │   └── AuthController.php          # 认证控制器
│   ├── include/
│   │   ├── AuthHelper.php              # 认证助手类
│   │   ├── AuthMiddleware.php          # 认证中间件
│   │   └── SmsSendWidthAliyun.php      # 阿里云短信服务
│   ├── config/
│   │   └── auth_config.php             # 认证配置文件
│   ├── model/
│   │   ├── QtUsers.php                 # Qt用户模型
│   │   └── ZdUsers.php                 # Zd用户模型
│   └── sql/
│       └── add_auth_fields.sql         # 数据库迁移文件
├── 网站原型/
│   └── 页面原型首页.html               # 带认证功能的首页原型
└── auth_test.html                      # 认证功能测试页面
```

## 安装配置

### 1. 数据库配置

执行SQL迁移文件添加必要的认证字段：

```bash
mysql -u用户名 -p数据库名 < protected/sql/add_auth_fields.sql
```

### 2. 配置认证参数

编辑 `protected/config/auth_config.php` 文件：

```php
// 微信配置
define('WECHAT_APP_ID', 'your_wechat_app_id');
define('WECHAT_APP_SECRET', 'your_wechat_app_secret');

// 微博配置
define('WEIBO_APP_KEY', 'your_weibo_app_key');
define('WEIBO_APP_SECRET', 'your_weibo_app_secret');

// JWT密钥
define('JWT_SECRET_KEY', 'your-very-secure-jwt-secret-key');
```

### 3. Redis配置

确保Redis服务运行并配置连接参数：

```php
define('REDIS_HOST', '127.0.0.1');
define('REDIS_PORT', 6379);
```

### 4. 阿里云短信配置

在 `protected/include/SmsSendWidthAliyun.php` 中配置：

```php
$config = new Config([
    "accessKeyId" => "your_aliyun_access_key_id",
    "accessKeySecret" => "your_aliyun_access_key_secret"
]);
```

## API接口文档

### 认证相关接口

所有认证接口的基础URL: `/index.php?m=web&c=auth&a={action}`

#### 1. 生成验证码
- **接口**: `generateCaptcha`
- **方法**: GET
- **返回**: PNG图片
- **说明**: 生成4位字符验证码图片

#### 2. 发送注册短信验证码
- **接口**: `sendSmsRegister`
- **方法**: POST
- **参数**:
  - `phone`: 手机号（必填）
  - `captcha`: 图形验证码（必填）
- **返回**:
```json
{
  "status": 0,
  "msg": "验证码已发送，5分钟内有效",
  "data": null
}
```

#### 3. 发送登录短信验证码
- **接口**: `sendSmsLogin`
- **方法**: POST
- **参数**:
  - `phone`: 手机号（必填）
  - `captcha`: 图形验证码（必填）

#### 4. 手机号注册
- **接口**: `smsRegister`
- **方法**: POST
- **参数**:
  - `phone`: 手机号（必填）
  - `sms_code`: 短信验证码（必填）
  - `username`: 用户名（可选）
- **返回**:
```json
{
  "status": 0,
  "msg": "success",
  "data": {
    "token": "jwt_token_string",
    "user": {
      "id": 1,
      "phone": "13800138000",
      "username": "用户名"
    }
  }
}
```

#### 5. 手机号登录
- **接口**: `smsLogin`
- **方法**: POST
- **参数**:
  - `phone`: 手机号（必填）
  - `sms_code`: 短信验证码（必填）

#### 6. 获取微信登录二维码
- **接口**: `getWechatQrCode`
- **方法**: GET
- **返回**:
```json
{
  "status": 0,
  "msg": "success",
  "data": {
    "qr_url": "https://open.weixin.qq.com/connect/qrconnect?...",
    "state": "random_state_string"
  }
}
```

#### 7. 检查微信登录状态
- **接口**: `checkWechatLogin`
- **方法**: GET
- **参数**: `state`: 状态码
- **返回**: 登录成功时返回Token和用户信息

#### 8. 微信登录回调
- **接口**: `wechatCallback`
- **说明**: 微信OAuth回调地址，自动处理

#### 9. 微博登录
- **接口**: `weiboLogin`
- **方法**: GET
- **返回**: 微博授权URL

#### 10. 微博登录回调
- **接口**: `weiboCallback`
- **说明**: 微博OAuth回调地址

#### 11. 验证Token
- **接口**: `verifyToken`
- **方法**: POST
- **参数**: `token`: JWT Token
- **返回**: 用户信息

## 前端集成

### JavaScript示例

```javascript
// 发送短信验证码
async function sendSmsCode(phone, captcha, type) {
  const response = await fetch('/index.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `m=web&c=auth&a=${type === 'login' ? 'sendSmsLogin' : 'sendSmsRegister'}&phone=${phone}&captcha=${captcha}`
  });
  return await response.json();
}

// 手机号登录
async function smsLogin(phone, smsCode) {
  const response = await fetch('/index.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `m=web&c=auth&a=smsLogin&phone=${phone}&sms_code=${smsCode}`
  });
  
  const result = await response.json();
  if (result.status === 0) {
    // 保存Token
    localStorage.setItem('authToken', result.data.token);
    localStorage.setItem('userInfo', JSON.stringify(result.data.user));
  }
  return result;
}

// 微信登录
async function wechatLogin() {
  // 获取二维码
  const qrResponse = await fetch('/index.php?m=web&c=auth&a=getWechatQrCode');
  const qrResult = await qrResponse.json();
  
  if (qrResult.status === 0) {
    // 显示二维码
    showQrCode(qrResult.data.qr_url);
    
    // 轮询登录状态
    pollWechatLogin(qrResult.data.state);
  }
}
```

### 认证中间件使用

```php
// 在需要认证的控制器中使用
require_once(APP_PATH . '/include/AuthMiddleware.php');

class ProtectedController extends Controller {
    
    function actionUserProfile() {
        // 验证用户身份
        $user = AuthMiddleware::verifyToken(true);
        
        // 检查权限
        AuthMiddleware::requirePermission($user, 'user.read');
        
        // 业务逻辑
        success(array('user' => $user));
    }
}
```

## 安全考虑

### 1. 密码安全
- 使用JWT进行无状态认证
- Token过期时间设置为7天
- 敏感信息不存储在Token中

### 2. 防护机制
- 图形验证码防止自动化攻击
- SMS发送频率限制
- 输入数据验证和清理
- CSRF Token验证
- SQL注入防护

### 3. 数据存储
- 不存储明文密码
- Redis存储临时数据（验证码、状态等）
- 用户敏感信息加密存储

## 测试

### 运行测试套件

访问 `auth_test.html` 页面运行完整的测试套件：

1. **SMS认证测试**
   - 验证码生成
   - 短信发送
   - 注册/登录流程

2. **社交登录测试**
   - 微信二维码生成
   - 微博授权URL生成

3. **安全测试**
   - JWT验证
   - 输入验证
   - 频率限制

### 手动测试

1. 配置测试手机号
2. 运行各个测试用例
3. 检查日志输出
4. 验证数据库记录

## 故障排除

### 常见问题

1. **短信发送失败**
   - 检查阿里云SMS配置
   - 验证模板ID和签名
   - 确认账户余额

2. **微信登录失败**
   - 检查AppID和AppSecret
   - 验证回调URL配置
   - 确认域名白名单

3. **Redis连接失败**
   - 检查Redis服务状态
   - 验证连接配置
   - 确认防火墙设置

4. **JWT验证失败**
   - 检查密钥配置
   - 验证Token格式
   - 确认过期时间

### 调试模式

开启详细日志记录：

```php
// 在config.php中添加
define('AUTH_DEBUG', true);
```

查看认证日志：
```bash
tail -f /var/log/php/error.log | grep "Auth Event"
```

## 更新日志

### v1.0.0 (2024-01-25)
- 初始版本发布
- 支持SMS、微信、微博登录
- 完整的安全防护机制
- JWT认证系统
- 认证中间件
- 测试套件

## 许可证

本项目采用MIT许可证，详见LICENSE文件。

## 贡献指南

欢迎提交Issue和Pull Request来改进本项目。

## 联系信息

如有问题，请通过以下方式联系：
- Email: contact@phoenixfm.com
- 项目地址: https://github.com/phoenixfm/auth-system