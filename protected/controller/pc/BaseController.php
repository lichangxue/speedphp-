<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
class BaseController extends Controller{
	public $layout = "pc/layout.html";
	public $secretKey;
	public $_a;
	function __construct(){
		parent::__construct();
		$ZdRedis = new ZDRedis();
		$this->secretKey = $GLOBALS['JWT_SECRET_KEY'];
        $_a = arg('a');   
		$_c = arg('c');
		$this->t_today = date("m月d日");
		$this->_a = $_a;  
		$this->_c = $_c;
		$this->checkToken();
		
	}
	function init(){
		header("Content-type: text/html; charset=utf-8");
		require(APP_DIR.'/protected/include/functions.php');
		  
	}

    function tips($msg, $url){
    	$url = "location.href=\"{$url}\";";
		echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"{$msg}\");{$url}}</script></head><body onload=\"sptips()\"></body></html>";
		exit;
    }
    
    function jump($url, $delay = 0){
        echo "<html><head><meta http-equiv='refresh' content='{$delay};url={$url}'></head><body></body></html>";
        exit;
    }
    
    
    
	/**
     * 检查Token是否有效
     */
    function checkToken() {		
		// 从cookie中获取token
		$token = isset($_COOKIE["token"]) ? $_COOKIE["token"] : "";
		
		$noAuthChk = [];

		if (empty($token)) {
			if (!in_array(strtolower($this->_a), $noAuthChk) && $this->_c != 'i') {
				
				$this->jump(url("pc/main","login"));
			}
			$this->c = 0;
			$this->user = false;
		}else{
		    
			try {
				$key = new Key($this->secretKey, 'HS256');
				$decoded = JWT::decode($token, array($this->secretKey=>$key));
				$qt_users = new qt_users();
                $user = $qt_users->find(array("userId"=>$decoded->userId));
				$user["reg_time"] = timeToRelativeString($user["reg_time"]);
        		$this->user = $user;
        		
			} catch (Exception $e) {
				$this->user = false;
				$this->c = 0;
				// 清理token
				setcookie("auth_quntui_token", '', time() + 86400*30, "/");
				$this->jump(url("pc/main","login"));
			}
		}
	}
	
} 
