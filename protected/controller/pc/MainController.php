<?php 
require_once 'vendor/autoload.php';
include 'protected/include/phpqrcode/phpqrcode.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class MainController extends BaseController {
    function __construct(){
        parent::__construct();
    }
    
    /**
     * 首页
     */
	function actionIndex(){
	   
	}

}
