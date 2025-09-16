<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
define('APP_DIR', realpath('./'));
define("APP_PATH",dirname(__FILE__));
// 开启详细错误报告
error_reporting(E_ALL);
// 开启错误输出到页面
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// 开启日志记录错误
ini_set('log_errors', 1);
// 设置错误日志路径
ini_set('error_log', APP_PATH . '/protected/tmp/php_errors.log');
// 开启HTML错误显示
ini_set('html_errors', 1);

// 自定义错误处理器
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    $error_message = "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;'>";
    $error_message .= "<h3>错误信息:</h3>";
    $error_message .= "<strong>错误类型:</strong> " . $errno . "<br>";
    $error_message .= "<strong>错误消息:</strong> " . $errstr . "<br>";
    $error_message .= "<strong>文件:</strong> " . $errfile . "<br>";
    $error_message .= "<strong>行号:</strong> " . $errline . "<br>";
    $error_message .= "</div>";
    echo $error_message;
    return false; // 继续执行系统错误处理
});

// 自定义异常处理器
set_exception_handler(function($exception) {
    $error_message = "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;'>";
    $error_message .= "<h3>未捕获的异常:</h3>";
    $error_message .= "<strong>异常类型:</strong> " . get_class($exception) . "<br>";
    $error_message .= "<strong>异常消息:</strong> " . $exception->getMessage() . "<br>";
    $error_message .= "<strong>文件:</strong> " . $exception->getFile() . "<br>";
    $error_message .= "<strong>行号:</strong> " . $exception->getLine() . "<br>";
    $error_message .= "<strong>堆栈跟踪:</strong><br><pre>" . $exception->getTraceAsString() . "</pre>";
    $error_message .= "</div>";
    echo $error_message;
});

// 在脚本结束时捕获致命错误
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        $error_message = "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;'>";
        $error_message .= "<h3>致命错误:</h3>";
        $error_message .= "<strong>错误类型:</strong> " . $error['type'] . "<br>";
        $error_message .= "<strong>错误消息:</strong> " . $error['message'] . "<br>";
        $error_message .= "<strong>文件:</strong> " . $error['file'] . "<br>";
        $error_message .= "<strong>行号:</strong> " . $error['line'] . "<br>";
        $error_message .= "</div>";
        echo $error_message;
    }
});
require(APP_DIR.'/protected/lib/speed.php');