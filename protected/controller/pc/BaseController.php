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
        $this->config = array(
			"default_thumbnail"=>"/i/img/logo.jpg",
			"site_title"=>"火羽Hubird | 智能体开发·AI应用·智能体一站式解决方案平台",
			"site_keywords"=>"智能体平台,AI智能体开发,智能体解决方案,火羽Hubird,智能体推广案例,AI自动化工具,智能体应用教程,智能体技术社区",
			"site_description"=>"火羽Hubird专注智能体开发与AI应用落地，提供智能体解决方案、推广案例、技术教程及开发者社区，助力企业高效实现AI自动化转型。探索前沿智能体技术，立即加入全球创新者行列！",
			"site_generator"=>"Powered by 火羽Hubird",
			"site_author"=>"火羽Hubird",
			"locationurl"=>""
		); 
		$this->getLinks();
		$this->checkToken();
		$this->unread = 0;
		$datetime = new DateTime('now', new DateTimeZone('Europe/Paris'));
		$this->pt = $datetime->format('c');
		$this->_now_time = time();
		$this->doc_user = 'quntui';
		$this->doc_token = md5($this->doc_user.'53e2749225926ae020436999df58881d'.$this->_now_time);
		$agent = $_SERVER['HTTP_USER_AGENT']; 
        if(strpos($agent,"NetFront") || strpos($agent,"iPhone") || strpos($agent,"MIDP-2.0") || strpos($agent,"Opera Mini") || strpos($agent,"UCWEB") || strpos($agent,"Android") || strpos($agent,"Windows CE") || strpos($agent,"SymbianOS")){            
            $this->jump('https://m.phoenixfm.cn');
        }
        $this->hotList="";
        $this->game_tutorial="";
        // ---------------------扩展工具-----------------------
		$ip = getIp();
		$api_ip = "https://qifu-api.baidubce.com/ip/geo/v1/district?ip=".$ip;
		$res_address = sendGet($api_ip);
		$this->wearher = "";
		if(!empty($res_address)){
		    $res_address = json_decode($res_address,true);
		    if($res_address["code"] == "Success"){
		        // 获取天气预报
		        $this->city = $res_address["data"]["city"];
		        $this->prov = $res_address["data"]["prov"];
		        $api_simpleWeather = "http://apis.juhe.cn/simpleWeather/query?city=".urlencode(str_replace("市","",$res_address["data"]["city"]))."&key=f294ec64c69b2ab7b3b9ca1b58719a66";
		        $weather_res = sendGet($api_simpleWeather);
		        if(!empty($weather_res)){
		            $weather_res = json_decode($weather_res,true);
		            if($weather_res["error_code"]/1 == 0){
		                $this->wearher = $weather_res["result"];
		                $this->date_str = date("Y-m-d");
		            }
		        }
		    }
		}
		// 获取网站访问数据
		$this->vistData = $this->getTongjiData();
		$this->getGoldInfo();
		$this->countdownday = false;
		$countdownday = $ZdRedis->get('countdownday');
		if(!empty($countdownday)){
		    $arr_countdownday = json_decode($countdownday,true);
		    if(isset($arr_countdownday) && $arr_countdownday["code"]/1 == 200){
		        $data_list = $arr_countdownday["data"];
		        $this->countdownday = $data_list;
		    }
		}
		
	}
	/**
	 * 获取今日金价信息
	*/
	function getGoldInfo(){
	    $QtGoldData = new QtGoldData();
	    $this->result_gold = $QtGoldData->findAll(array("date"=>date('Y-m-d')));
	}
	/**
     * 获取并且更新网站统计数据
    */
    function getTongjiData(){
        $QtWebsiteTraffic = new QtWebsiteTraffic();
        // 查询本月总量和总访问量
        $this_month_visit_count = $QtWebsiteTraffic->query("SELECT SUM(pv) AS this_month_visit_count
        FROM qt_website_traffic
        WHERE traffic_date >= UNIX_TIMESTAMP(DATE_FORMAT(CURDATE(), '%Y-%m-01')) 
          AND traffic_date < UNIX_TIMESTAMP(DATE_FORMAT(CURDATE() + INTERVAL 1 MONTH, '%Y-%m-01'));");
        $total_visit_count = $QtWebsiteTraffic->query("SELECT SUM(pv) AS total_visit_count
        FROM qt_website_traffic;");
        $totalToday = $QtWebsiteTraffic->query("SELECT SUM(pv) AS today_pv, SUM(uv) AS today_uv
        FROM qt_website_traffic
        WHERE traffic_date >= UNIX_TIMESTAMP(DATE_FORMAT(CURDATE(), '%Y-%m-%d 00:00:00')) 
          AND traffic_date < UNIX_TIMESTAMP(DATE_FORMAT(CURDATE() + INTERVAL 1 DAY, '%Y-%m-%d 00:00:00'));");
        $totalYesterday = $QtWebsiteTraffic->query("SELECT SUM(pv) AS yesterday_pv, SUM(uv) AS yesterday_uv
        FROM qt_website_traffic
        WHERE traffic_date >= UNIX_TIMESTAMP(DATE_FORMAT(CURDATE() - INTERVAL 1 DAY, '%Y-%m-%d 00:00:00')) 
          AND traffic_date < UNIX_TIMESTAMP(DATE_FORMAT(CURDATE(), '%Y-%m-%d 00:00:00'));");
        return array(
            "this_month_visit_count"=>$this_month_visit_count==false?5486:$this_month_visit_count[0]["this_month_visit_count"],
            "total_visit_count"=>$total_visit_count==false?83549:$total_visit_count[0]["total_visit_count"],
            "totalToday"=>array(
                "pv"=>$totalToday==false?0:$totalToday[0]["today_pv"],
                "uv"=>$totalToday==false?0:$totalToday[0]["today_uv"]
             ),
            "totalYesterday"=>array(
                "pv"=>$totalYesterday==false?1698:$totalYesterday[0]["yesterday_pv"],
                "uv"=>$totalYesterday==false?937:$totalYesterday[0]["yesterday_uv"]
             )
        );
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
		$token = isset($_COOKIE["auth_quntui_token"]) ? $_COOKIE["auth_quntui_token"] : "";
		// 测试个人中心
		$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImtpZCI6ImIwOTNlZmI0N2M0YzQ0MWQifQ.eyJpc3MiOiJ3d3cucGhvZW5peGZtLmNuIiwiYXVkIjoid3d3LnBob2VuaXhmbS5jbiIsImlhdCI6MTc1Nzk4ODk4OSwiZXhwIjoxNzU4MDc1Mzg5LCJ1c2VySWQiOiI5NDVBMzM3My1FRkNELTVDMTItODk3Ri1ENDBBRjIzRjM0NTMifQ.ppuTteeSyi_QvjuxVaVo86iRrX0HEljAcrqVWtjzr9s";
		$noAuthChk = ['ajaxsearch','pro','sitemap','userprivacy','legal','terms','getgamebycategory',
		'getminiprogramtags','getofficialstags','getwechatbycategory','getagentcategories',
		'getagentsdata','getagentslist','getarticlelist','404','generatecaptcha','login',
		'sendcode','index','list','details','usernotice','marketcooperation','useragreement',
		'userprivacy','copyrightnotice','sitemap','search','getSearchfeed','loginsina','getqrcode',
		'discovery','agentad','advertisinglaw','helper','question','articles','sendcodeh5','loginfromh5',
		'listimages','downloadimg','converttojson','indexv2','games','playgame','pagetem','tools','hightip',
		'aitranslate','airecognizeimg','stablediffusion','superpower','ipinfo','golddetails','goldlines','maoyan',
		'ruozhiba','textfix','imgpainting','yearsmap','answersbook','imagedistinct','cookbook','car','trademark',
		'randomxjj','storys','storydetails','certificate','brainteasers','drvinglicense','earthquake','getwechatbycategory',
		'getminiprogrambycategory','getgamebycategory','getarticlebycategory','getpromoagents','getregularagents'
		];

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
        		if(empty($this->user["userId"])){
        		    $this->c=0;
        		}else{
        		    $QtShoppingCart = new QtShoppingCart();
                    $user = $qt_users->find(array("userId"=>$this->user["userId"]));
            		$this->c = $QtShoppingCart->findCount(array("user_id"=>$user["id"]));
        		}
			} catch (Exception $e) {
				$this->user = false;
				$this->c = 0;
				// 清理token
				setcookie("auth_quntui_token", '', time() + 86400*30, "/");
				$this->jump(url("pc/main","login"));
			}
		}
	}
	/**
	 * 获取友情链接
	 */
	public function getLinks(){
		$links = new ZdLinks();
		$this->links_txt = $links->findAll(array("linkstatus"=>1,"type"=>1));
		$this->links_img = $links->findAll(array("linkstatus"=>1,"type"=>2));
	}
} 