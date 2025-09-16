<?php

date_default_timezone_set('PRC');


$config = array(
	'rewrite' => array(
		'admin/index.html' => 'admin/main/index',
		'admin/<c>_<a>.html' => 'admin/<c>/<a>', 
		'<m>/<c>/<a>.html' => '<m>/<c>/<a>',
		'<m>/<c>/<a>.json' => '<m>/<c>/<a>',
		'<m>/<c>/<a>.xml' => '<m>/<c>/<a>',
		'<c>/<a>.html' => '<c>/<a>',
		'<c>/<a>.xml' => '<c>/<a>',
		'<c>/<a>/id/<id>.html' => '<c>/<a>',
		'/index.html' => 'pc/main/index',
		'/' => 'pc/main/index',
	),
	'redis'=>array(
		'ma'=>array(
			'host'=>'127.0.0.1',
			'port'=>'6379',
			'password'=>'From2020',
			'db'=>'0',
		),
		'ms'=>array(
			'host'=>'127.0.0.1',
			'port'=>'6379',
			'password'=>'From2020',
			'db'=>'1',
		),
	),
	'JWT_SECRET_KEY'=>'b093efb47c4c441d',
	'spLog' => array(
			'logsize'   => '10240000',      // 日志文件大小
			'logpath'   => APP_PATH.'/log', // 日志保存目录
			'logprefix' => 'log_',          // 日志文件前缀’
			'mail'      => 'NULL',           // 是否发送日志邮件，
			// 取值"ALL"是全部日志都发送，取值'ERROR', 'WARN','NOTICE','INFO','DEBUG'任意一种是只发送该种日志，取值NULL是不发送日志
			'mailto'    => '', // 发送到的邮件地址
	),
	'PAY_URL'=>'https://z-pay.cn/',
	'PAY_PID'=>'20240810101214',
	'PAY_KEY'=>'qkO95vByuv7XcVXNgZvYFmbx1zGhRbB7'
);

$domain = array(
	"10.0.2.15:8000" => array( // 调试配置
		'debug' => false,
		'mysql' => array(

				'MYSQL_HOST' => '120.92.102.95',
				'MYSQL_PORT' => '29481',
				'MYSQL_USER' => 'renbencmpp',
				'MYSQL_DB'   => 'phoenixfm',
				'MYSQL_PASS' => 'From2020!!!',
				'MYSQL_CHARSET' => 'utf8mb4',

		),
	),
	"127.0.0.1:8080" => array( // 调试配置
		'debug' => false,
		'mysql' => array(

				'MYSQL_HOST' => '10.0.1.93',
				'MYSQL_PORT' => '3306',
				'MYSQL_USER' => 'renbencmpp',
				'MYSQL_DB'   => 'phoenixfm',
				'MYSQL_PASS' => 'From2020!!!',
				'MYSQL_CHARSET' => 'utf8mb4',

		),
	),
	"127.0.0.1:9225" => array( // 调试配置
		'debug' => true,
		'mysql' => array(

				'MYSQL_HOST' => '27.25.142.26',
				'MYSQL_PORT' => '3306',
				'MYSQL_USER' => 'phoenixfm_cn',
				'MYSQL_DB'   => 'phoenixfm_cn',
				'MYSQL_PASS' => '3b7SiXCWSe8B6pyi',
				'MYSQL_CHARSET' => 'utf8mb4',

		),
	),
	"27.30.79.26:8080" => array( // 调试配置
		'debug' => true,
		'mysql' => array(

				'MYSQL_HOST' => '127.0.0.1',
				'MYSQL_PORT' => '3306',
				'MYSQL_USER' => 'phoenixfm_cn',
				'MYSQL_DB'   => 'phoenixfm_cn',
				'MYSQL_PASS' => '3b7SiXCWSe8B6pyi',
				'MYSQL_CHARSET' => 'utf8mb4',

		),
	),
	"127.0.0.1:8059" => array( // 调试配置
		'debug' => true,
		'mysql' => array(

				'MYSQL_HOST' => '120.92.102.95',
				'MYSQL_PORT' => '29481',
				'MYSQL_USER' => 'renbencmpp',
				'MYSQL_DB'   => 'phoenixfm',
				'MYSQL_PASS' => 'From2020!!!',
				'MYSQL_CHARSET' => 'utf8mb4',

		),
	),
	"quntui.phoenixfm.cn" => array( // 调试配置
		'debug' => false,
		'mysql' => array(

				'MYSQL_HOST' => '120.92.102.95',
				'MYSQL_PORT' => '29481',
				'MYSQL_USER' => 'renbencmpp',
				'MYSQL_DB'   => 'phoenixfm',
				'MYSQL_PASS' => 'From2020!!!',
				'MYSQL_CHARSET' => 'utf8mb4',

		),
	),
	"phoenixfm.cn" => array( // 调试配置
		'debug' => false,
		'mysql' => array(

				'MYSQL_HOST' => '120.92.102.95',
				'MYSQL_PORT' => '29481',
				'MYSQL_USER' => 'renbencmpp',
				'MYSQL_DB'   => 'phoenixfm',
				'MYSQL_PASS' => 'From2020!!!',
				'MYSQL_CHARSET' => 'utf8mb4',

		),
	),
);
// 为了避免开始使用时会不正确配置域名导致程序错误，加入判断
if(empty($domain[$_SERVER["HTTP_HOST"]])) die("配置域名不正确，请确认".$_SERVER["HTTP_HOST"]."的配置是否存在！");

return $domain[$_SERVER["HTTP_HOST"]] + $config;