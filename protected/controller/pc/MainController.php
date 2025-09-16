<?php 
require_once 'vendor/autoload.php';
include 'protected/include/phpqrcode/phpqrcode.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
/**
 * 内容类型
 */
class ContentType {
    const gzh = '公众号';
    const xcx = '小程序';
    const xyx = '小游戏';
    const agent = '智能体';
    const video = '视频';
    const audio = '音频';
    const article = '文章';
    const wxq = '微信群';
    const news = '新闻';
    const story = '故事';
    const book = '书籍';
    const course = '课程';
    const image = '图片';
    const podcast = '播客';
    const gs_article = '文章';
    
    // 私有化构造函数，防止实例化
    private function __construct() {}
    
    // 禁止克隆
    private function __clone() {}
    
    // 获取所有状态
    public static function getAll() {
        return [
            self::gzh,
            self::xcx,
            self::xyx,
            self::agent,
            self::video,
            self::audio,
            self::article,
            self::wxq,
            self::news,
            self::story,
            self::book,
            self::course,
            self::image,
            self::podcast,
            self::gs_article,
        ];
    }
}
/**
 * 内容类型颜色
 */
class ContentTypeColor {
    const gzh = 'ax-success';
    const xcx = 'ax-primary';
    const xyx = 'ax-warning';
    const agent = 'ax-info';
    const video = 'ax-error';
    const audio = 'ax-question';
    const article = 'ax-text';
    const wxq = 'ax-ignore';
    const news = 'ax-success';
    const story = 'ax-primary';
    const book = 'ax-warning';
    const course = 'ax-info';
    const image = 'ax-question';
    const podcast = 'ax-text';
    const gs_article = 'ax-success';
    
    // 私有化构造函数，防止实例化
    private function __construct() {}
    
    // 禁止克隆
    private function __clone() {}
    
    // 获取所有状态
    public static function getAll() {
        return [
            self::gzh,
            self::xcx,
            self::xyx,
            self::agent,
            self::video,
            self::audio,
            self::article,
            self::wxq,
            self::news,
            self::story,
            self::book,
            self::course,
            self::image,
            self::podcast,
            self::gs_article,
        ];
    }
}
class MainController extends BaseController {
    function __construct(){
        parent::__construct();
    }
    // 在线小工具集合
    function actionTools(){
        $this->config["site_keywords"] = "火羽Hubird，小游戏网站，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，免费使用";
    }
    // 高精度IP信息查询
    function actionHightIp(){
        $this->config["site_keywords"] = "火羽Hubird，高精度IP信息查询，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，高精度IP信息查询";
    }
    // AI超级翻译
    function actionAiTranslate(){
        $this->config["site_keywords"] = "火羽Hubird，AI超级翻译，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，AI超级翻译";
    }
    // AI识图
    function actionAirecognizeimg(){
        $this->config["site_keywords"] = "火羽Hubird，AI识图，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，AI识图";
    }
    // AI绘图
    function actionstablediffusion(){
        $this->config["site_keywords"] = "火羽Hubird，AI绘图，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，AI绘图";
    }
    // 超能力生成
    function actionsuperpower(){
        $this->config["site_keywords"] = "火羽Hubird，超能力生成，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，超能力生成";
    }
    // 查询IP详情
    function actionipinfo(){
        $this->config["site_keywords"] = "火羽Hubird，查询IP详情，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，查询IP详情";
    }
    // 历史人物信息
    function actionyearsmap(){
        $this->config["site_keywords"] = "火羽Hubird，历史人物信息，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，历史人物信息";
    }
    // 金价详情
    function actiongolddetails(){
        $QtGoldData = new QtGoldData();
        $this->find_today = $QtGoldData->findAll(array("date"=>date("Y-m-d")));
        $this->config["site_keywords"] = "火羽Hubird，金价详情，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，金价详情";
    }
    // 猫眼实时票房
    function actionmaoyan(){
        $this->config["site_keywords"] = "火羽Hubird，猫眼实时票房，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，猫眼实时票房";
    }
    // 弱智吧
    function actionruozhiba(){
        $this->config["site_keywords"] = "火羽Hubird，弱智吧，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，弱智吧";
    }
    // 修复Unicode解码错误的文本
    function actiontextfix(){
        $this->config["site_keywords"] = "火羽Hubird，修复Unicode解码错误的文本，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，修复Unicode解码错误的文本";
    }
    // 将图片转换为Ascii字符画返回
    function actionimgpainting(){
        $this->config["site_keywords"] = "火羽Hubird，将图片转换为Ascii字符画返回，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，将图片转换为Ascii字符画返回";
    }
    // 金价图表
    function actiongoldlines(){
        $this->layout="";
        $this->title = arg('title');
        $this->field = arg('field');
        $this->_dir = arg('dir');
        $this->config["site_keywords"] = "火羽Hubird，金价图表，在线小游戏，休闲小游戏，益智小游戏，在线工具，开发工具，IP详情，AI绘图，AI搜索，AI绘图";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小工具频道！这里汇聚各类常用工具，休闲娱乐工具，AI工具。如IP信息查询、AI搜索、AI绘图、开发工具等。";
		$this->config["site_title"] = "火羽Hubird，在线小工具频道，工具箱，金价图表";
    }
    // 答案之书
    function actionanswersbook(){
        $this->config["site_keywords"] = "火羽Hubird，答案之书，人生答案，困惑解答，心灵指引，随机启示，决策辅助";
		$this->config["site_description"] = "答案之书网页，为你提供独特的心灵指引。当你面临生活困惑、难以抉择时，来这里开启随机探索，获取意想不到的答案，让答案之书成为你寻找人生方向、解开内心纠结的得力助手。";
		$this->config["site_title"] = "火羽Hubird，答案之书 - 探寻生活困惑，获取心灵指引";
    }
    // 通过用户传入的图像文件或者JsonPost的图像链接进行AI图片变清晰操作
    function actionimagedistinct(){
        $this->config["site_keywords"] = "火羽Hubird，AI 图片变清晰，智能图像增强，模糊照片修复，高清图片转换，图片清晰度提升";
		$this->config["site_description"] = "还在为模糊图片而烦恼？我们的网页利用前沿 AI 技术，无论是老照片的模糊细节，还是拍摄失误的低清图像，只要上传，即可一键完成图片清晰化处理，让每一张图片都能呈现出高分辨率的视觉效果，轻松解决图像模糊难题。";
		$this->config["site_title"] = "火羽Hubird，AI 赋能，一键高清！轻松实现图片清晰蜕变";
    }
    // 菜谱查询
    function actioncookbook(){
        $this->config["site_keywords"] = "火羽Hubird，菜谱查询，美食菜谱，烹饪食谱，菜谱搜索，家常菜谱，特色菜谱，菜谱大全";
		$this->config["site_description"] = "欢迎来到菜谱查询网页，这里汇聚海量美食菜谱，涵盖家常小菜、地方特色、中西式大餐等各种类型。无论你是烹饪新手还是资深大厨，只需轻松输入关键词，即可快速搜索到心仪的菜谱，获取详细的食材清单、烹饪步骤和技巧，助你轻松打造美味佳肴，开启美食之旅。";
		$this->config["site_title"] = "火羽Hubird，寻味之旅：菜谱查询，探索万千美食秘籍";
    }
    // 车辆信息查询
    function actioncar(){
        $this->config["site_keywords"] = "火羽Hubird，车辆信息查询，车牌查询，车架号查询，车辆违章查询，车辆年检查询，车辆保险查询，车辆基本信息查询";
		$this->config["site_description"] = "欢迎来到专业的车辆信息查询！无论您是车主还是购车者，我们都能为您提供便捷、高效的车辆信息查询服务。只需输入车牌号码、车架号等相关信息，即可快速获取车辆的违章记录、年检状态、保险详情、基本参数等全方位数据，帮助您轻松掌握车辆状况，为您的出行和决策提供有力支持。";
		$this->config["site_title"] = "火羽Hubird，车辆信息查询 - 一键获取全面、精准的爱车数据";
    }
    // 商标查询
    function actiontrademark(){
        $this->config["site_keywords"] = "火羽Hubird，商标查询，商标信息检索，商标注册查询，商标状态查询，商标类别查询，商标近似查询";
		$this->config["site_description"] = "欢迎来到专业的商标查询，我们提供一站式商标查询服务。在这里，你能凭借简单操作，快速精准检索商标注册信息、商标状态、类别划分以及近似商标比对 ，无论是企业布局商标战略，还是个人了解品牌权益，都能轻松获取所需信息，为你的品牌发展保驾护航。";
		$this->config["site_title"] = "火羽Hubird，快速商标查询，解锁品牌专属标识详情";
    }
    // 随机返回小姐姐视频
    function actionrandomxjj(){
        $this->config["site_keywords"] = "火羽Hubird，随机小姐姐视频，美女视频，趣味视频，短视频，随机视频，生活分享视频，时尚视频";
		$this->config["site_description"] = "致力于为你打造独特的视频体验，通过随机算法，精准推送小姐姐们的魅力视频。不管你是想放松心情，还是寻找生活灵感，这里都能让你在不经意间发现美好，沉浸在小姐姐们带来的多彩世界里，享受每一个随机的精彩瞬间。";
		$this->config["site_title"] = "火羽Hubird，邂逅惊喜！随机刷出小姐姐的精彩视频";
    }
    // 藏头诗生成
    function actionpoem_generate(){
        $this->config["site_keywords"] = "火羽Hubird，随机小姐姐视频，美女视频，趣味视频，短视频，随机视频，生活分享视频，时尚视频";
		$this->config["site_description"] = "致力于为你打造独特的视频体验，通过随机算法，精准推送小姐姐们的魅力视频。不管你是想放松心情，还是寻找生活灵感，这里都能让你在不经意间发现美好，沉浸在小姐姐们带来的多彩世界里，享受每一个随机的精彩瞬间。";
		$this->config["site_title"] = "火羽Hubird，邂逅惊喜！随机刷出小姐姐的精彩视频";
    }
    // 在线证书生成器
    function actioncertificate(){
        $this->config["site_keywords"] = "火羽Hubird，在线证书生成器，奇怪证书定制，趣味奖状制作，奇葩证书，创意证书生成";
		$this->config["site_description"] = "欢迎来到我们的在线证书生成器！在这里，你能随心所欲地定制各种奇怪证书，比如 “最佳摸鱼奖” 等。只需输入姓名、奖项名称及描述，就能快速生成专属的独特证书，为生活增添别样乐趣，快来体验创意证书制作的奇妙之旅吧。";
		$this->config["site_title"] = "火羽Hubird，创意证书轻松做：打造各类奇怪证书，乐趣无限";
    }
    // 脑筋急转弯
    function actionbrainteasers(){
        $this->config["site_keywords"] = "火羽Hubird，脑筋急转弯,趣味问答,在线挑战,音效互动";
		$this->config["site_description"] = "快来参与脑筋急转弯大冒险，通过接口获取题目挑战思维，还有趣味音效哦！";
		$this->config["site_title"] = "火羽Hubird，脑筋急转弯大冒险";
    }
    // 包含科目一，科目四总计5264道题库的题库搜索
    function actiondrvinglicense(){
        $this->config["site_keywords"] = "火羽Hubird，科目一题库,科目四题库,驾照考试题库,在线题库搜索,科目一答案,科目四答案,安全文明驾驶常识,驾考模拟题";
		$this->config["site_description"] = "火羽Hubird，提供科目一、科目四全5264道官方题库智能搜索，支持关键词快速定位题目。每题含标准答案、选项解析及安全文明驾驶常识，助您高效备考！页面采用炫酷科技感设计，支持响应式布局，适配多端设备。";
		$this->config["site_title"] = "火羽Hubird，科目一/科目四5264道题库智能搜索 - 驾照考试高效备考";
    }
    // 查询全球地震信息
    function actionearthquake(){
        $this->config["site_keywords"] = "火羽Hubird，全球地震查询,实时地震数据,震级查询,地震时间,经纬度定位,地震深度,地震位置信息,地震监测API,地震预警";
		$this->config["site_description"] = "火羽Hubird，提供全球范围内最新地震数据实时查询，涵盖震级、时间、经纬度、深度及详细位置信息。页面采用科技感动态设计，支持数据实时刷新，助您快速掌握地震动态。数据来源于官方API，精准可靠。";
		$this->config["site_title"] = "火羽Hubird，全球地震实时监测 - 震级/时间/经纬度/深度动态追踪（最新50条）";
    }
    // 用户积分
    function actionpoints(){
        // 查询累计获得的积分、累计消费的积分
        $qt_points_log = new QtPointsLog();
        $points_earn = $qt_points_log->query("select sum(points) as sum_points from qt_points_log where type in('earn','income') and user_id = " . $this->user["id"]);
        $points_spend = $qt_points_log->query("select sum(points) as sum_points from qt_points_log where type in('spend') and user_id = " . $this->user["id"]);
        $this->pe = empty($points_earn[0]['sum_points'])?0:$points_earn[0]['sum_points'];
        $this->ps = empty($points_spend[0]['sum_points'])?0:$points_spend[0]['sum_points'];
        
        // 检查用户当天是否已签到
        $QtSigns = new QtSigns();
        $today = strtotime(date("Y-m-d"));
        $count = $QtSigns->findCount(array("sign_in_date" => $today, "user_id" => $this->user["id"]));
        $this->isSignedToday = $count > 0;
        
        // 检查用户是否已完善个人信息（手机号、QQ号、Email）
        $this->isProfileComplete = false;
        if (!empty($this->user["phone"]) && !empty($this->user["qq"]) && !empty($this->user["email"])) {
            $this->isProfileComplete = true;
        }
        
        // 检查用户是否已领取完善个人信息奖励
        $this->isProfileRewardClaimed = false;
        if ($this->isProfileComplete) {
            $rewardExists = $qt_points_log->find(array(
                "user_id" => $this->user["id"],
                "type" => "earn",
                "description" => "完善个人信息奖励"
            ));
            if ($rewardExists) {
                $this->isProfileRewardClaimed = true;
            }
        }
        
        $this->display("pc/user_points.html");
    }

    /**
     * 分页页码展示
    */
    function generatePagination($totalRecords, $perPage, $currentPage, $baseUrl) {
        // 计算总页数
        $totalPages = ceil($totalRecords / $perPage);
        // 确保当前页码在有效范围内
        if ($currentPage < 1) {
            $currentPage = 1;
        } elseif ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        // 初始化分页 HTML
        $paginationHtml = '<div class="ax-pagination">';
        // 显示总记录数
        $paginationHtml .= '<a class="ax-total">共' . $totalRecords . '条</a>';
        // 上一页链接
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            $paginationHtml .= '<a href="' . $baseUrl . '?page=' . $prevPage . '" class="ax-prev">上一页</a>';
        } else {
            $paginationHtml .= '<a href="###" class="ax-prev disabled">上一页</a>';
        }
        // 计算起始页码和结束页码
        $startPage = max(1, $currentPage - 1);
        $endPage = min($totalPages, $currentPage + 4);
        // 显示页码链接
        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($i == $currentPage) {
                $paginationHtml .= '<a class="ax-active">' . $i . '</a>';
            } else {
                $paginationHtml .= '<a href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a>';
            }
        }
        // 下一页链接
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $paginationHtml .= '<a href="' . $baseUrl . '?page=' . $nextPage . '" class="ax-next">下一页</a>';
        } else {
            $paginationHtml .= '<a href="###" class="ax-next disabled">下一页</a>';
        }
        // 尾页链接
        if ($currentPage < $totalPages) {
            $paginationHtml .= '<a href="' . $baseUrl . '?page=' . $totalPages . '" class="ax-last">尾页</a>';
        } else {
            $paginationHtml .= '<a href="###" class="ax-last disabled">尾页</a>';
        }
        $paginationHtml .= '</div>';
        return $paginationHtml;
    }
    
    /**
     * 故事详情页面
    */
    function actionStoryDetails(){
        $id = arg("id",0);
        if($id == 0){
            $this->tips('故事已经下架或删除',url("pc/main","storys"));
        }
        $sendJson = array(
            "lingo"=>"zh-CN",
            "id"=>$id,
            "token"=>"ombYk2cL7Rvn7X2GJkZjV7t7lqk9IbVJw2HvBTQeAy8CbybLoTxEgoEKpbHUiVQC",
            "userId"=>""
        );
        $r = http_post_json("https://aiapi.renbenzhihui.com/api/story/getStory",json_encode($sendJson));
        if(!empty($r)){
            $res = json_decode($r[1],true);
            $this->result = $res["data"];
        }else{
            $this->result = false;
        }
        $QtSources= new QtSources();
        $sql = "SELECT * FROM qt_sources WHERE content_type='agent' AND content_status=1 ORDER BY dialogue_count desc,user_nums desc LIMIT 15";		
		$ranks = $QtSources->query($sql); 
		foreach($ranks as $k=>$v){
			$ranks[$k]["thumbnail"] = !empty($v["thumbnail"])?json_decode($v["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));
			$thumbnail = $ranks[$k]["thumbnail"];
			
			if(!empty($thumbnail) && count($thumbnail)){
				$ranks[$k]["thumbnail"] = $thumbnail[0]["img"];
			}else{
				$ranks[$k]["thumbnail"] = $this->config["default_thumbnail"];
			}
			
		}
		$this->ranks = $ranks;
    }
    /**
     * 绘本故事列表
    */
    function actionstorys(){
        $page = arg("page",1);
        $sendJson = array(
            "lingo"=>"zh-CN",
            "page"=>$page,
            "perPage"=>22,
            "sortType"=>1,
            "themeId"=>0,
            "token"=>"ombYk2cL7Rvn7X2GJkZjV7t7lqk9IbVJw2HvBTQeAy8CbybLoTxEgoEKpbHUiVQC",
            "userId"=>""
        );
        $r = http_post_json("https://aiapi.renbenzhihui.com/api/story/listStory",json_encode($sendJson));
        
        if(!empty($r)){
            $res = json_decode($r[1],true);
            $this->result = $res["data"]["list"];
            $total = $res["data"]["total"];
            $this->pagehtml = $this->generatePagination($total,20,$page,url("pc/main","storys"));
            
        }else{
            $this->result = false;
            $this->total = 0;
        }
        
    }
    // 小游戏模版页面
    function actionPageTem(){
        $QtGames = new QtGames();
        $id = arg("id","");
        $result = $QtGames->find(array("game_id"=>$id));
        if($result == false){
            error("小游戏已经下线");
        }
        $this->config["site_keywords"] = empty($result["page_keywords"])?"小游戏网站，在线小游戏，休闲小游戏，益智小游戏，俄罗斯方块，推箱子，碎片时间游戏，解压小游戏，手机小游戏，电脑小游戏":$result["page_keywords"];
		$this->config["site_description"] = empty($result["page_description"])?"欢迎来到超有趣的火羽Hubird小游戏频道！这里汇聚各类经典与潮流小游戏，如俄罗斯方块、推箱子等。无需下载，即点即玩，适配电脑、手机等多终端，随时随地开启欢乐时光。简单易上手，兼具益智、休闲、解压属性，满足不同年龄段玩家需求，是您打发碎片时间、放松身心的绝佳选择。":$result["page_description"];
		$this->config["site_title"] = empty($result["page_title"])?"火羽Hubird，在线小游戏频道，免费畅玩":$result["page_title"];
		$this->result = $result;
		$this->game_tutorial=$result["game_tutorial"];
		$this->_game_file = "games/".$result["game_link"];
		$this->layout = "";
		$this->display("games/playgame.html");
    }
    // 小游戏列表
    function actionGames(){
        $QtGames = new QtGames();
		$this->config["site_keywords"] = "小游戏网站，在线小游戏，休闲小游戏，益智小游戏，俄罗斯方块，推箱子，碎片时间游戏，解压小游戏，手机小游戏，电脑小游戏";
		$this->config["site_description"] = "欢迎来到超有趣的火羽Hubird小游戏频道！这里汇聚各类经典与潮流小游戏，如俄罗斯方块、推箱子等。无需下载，即点即玩，适配电脑、手机等多终端，随时随地开启欢乐时光。简单易上手，兼具益智、休闲、解压属性，满足不同年龄段玩家需求，是您打发碎片时间、放松身心的绝佳选择。";
        $result = $QtGames->findAll(array("game_status"=>1));
        $resultlist = [];
        foreach ($result as $item){
            $arr_tags = explode(",",$item["game_tags"]);
            $tags = "";
            foreach ($arr_tags as $tag){
                if(empty($tags)){
                    $tags = $tag;
                }else{
                    $tags .= "<i>".$tag."</i>";
                }
            }
            $item["game_tags"] = $tags;
            array_push($resultlist,$item);
        }
        
        $this->resultlist = $resultlist;
        
    }
    // 玩游戏
    function actionPlayGame(){
        $QtGames = new QtGames();
        $id = arg("id","");
        $result = $QtGames->find(array("game_id"=>$id));
        if($result == false){
            error("小游戏已经下线");
        }
        $this->config["site_keywords"] = empty($result["page_keywords"])?"小游戏网站，在线小游戏，休闲小游戏，益智小游戏，俄罗斯方块，推箱子，碎片时间游戏，解压小游戏，手机小游戏，电脑小游戏":$result["page_keywords"];
		$this->config["site_description"] = empty($result["page_description"])?"欢迎来到超有趣的火羽Hubird小游戏频道！这里汇聚各类经典与潮流小游戏，如俄罗斯方块、推箱子等。无需下载，即点即玩，适配电脑、手机等多终端，随时随地开启欢乐时光。简单易上手，兼具益智、休闲、解压属性，满足不同年龄段玩家需求，是您打发碎片时间、放松身心的绝佳选择。":$result["page_description"];
		$this->config["site_title"] = empty($result["page_title"])?"火羽Hubird，在线小游戏频道，免费畅玩":$result["page_title"];
		$this->result = $result;
		$this->game_tutorial=$result["game_tutorial"];
		$this->id = $id;
    }
    function actionConvertToJson() {
        $dom = new DOMDocument();
        $dom->loadHTMLFile($_SERVER["DOCUMENT_ROOT"].'/i/xs.txt');
    
        $table = $dom->getElementsByTagName('table')->item(0);
        $tbody = $table->getElementsByTagName('tbody')->item(0);
    
        $data = [];
        $openwinUrls = [];
        $openwin1Urls = [];
    
        $rows = $tbody->getElementsByTagName('tr');
        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');
            $rowData = [];
            $index = 0;
            foreach ($cells as $cell) {
                if ($index === 4) {
                    // 跳过更新时间列
                    $index++;
                    continue;
                }
                $content = $cell->textContent;
                if ($index === 1) {
                    // 处理书名列，去除多余的 <font> 标签内容
                    $content = preg_replace('/<font color="#[a-f0-9]{6}"></font>/', '', $content);
                } elseif ($index === 5) {
                    // 提取openwin中的url
                    $aTags = $cell->getElementsByTagName('a');
                    foreach ($aTags as $aTag) {
                        $onclick = $aTag->getAttribute('onclick');
                        if (strpos($onclick, 'openwin') === 0) {
                            preg_match('/openwin\(\'(.*?)\'\)/', $onclick, $matches);
                            if (isset($matches[1])) {
                                $openwinUrls[] = $matches[1];
                            }
                        }
                    }
                } elseif ($index === 6) {
                    // 提取openwin1中的url
                    $aTags = $cell->getElementsByTagName('a');
                    foreach ($aTags as $aTag) {
                        $onclick = $aTag->getAttribute('onclick');
                        if (strpos($onclick, 'openwin1') === 0) {
                            preg_match('/openwin1\(\'(.*?)\'\)/', $onclick, $matches);
                            if (isset($matches[1])) {
                                $openwin1Urls[] = $matches[1];
                            }
                        }
                    }
                }
                $rowData[] = $content;
                $index++;
            }
            $data[] = $rowData;
        }
    
        $result = [
            'data' => $data,
            'openwinUrls' => $openwinUrls,
            'openwin1Urls' => $openwin1Urls
        ];
        // print_r(json_encode($result, JSON_UNESCAPED_UNICODE));
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    // 智能体
    function actionAgentRec(){
        $id = arg("id","");
        $array_list = array(
            "id"=>"1",
            "title"=>"韩娱明星",
            "url"=>"https://7q1kba.smartapps.baidu.com/?_swebfr=1&_swebScene=3621000000000000",
            "description"=>"是一个专门提供最新韩国娱乐资讯的智能体，提供Kpop明星、韩剧、电影、音乐及演唱会的第一手资讯"
        );
        $this->config = array(
			"default_thumbnail"=>"/i/img/logo.jpg",
			"site_title"=>$array_list["title"],
			"site_keywords"=>"",
			"site_description"=>$array_list["description"],
			"site_generator"=>"Powered by 火羽Hubird",
			"site_author"=>"火羽Hubird-提升品牌影响力",
			"locationurl"=>$array_list["url"],
		); 
    }
    // 我的收藏
    function actionfavorites(){
        $QtCollects = new QtCollects();
        // 获取用户收藏列表，只获取status为1(收藏)的记录
        $result_collect = $QtCollects->findAll(array("userId"=>$this->user["id"], "status"=>1),"createTime DESC");
        $list = [];
        $QtSources = new QtSources();
        $QtLikes = new QtLikes();
        foreach ($result_collect as $rc){
            $map = $QtSources->find(array("id"=>$rc["objectId"]));
            if(!$map) continue; // 如果找不到对应的资源，跳过
            
            $thumbnail = !empty($map["thumbnail"])?json_decode($map["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));
            $map["thumbnail"] = $thumbnail[0]["img"];
            if(!empty($map["tags"])){
    		    $arr_tags = explode(",",$map["tags"]);
    		    $map["tags"] = $arr_tags;
    		}
    		// 获取点赞数
    		$count_like = $QtLikes->findCount(array("item_id"=>$map["id"]));
    		$map["zan"] = $count_like;
    		// 添加收藏时间
    		$map["collect_time"] = $rc["createTime"];
            array_push($list,$map);
        }
        $this->list_res = $list;
        $this->favorites_count = count($list);
        $this->display("pc/user_favorites.html");
    }

    // 我的点赞
    function actionlikes(){
        $QtLikes = new QtLikes();
        // 获取用户点赞列表
        $result_likes = $QtLikes->findAll(array("user_id"=>$this->user["id"]),"created_at DESC");
        $list = [];
        $QtSources = new QtSources();
        foreach ($result_likes as $rl){
            $map = $QtSources->find(array("id"=>$rl["item_id"]));
            if(!$map) continue; // 如果找不到对应的资源，跳过
            
            $thumbnail = !empty($map["thumbnail"])?json_decode($map["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));
            $map["thumbnail"] = $thumbnail[0]["img"];
            if(!empty($map["tags"])){
    		    $arr_tags = explode(",",$map["tags"]);
    		    $map["tags"] = $arr_tags;
    		}
    		// 添加点赞时间
    		$map["like_time"] = strtotime($rl["created_at"]);
            array_push($list,$map);
        }
        $this->list_res = $list;
        $this->likes_count = count($list);
        $this->display("pc/user_likes.html");
    }

    // 我的红包卡券
    function actioncoupons(){
        // 创建模型实例
        $QtUserRedeemedCoupons = new QtUserRedeemedCoupons();
        
        // 获取当前用户的卡券列表
        $coupons = $QtUserRedeemedCoupons->findAll(
            array("user_id" => $this->user["id"]), 
            "created_at DESC"
        );
        
        // 处理卡券数据
        $processedCoupons = array();
        foreach ($coupons as $coupon) {
            // 格式化时间
            $coupon["exchange_time_format"] = date('Y-m-d', $coupon["exchange_time"]);
            $coupon["expiration_date_format"] = date('Y-m-d', $coupon["expiration_date"]);
            
            // 计算剩余天数
            $now = time();
            $expireTime = $coupon["expiration_date"];
            $daysLeft = ceil(($expireTime - $now) / 86400);
            $coupon["days_left"] = $daysLeft > 0 ? $daysLeft : 0;
            
            // 状态文本
            switch($coupon["status"]) {
                case 0:
                    $coupon["status_text"] = "未使用";
                    $coupon["status_class"] = "bg-blue-100 text-blue-800";
                    break;
                case 1:
                    $coupon["status_text"] = "已使用";
                    $coupon["status_class"] = "bg-green-100 text-green-800";
                    break;
                case 2:
                    $coupon["status_text"] = "已过期";
                    $coupon["status_class"] = "bg-red-100 text-red-800";
                    break;
                default:
                    $coupon["status_text"] = "有效";
                    $coupon["status_class"] = "bg-blue-100 text-blue-800";
                    break;
            }
            
            // 卡券类型文本
            switch($coupon["coupon_type"]) {
                case "ad":
                    $coupon["coupon_type_text"] = "广告位抵扣券";
                    break;
                case "am":
                    $coupon["coupon_type_text"] = "现金抵扣券";
                    break;
                default:
                    $coupon["coupon_type_text"] = "通用券";
                    break;
            }
            
            $processedCoupons[] = $coupon;
        }
        
        $this->coupons = $processedCoupons;
        $this->coupons_count = count($processedCoupons);
        $this->display("pc/user_coupons.html");
    }

    // 广告数据详情
    function actionaddetails(){
        $this->gid=arg("gid","");
        $this->adtype = arg("type","");
    }
    // 文章列表页面
    function actionarticles(){
        
        $QtSources = new QtSources();
        try{ 
            // 获取文章的热门标签，根据文章的views数进行排序，然后提取出现最多次数最多的标签获取10个
            $tags = $QtSources->query("SELECT tags,count(tags) as tag_count FROM qt_sources WHERE content_type='article' GROUP BY tags ORDER BY tag_count DESC LIMIT 10");
            
            // 重构tags
            $new_tags = [];
            foreach ($tags as $tag){
                // 去掉tag前面的逗号
                $tag["tags"] = substr($tag["tags"],1);
                array_push($new_tags,$tag);
            }
            $this->tags = $new_tags;
            // 获取5条热门文章
            $hot_articles = $QtSources->query("SELECT * FROM qt_sources WHERE content_type='article' ORDER BY views DESC LIMIT 5");
            // 重构hott_articles 针对图片做兼容处理，如果库存没图或者图片无法访问，则使用随机图
            $new_hot_articles = array();
            for ($i=0; $i < count($hot_articles); $i++) {
                $rec = $hot_articles[$i];

                $rec["thumbnail"] = !empty($rec["thumbnail"])?json_decode($rec["thumbnail"],true):array(array("img"=>"https://picsum.photos/100/100?random=4"));	
                if(count($rec["thumbnail"])>0){
                    $rec["thumbnail"] = $rec["thumbnail"][0]["img"];
                }else{
                    $rec["thumbnail"] = "https://picsum.photos/100/100?random=4";
                }
                $rec["describe_images"] = !empty($rec["describe_images"])?json_decode($rec["describe_images"],true):false;	
                $rec["create_time"] = $this->timeToRelativeString($rec["create_time"]);
                $rec["publish_time"] = $this->timeToRelativeString($rec["publish_time"]);
                $rec["content_type_text"] = constant('ContentType::' . $rec["content_type"]);
                $rec["content_type_color"] = constant('ContentTypeColor::'.$rec["content_type"]);
                $rec["views_count"] = format_number($rec["views"]);
                array_push($new_hot_articles, $rec);
            }
            $this->hot_articles = $new_hot_articles;
            
            // 获取文章总数
            $stock_articles_count = $QtSources->findCount(array("content_status" => 1, "content_type" => "article"));
            $this->stock_articles_count = $stock_articles_count;

            // 获取文章分类，10个
            $this->stock_article_categorys = $QtSources->query("SELECT category_name FROM `qt_sources` where content_type='article' group by category_name LIMIT 10");

        } catch (Exception $e) {
            $this->tags = [];
            $this->stock_articles_count = 0;
        }
    }
    // AJAX获取文章列表接口
    function actiongetArticleList(){
        // 设置响应头为JSON格式
        header('Content-Type: application/json');
        
        // 获取请求参数
        $keyword = arg('keyword', '');           // 搜索关键词
        $category = arg('category', '');         // 分类标签
        $page = (int)arg('page', 1);            // 分页页码
        $sort = arg('sort', 'latest');          // 排序方式: latest(最新), recommend(推荐), hot(最热)
        $pageSize = (int)arg('pageSize', 10);   // 每页显示数量，默认10条
        
        // 参数验证
        if ($page < 1) $page = 1;
        if ($pageSize < 1 || $pageSize > 100) $pageSize = 10; // 限制每页最大100条
        // 限制最大页码，防止过多页码
        if ($page > 100) $page = 100;
        
        // 创建模型实例
        $QtSources = new QtSources();
        
        try {
            // 构建基础SQL查询
            $baseSql = "SELECT id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, likes, weight FROM qt_sources WHERE content_status = 1 AND content_type = 'article'";
            $countSql = "SELECT COUNT(*) as total_count FROM qt_sources WHERE content_status = 1 AND content_type = 'article'";
            
            // 添加搜索条件
            $params = array();
            if (!empty($keyword)) {
                $baseSql .= " AND title LIKE :keyword";
                $countSql .= " AND title LIKE :keyword";
                $params[':keyword'] = "%".$keyword."%";
            }
            
            // 添加分类筛选条件
            if (!empty($category)) {
                $baseSql .= " AND category_name = :category";
                $countSql .= " AND category_name = :category";
                $params[':category'] = $category;
            }
            
            // 构建排序规则
            switch ($sort) {
                case 'recommend':
                    $orderBy = "weight DESC, publish_time DESC"; // 按权重和发布时间排序
                    break;
                case 'hot':
                    $orderBy = "views DESC, publish_time DESC";  // 按浏览量和发布时间排序
                    break;
                case 'latest':
                default:
                    $orderBy = "publish_time DESC";              // 按发布时间倒序
                    break;
            }
            
            // 获取总记录数
            $countResult = $QtSources->query($countSql, $params);
            $totalCount = $countResult[0]['total_count'];
            
            // 计算分页信息
            $totalPage = ceil($totalCount / $pageSize);
            if ($page > $totalPage && $totalPage > 0) {
                $page = $totalPage;
            }
            
            // 计算偏移量
            $offset = ($page - 1) * $pageSize;
            
            // 完整的查询SQL
            $sql = $baseSql . " ORDER BY " . $orderBy . " LIMIT " . $offset . "," . $pageSize;
            
            // 执行查询
            $articles = $QtSources->query($sql, $params);
            
            // 处理文章数据
            $processedArticles = array();
            foreach ($articles as $article) {
                // 处理缩略图
                $thumbnail = !empty($article["thumbnail"]) ? json_decode($article["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
                if (count($thumbnail) > 0) {
                    $article["thumbnail"] = $thumbnail[0]["img"];
                } else {
                    $article["thumbnail"] = $this->config["default_thumbnail"];
                }
                
                // 处理时间显示
                $article["publish_time"] = $this->timeToRelativeString($article["publish_time"]);
                
                // 格式化数字
                $article["views"] = format_number($article["views"]);
                $article["dialogue_count"] = format_number($article["dialogue_count"]);
                $article["likes"] = format_number($article["likes"]);
                
                $processedArticles[] = $article;
            }
            
            // 构建分页信息
            $pager = array(
                "total_count" => $totalCount,
                "page_size" => $pageSize,
                "total_page" => $totalPage > 0 ? $totalPage : 1,
                "current_page" => $page,
                "prev_page" => $page > 1 ? $page - 1 : 1,
                "next_page" => $page < $totalPage ? $page + 1 : $totalPage,
                "all_pages" => range(1, $totalPage > 0 ? $totalPage : 1) // 添加所有页码数组
            );
            
            // 返回成功响应
            echo json_encode(array(
                "success" => true,
                "data" => array(
                    "articles" => $processedArticles,
                    "pager" => $pager
                ),
                "message" => "获取文章列表成功"
            ));
            
        } catch (Exception $e) {
            // 返回错误响应
            echo json_encode(array(
                "success" => false,
                "data" => array(),
                "message" => "获取文章列表失败: " . $e->getMessage()
            ));
        }
        
        // 结束执行
        exit;
    }
    
    // 获取分类颜色辅助函数
    function getCategoryColor($category) {
        $colorMap = array(
            '智能体' => 'blue',
            '公众号' => 'green',
            '小程序' => 'purple',
            '小游戏' => 'yellow',
            '文章' => 'red'
        );
        return isset($colorMap[$category]) ? $colorMap[$category] : 'gray';
    }
    
    // 搜索功能接口
    function actionsearch(){
        // 获取请求参数
        $keyword = arg('keyword', '');           // 搜索关键词
        $category = arg('category', '');         // 分类标签
        $page = (int)arg('page', 1);            // 分页页码
        $sort = arg('sort', 'latest');          // 排序方式: latest(最新), recommend(推荐), hot(最热)
        $pageSize = (int)arg('pageSize', 10);   // 每页显示数量，默认10条
        
        // 参数验证
        if ($page < 1) $page = 1;
        if ($pageSize < 1 || $pageSize > 100) $pageSize = 10; // 限制每页最大100条
        // 限制最大页码，防止过多页码
        if ($page > 100) $page = 100;
        
        // 创建模型实例
        $QtSources = new QtSources();
        
        try {
            // 构建基础SQL查询 - 支持所有内容类型
            $baseSql = "SELECT id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, likes, weight, content_type FROM qt_sources WHERE content_status = 1";
            $countSql = "SELECT COUNT(*) as total_count FROM qt_sources WHERE content_status = 1";
            
            // 添加搜索条件
            $params = array();
            if (!empty($keyword)) {
                $baseSql .= " AND (title LIKE :keyword OR description LIKE :keyword)";
                $countSql .= " AND (title LIKE :keyword OR description LIKE :keyword)";
                $params[':keyword'] = "%".$keyword."%";
            }
            
            // 添加分类筛选条件
            if (!empty($category)) {
                // 将中文分类名映射到content_type
                $categoryMap = array(
                    '智能体' => 'agent',
                    '公众号' => 'gzh',
                    '小程序' => 'xcx',
                    '小游戏' => 'xyx',
                    '文章' => 'article'
                );
                
                if (isset($categoryMap[$category])) {
                    $baseSql .= " AND content_type = :content_type";
                    $countSql .= " AND content_type = :content_type";
                    $params[':content_type'] = $categoryMap[$category];
                }
            }
            
            // 构建排序规则
            switch ($sort) {
                case 'recommend':
                    $orderBy = "weight DESC, publish_time DESC"; // 按权重和发布时间排序
                    break;
                case 'hot':
                    $orderBy = "views DESC, publish_time DESC";  // 按浏览量和发布时间排序
                    break;
                case 'latest':
                default:
                    $orderBy = "publish_time DESC";              // 按发布时间倒序
                    break;
            }
            
            // 获取总记录数
            $countResult = $QtSources->query($countSql, $params);
            $totalCount = $countResult[0]['total_count'];
            
            // 计算分页信息
            $totalPage = ceil($totalCount / $pageSize);
            if ($page > $totalPage && $totalPage > 0) {
                $page = $totalPage;
            }
            
            // 计算偏移量
            $offset = ($page - 1) * $pageSize;
            
            // 完整的查询SQL
            $sql = $baseSql . " ORDER BY " . $orderBy . " LIMIT " . $offset . "," . $pageSize;
            
            // 执行查询
            $results = $QtSources->query($sql, $params);
            
            // 处理搜索结果数据
            $processedResults = array();
            foreach ($results as $result) {
                // 处理缩略图
                $thumbnail = !empty($result["thumbnail"]) ? json_decode($result["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
                if (count($thumbnail) > 0) {
                    $result["thumbnail"] = $thumbnail[0]["img"];
                } else {
                    $result["thumbnail"] = $this->config["default_thumbnail"];
                }
                
                // 处理时间显示
                $result["publish_time"] = $this->timeToRelativeString($result["publish_time"]);
                
                // 格式化数字
                $result["views"] = format_number($result["views"]);
                $result["dialogue_count"] = format_number($result["dialogue_count"]);
                $result["likes"] = format_number($result["likes"]);
                
                // 处理内容类型显示名称
                $contentTypeMap = array(
                    'agent' => '智能体',
                    'gzh' => '公众号',
                    'xcx' => '小程序',
                    'xyx' => '小游戏',
                    'article' => '文章'
                );
                $result["category_name"] = isset($contentTypeMap[$result["content_type"]]) ? $contentTypeMap[$result["content_type"]] : $result["content_type"];
                
                $processedResults[] = $result;
            }
            
            // 构建分页信息
            $pager = array(
                "total_count" => $totalCount,
                "page_size" => $pageSize,
                "total_page" => $totalPage > 0 ? $totalPage : 1,
                "current_page" => $page,
                "prev_page" => $page > 1 ? $page - 1 : 1,
                "next_page" => $page < $totalPage ? $page + 1 : $totalPage,
                "all_pages" => range(1, $totalPage > 0 ? $totalPage : 1) // 添加所有页码数组
            );
            $this->articles = $processedResults;
            $this->pager = $pager;
            
        } catch (Exception $e) {
            // 返回错误响应
            $this->articles = [];
            $this->pager = [];
        }
    }

    
    
    // 搜索功能接口
    function actionajaxsearch(){
        // 设置响应头为JSON格式
        header('Content-Type: application/json');
        
        // 获取请求参数
        $keyword = arg('keyword', '');           // 搜索关键词
        $category = arg('category', '');         // 分类标签
        $page = (int)arg('page', 1);            // 分页页码
        $sort = arg('sort', 'latest');          // 排序方式: latest(最新), recommend(推荐), hot(最热)
        $pageSize = (int)arg('pageSize', 10);   // 每页显示数量，默认10条
        
        // 参数验证
        if ($page < 1) $page = 1;
        if ($pageSize < 1 || $pageSize > 100) $pageSize = 10; // 限制每页最大100条
        // 限制最大页码，防止过多页码
        if ($page > 100) $page = 100;
        
        // 创建模型实例
        $QtSources = new QtSources();
        
        try {
            // 构建基础SQL查询 - 支持所有内容类型
            $baseSql = "SELECT id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, likes, weight, content_type FROM qt_sources WHERE content_status = 1";
            $countSql = "SELECT COUNT(*) as total_count FROM qt_sources WHERE content_status = 1";
            
            // 添加搜索条件
            $params = array();
            if (!empty($keyword)) {
                $baseSql .= " AND (title LIKE :keyword OR description LIKE :keyword)";
                $countSql .= " AND (title LIKE :keyword OR description LIKE :keyword)";
                $params[':keyword'] = "%".$keyword."%";
            }
            
            // 添加分类筛选条件
            if (!empty($category)) {
                // 将中文分类名映射到content_type
                $categoryMap = array(
                    '智能体' => 'agent',
                    '公众号' => 'gzh',
                    '小程序' => 'xcx',
                    '小游戏' => 'xyx',
                    '文章' => 'article'
                );
                
                if (isset($categoryMap[$category])) {
                    $baseSql .= " AND content_type = :content_type";
                    $countSql .= " AND content_type = :content_type";
                    $params[':content_type'] = $categoryMap[$category];
                }
            }
            
            // 构建排序规则
            switch ($sort) {
                case 'recommend':
                    $orderBy = "weight DESC, publish_time DESC"; // 按权重和发布时间排序
                    break;
                case 'hot':
                    $orderBy = "views DESC, publish_time DESC";  // 按浏览量和发布时间排序
                    break;
                case 'latest':
                default:
                    $orderBy = "publish_time DESC";              // 按发布时间倒序
                    break;
            }
            
            // 获取总记录数
            $countResult = $QtSources->query($countSql, $params);
            $totalCount = $countResult[0]['total_count'];
            
            // 计算分页信息
            $totalPage = ceil($totalCount / $pageSize);
            if ($page > $totalPage && $totalPage > 0) {
                $page = $totalPage;
            }
            
            // 计算偏移量
            $offset = ($page - 1) * $pageSize;
            
            // 完整的查询SQL
            $sql = $baseSql . " ORDER BY " . $orderBy . " LIMIT " . $offset . "," . $pageSize;
            
            // 执行查询
            $results = $QtSources->query($sql, $params);
            
            // 处理搜索结果数据
            $processedResults = array();
            foreach ($results as $result) {
                // 处理缩略图
                $thumbnail = !empty($result["thumbnail"]) ? json_decode($result["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
                if (count($thumbnail) > 0) {
                    $result["thumbnail"] = $thumbnail[0]["img"];
                } else {
                    $result["thumbnail"] = $this->config["default_thumbnail"];
                }
                
                // 处理时间显示
                $result["publish_time"] = $this->timeToRelativeString($result["publish_time"]);
                
                // 格式化数字
                $result["views"] = format_number($result["views"]);
                $result["dialogue_count"] = format_number($result["dialogue_count"]);
                $result["likes"] = format_number($result["likes"]);
                
                // 处理内容类型显示名称
                $contentTypeMap = array(
                    'agent' => '智能体',
                    'gzh' => '公众号',
                    'xcx' => '小程序',
                    'xyx' => '小游戏',
                    'article' => '文章'
                );
                $result["category_name"] = isset($contentTypeMap[$result["content_type"]]) ? $contentTypeMap[$result["content_type"]] : $result["content_type"];
                
                $processedResults[] = $result;
            }
            
            // 构建分页信息
            $pager = array(
                "total_count" => $totalCount,
                "page_size" => $pageSize,
                "total_page" => $totalPage > 0 ? $totalPage : 1,
                "current_page" => $page,
                "prev_page" => $page > 1 ? $page - 1 : 1,
                "next_page" => $page < $totalPage ? $page + 1 : $totalPage,
                "all_pages" => range(1, $totalPage > 0 ? $totalPage : 1) // 添加所有页码数组
            );
            
            // 返回成功响应
            echo json_encode(array(
                "success" => true,
                "data" => array(
                    "articles" => $processedResults,
                    "pager" => $pager
                ),
                "message" => "搜索成功"
            ));
            
        } catch (Exception $e) {
            // 返回错误响应
            echo json_encode(array(
                "success" => false,
                "data" => array(),
                "message" => "搜索失败: " . $e->getMessage()
            ));
        }
    }
    
    
    
    // 完善个人信息奖励接口
    function actionCompleteProfileReward(){
        try{
            // 检查用户是否已完善个人信息（手机号、QQ号、Email）
            if (!empty($this->user["phone"]) && !empty($this->user["qq"]) && !empty($this->user["email"])) {
                
                // 检查是否已经领取过奖励
                $qt_points_log = new QtPointsLog();
                $rewardExists = $qt_points_log->find(array(
                    "user_id" => $this->user["id"],
                    "type" => "earn",
                    "description" => "完善个人信息奖励"
                ));
                
                if (!$rewardExists) {
                    // 发放50积分奖励
                    $data = array(
                        "user_id" => $this->user["id"],
                        "points" => 50,
                        "type" => "earn",
                        "description" => "完善个人信息奖励"
                    );
                    
                    $result = $qt_points_log->create($data);
                    if ($result) {
                        // 更新用户积分余额
                        $QtUsers = new QtUsers();
                        $newBalance = $this->user["blance"] + 50;
                        $QtUsers->update(array("id" => $this->user["id"]), array(
                            "blance" => $newBalance
                        ));
                        
                        // 返回成功信息
                        echo json_encode(array(
                            "success" => true,
                            "message" => "恭喜您获得50积分奖励！",
                            "points" => $newBalance
                        ));
                        return;
                    }
                } else {
                    echo json_encode(array(
                        "success" => false,
                        "message" => "您已经领取过完善个人信息奖励了！"
                    ));
                    return;
                }
            }
            
            echo json_encode(array(
                "success" => false,
                "message" => "请先完善个人信息（手机号、QQ号、Email）！"
            ));
        }catch (Exception $e) {
            echo json_encode(array(
                "success" => false,
                "message" => "操作失败: " . $e->getMessage()
            ));
        }
    }
    
    // 检查用户信息完善状态接口
    function actionCheckProfileComplete(){
        // 检查用户是否已完善个人信息（手机号、QQ号、Email）
        $isCompleted = false;
        if (!empty($this->user["phone"]) && !empty($this->user["qq"]) && !empty($this->user["email"])) {
            $isCompleted = true;
        }
        
        // 检查是否已经领取过奖励
        $isRewardClaimed = false;
        if ($isCompleted) {
            $qt_points_log = new QtPointsLog();
            $rewardExists = $qt_points_log->find(array(
                "user_id" => $this->user["id"],
                "type" => "earn",
                "description" => "完善个人信息奖励"
            ));
            if ($rewardExists) {
                $isRewardClaimed = true;
            }
        }
        
        echo json_encode(array(
            "completed" => $isCompleted,
            "rewardClaimed" => $isRewardClaimed
        ));
    }

    // 出售的网站订单
    function actionsaleSiteOrder(){}
    // 出售的智能体订单
    function actionsaleAgentOrder(){}
    // 购买的网站订单
    function actionbuySiteOrder(){}
    // 购买的智能体订单
    function actionbuyAgentOrder(){}
    // 智能体关键词广告列表
    function actionagentkeywords(){
        $QtAgentAdKeyword = new QtAgentAdKeyword();
        $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $ads = $QtAgentAdKeyword->query("SELECT a.*,b.thumbnail,b.title,b.content_url FROM qt_agent_ad_keyword a,qt_sources b WHERE a.ad_user_id=".$user["id"]." AND a.source_id=b.id");
        $newads = [];
        foreach ($ads as $source){
            $thumbnail = !empty($source["thumbnail"])?json_decode($source["thumbnail"],true):$this->config["default_thumbnail"];
			$source["thumbnail"] = $thumbnail[0]["img"];
			$link_keywords = json_decode($source["link_keywords"],true);
			$link_keywords_str = "";
			foreach ($link_keywords as $lk){
			    $link_keywords_str .="<i>".$lk."</i>|";
			}
			$source["link_keywords_html"] = rtrim($link_keywords_str,"|");
			array_push($newads,$source);
        }
        $this->ads = $newads;
    }
    // 注销登录
    function actionlogout(){
        setcookie("auth_quntui_token", '', 0, "/");
        $this->jump(url("pc/main","index"));
    }
    // 生成二维码
    function actionGetQrcode(){
        $content = arg('content','');
        
        $errorCorrectionLevel = 'L'; // 容错级别：L、M、Q、H
        $matrixPointSize = 4; // 生成图片大小
        $margin = 2; // 二维码周围边框空白区域间距值
        // 生成二维码图片
        QRcode::png($content, false, $errorCorrectionLevel, $matrixPointSize, $margin);
    }
    // 发现页面
    function actionDiscovery(){
        $redis = new ZDRedis();
        $this->quntui_discovery = $redis->get("quntui_discovery");
    }
    // 添加AI智能体商业链接
    function actionagentad(){
        // 查询此用户的智能体
        $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $QtSources = new QtSources();
        $this->result = $QtSources->findAll(array("content_type"=>"agent","create_uid"=>$user["id"]));
    }
    // 获取帮助中心菜单
    function getHelperItem($pid=0){
        $QtHelper = new QtHelper();
        $result = $QtHelper->findAll(array("pid"=>$pid),"sort desc");
        $items = [];
        foreach ($result as $res){
            $item = [
                "id" => $res['id'],
                "title" => $res['title'],
                "children" => $this->getHelperItem($res['id'])
            ];
            $items[] = $item;
        }
        
        return $items;
    }
    // 帮助中心
    function actionhelper(){
        $search = arg("search","");
        $QtHelper = new QtHelper();
        if(empty($search)){
            // 搜索结果列表
            $this->questions = $QtHelper->query("SELECT * FROM qt_helper WHERE CONCAT(title,`desc`) LIKE '%".$search."%' AND `desc` IS NOT NULL ORDER BY sort desc LIMIT 20");
        }else{
            // 非搜索列表
            $this->questions = $QtHelper->query("SELECT * FROM qt_helper WHERE `desc` IS NOT NULL ORDER BY sort desc LIMIT 20");
        }
        // 获取菜单
        $this->menus = $this->getHelperItem();
    }
    // 帮助中心问题详情
    function actionquestion(){
        $id = arg("id","");
        if(empty($id)){
            $this->jump(url("pc/main","404"));
        }
        $QtHelper = new QtHelper();
    }
    /**
     * AJAX接口：获取智能体列表
     */
    function actiongetAgentList(){
        // 设置响应头为JSON格式
        header('Content-Type: application/json');
        
        // 获取请求参数
        $keyword = arg('keyword', '');           // 搜索关键词
        $category = arg('category', '');         // 分类标签
        $page = (int)arg('page', 1);            // 分页页码
        $sort = arg('sort', 'latest');          // 排序方式: latest(最新), recommend(推荐), hot(最热)
        $pageSize = (int)arg('pageSize', 12);   // 每页显示数量，默认12条
        
        // 参数验证
        if ($page < 1) $page = 1;
        if ($pageSize < 1 || $pageSize > 100) $pageSize = 12; // 限制每页最大100条
        // 限制最大页码，防止过多页码
        if ($page > 100) $page = 100;
        
        // 创建模型实例
        $QtSources = new QtSources();
        
        try {
            // 构建基础SQL查询
            $baseSql = "SELECT id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, likes, weight FROM qt_sources WHERE content_status = 1 AND content_type = 'agent'";
            $countSql = "SELECT COUNT(*) as total_count FROM qt_sources WHERE content_status = 1 AND content_type = 'agent'";
            
            // 添加搜索条件
            $params = array();
            if (!empty($keyword)) {
                $baseSql .= " AND title LIKE :keyword";
                $countSql .= " AND title LIKE :keyword";
                $params[':keyword'] = "%".$keyword."%";
            }
            
            // 添加分类筛选条件
            if (!empty($category)) {
                $baseSql .= " AND category_name = :category";
                $countSql .= " AND category_name = :category";
                $params[':category'] = $category;
            }
            
            // 构建排序规则
            switch ($sort) {
                case 'recommend':
                    $orderBy = "weight DESC, publish_time DESC"; // 按权重和发布时间排序
                    break;
                case 'hot':
                    $orderBy = "views DESC, publish_time DESC";  // 按浏览量和发布时间排序
                    break;
                case 'latest':
                default:
                    $orderBy = "publish_time DESC";              // 按发布时间倒序
                    break;
            }
            
            // 获取总记录数
            $countResult = $QtSources->query($countSql, $params);
            $totalCount = $countResult[0]['total_count'];
            
            // 计算分页信息
            $totalPage = ceil($totalCount / $pageSize);
            if ($page > $totalPage && $totalPage > 0) {
                $page = $totalPage;
            }
            
            // 计算偏移量
            $offset = ($page - 1) * $pageSize;
            
            // 完整的查询SQL
            $sql = $baseSql . " ORDER BY " . $orderBy . " LIMIT " . $offset . "," . $pageSize;
            
            // 执行查询
            $agents = $QtSources->query($sql, $params);
            
            // 处理智能体数据
            $processedAgents = array();
            foreach ($agents as $agent) {
                // 处理缩略图
                $thumbnail = !empty($agent["thumbnail"]) ? json_decode($agent["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
                if (count($thumbnail) > 0) {
                    $agent["thumbnail"] = $thumbnail[0]["img"];
                } else {
                    $agent["thumbnail"] = $this->config["default_thumbnail"];
                }
                
                // 处理时间显示
                $agent["publish_time"] = $this->timeToRelativeString($agent["publish_time"]);
                
                // 格式化数字
                $agent["views"] = format_number($agent["views"]);
                $agent["dialogue_count"] = format_number($agent["dialogue_count"]);
                $agent["likes"] = format_number($agent["likes"]);
                
                $processedAgents[] = $agent;
            }
            
            // 构建分页信息
            $pager = array(
                "total_count" => $totalCount,
                "page_size" => $pageSize,
                "total_page" => $totalPage > 0 ? $totalPage : 1,
                "current_page" => $page,
                "prev_page" => $page > 1 ? $page - 1 : 1,
                "next_page" => $page < $totalPage ? $page + 1 : $totalPage
            );
            
            // 返回成功响应
            echo json_encode(array(
                "success" => true,
                "data" => array(
                    "agents" => $processedAgents,
                    "pager" => $pager
                ),
                "message" => "获取智能体列表成功"
            ));
            
        } catch (Exception $e) {
            // 返回错误响应
            echo json_encode(array(
                "success" => false,
                "data" => array(),
                "message" => "获取智能体列表失败: " . $e->getMessage()
            ));
        }
        
        // 结束执行
        exit;
    }
    
    /**
     * AJAX接口：获取文章分类数据
     */
    function actionGetArticleByCategory() {
        header('Content-Type: application/json; charset=utf-8');
        
        $category = arg('category', 'all');
        
        try {
            $articleData = $this->getArticleDisplayData($category);
            
            // 返回 JSON数据
            echo json_encode(array(
                'success' => true,
                'data' => $articleData
            ), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '获取数据失败：' . $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
        
        exit();
    }
    /**
     * 删除推广位（AJAX接口）
     */
    function actionDeletePromotion(){
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        try {
            // 获取参数
            $promotionId = intval(arg('promotion_id', 0));
            
            if (empty($promotionId)) {
                echo json_encode(array(
                    "success" => false,
                    "message" => "参数不完整"
                ));
                return;
            }
            
            // 获取推广位信息
            $qtPromotion = new QtPromotion();
            $promotion = $qtPromotion->find(array("id" => $promotionId, "uid" => $this->user["id"]));
            
            if (!$promotion) {
                echo json_encode(array(
                    "success" => false,
                    "message" => "推广位不存在或无权限操作"
                ));
                return;
            }
            
            // 删除推广位
            $result = $qtPromotion->delete(array("id" => $promotionId));
            
            if ($result) {
                echo json_encode(array(
                    "success" => true,
                    "message" => "推广位删除成功"
                ));
            } else {
                echo json_encode(array(
                    "success" => false,
                    "message" => "推广位删除失败"
                ));
            }
        } catch (Exception $e) {
            // 错误处理
            echo json_encode(array(
                "success" => false,
                "message" => "系统错误: " . $e->getMessage()
            ));
        }
    }
    
    /**
     * 编辑推广位（AJAX接口）
     */
    function actionEditPromotion(){
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        try {
            // 获取参数
            $promotionId = intval(arg('promotion_id', 0));
            $position = trim(arg('position', ''));
            $desc = trim(arg('desc', ''));
            
            // 验证参数
            if (empty($promotionId) || empty($position) || empty($desc)) {
                echo json_encode(array(
                    "success" => false,
                    "message" => "参数不完整"
                ));
                return;
            }
            
            // 获取推广位信息
            $qtPromotion = new QtPromotion();
            $promotion = $qtPromotion->find(array("id" => $promotionId, "uid" => $this->user["id"]));
            
            if (!$promotion) {
                echo json_encode(array(
                    "success" => false,
                    "message" => "推广位不存在或无权限操作"
                ));
                return;
            }
            
            // 更新推广位信息
            $result = $qtPromotion->update(
                array("id" => $promotionId),
                array(
                    "position" => $position,
                    "desc" => $desc
                )
            );
            
            if ($result) {
                echo json_encode(array(
                    "success" => true,
                    "message" => "推广位更新成功"
                ));
            } else {
                echo json_encode(array(
                    "success" => false,
                    "message" => "推广位更新失败"
                ));
            }
        } catch (Exception $e) {
            // 错误处理
            echo json_encode(array(
                "success" => false,
                "message" => "系统错误: " . $e->getMessage()
            ));
        }
    }
    
    /**
     * 智能体列表数据接口（AJAX）
     */
    function actionGetAgentsList() {
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        // 获取参数
        $page = intval(arg('page', 1));
        $pageSize = intval(arg('pageSize', 12));
        $keyword = trim(arg('keyword', ''));
        $category = trim(arg('category', ''));
        $sortBy = trim(arg('sortBy', 'weight')); // weight, time, rating, users
        $minRating = floatval(arg('minRating', 0));
        $priceType = trim(arg('priceType', '')); // free, paid, trial
        $minUsers = intval(arg('minUsers', 0));
        
        // 验证参数
        if ($page < 1) $page = 1;
        if ($pageSize < 1 || $pageSize > 50) $pageSize = 12;
        
        // 构建排序
        $order = 'weight DESC';
        switch ($sortBy) {
            case 'time':
                $order = 'publish_time DESC';
                break;
            case 'rating':
                $order = 'rating_score DESC';
                break;
            case 'users':
                $order = 'user_nums DESC';
                break;
            case 'weight':
            default:
                $order = 'weight DESC';
                break;
        }
        
        // 构建查询条件
        $conditions = [];
        if (!empty($keyword)) {
            $conditions['keyword'] = $keyword;
        }
        if (!empty($category)) {
            $conditions['category'] = $category;
        }
        if ($minRating > 0) {
            $conditions['min_rating'] = $minRating;
        }
        if (!empty($priceType)) {
            $conditions['price_type'] = $priceType;
        }
        if ($minUsers > 0) {
            $conditions['min_users'] = $minUsers;
        }
        
        // 获取数据
        $QtSources = new QtSources();
        $result = $QtSources->getAgentsList($conditions, $page, $pageSize, $order);
        
        // 返回JSON响应
        echo json_encode([
            'code' => 200,
            'message' => 'success',
            'data' => $result
        ]);
        exit;
    }
    
    /**
     * 获取所有分类标签接口（AJAX）
     */
    function actionGetAgentCategories() {
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        $QtSources = new QtSources();
        $categories = $QtSources->getAllCategories();
        
        // 返回JSON响应
        echo json_encode([
            'code' => 200,
            'message' => 'success',
            'data' => $categories
        ]);
        exit;
    }

    /**
     * 获取公众号所有分类标签接口（AJAX）
     */
    function actionGetOfficialsTags() { 
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        $QtSources = new QtSources();
        $categories = $QtSources->getAllOfficalsCategories();
        
        // 返回JSON响应
        echo json_encode([
            'code' => 200,
            'message' => 'success',
            'data' => $categories
        ]);
        exit;
    }
    /**
     * 获取小程序所有分类标签接口（AJAX）
     */
    function actionGetMiniProgramTags() { 
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        $QtSources = new QtSources();
        $categories = $QtSources->getAllMiniProgramsCategories();
        
        // 返回JSON响应
        echo json_encode([
            'code' => 200,
            'message' => 'success',
            'data' => $categories
        ]);
        exit;
    }
    /**
     * 用户积分商城
     */
    function actionpoints_mall(){
        // 获取当前页码和分类参数
        $page = intval(arg('page', 1));
        $category = trim(arg('category', 'all'));
        $pageSize = 12; // 每页显示12个商品
        
        // 参数验证
        if ($page < 1) $page = 1;
        
        // 创建模型实例
        $QtDiscountCoupons = new QtDiscountCoupons();
        
        // 构建查询条件
        $conditions = array('status' => "active"); // 只显示启用的卡券
        
        // 添加分类筛选条件
        if ($category !== 'all' && !empty($category)) {
            $conditions['category'] = $category;
        }
        
        // 获取总记录数
        $totalCount = $QtDiscountCoupons->findCount($conditions);
        
        // 计算总页数
        $totalPages = ceil($totalCount / $pageSize);
        
        // 确保页码不超过总页数
        if ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages;
        }
        
        // 计算偏移量
        $offset = ($page - 1) * $pageSize;
        try{
            // 获取当前页的卡券列表
            $coupons = $QtDiscountCoupons->findAll(
                $conditions,
                "created_at ASC",
                "*",
                "".$offset.",".$pageSize.""
            );
        }catch(\Exception $e){
            var_dump($e);
        }
        
        // 处理卡券数据
        $processedCoupons = array();
        foreach ($coupons as $coupon) {
            // 卡券类型文本
            switch($coupon["category"]) {
                case "virtual":
                    $coupon["category_text"] = "虚拟卡券";
                    $coupon["icon"] = "fa-ticket";
                    $coupon["bg_class"] = "from-blue-400 to-purple-500";
                    break;
                case "physical":
                    $coupon["category_text"] = "实物奖励";
                    $coupon["icon"] = "fa-gift";
                    $coupon["bg_class"] = "from-red-400 to-orange-500";
                    break;
                case "service":
                    $coupon["category_text"] = "特权服务";
                    $coupon["icon"] = "fa-trophy";
                    $coupon["bg_class"] = "from-green-400 to-blue-500";
                    break;
                default:
                    $coupon["category_text"] = "通用券";
                    $coupon["icon"] = "fa-ticket";
                    $coupon["bg_class"] = "from-blue-400 to-purple-500";
                    break;
            }
            
            $processedCoupons[] = $coupon;
        }
        
        // 传递数据到模板
        $this->coupons = $processedCoupons;
        $this->currentPage = $page;
        $this->totalPages = $totalPages;
        $this->totalCount = $totalCount;
        $this->category = $category;
        $this->pageSize = $pageSize;
        $this->nextPage = $page + 1;
        $this->previousPage = $page - 1;
        
        $this->display("pc/user_points_mall.html");
    }
    
    // 兑换卡券功能
    function actionredeemCoupon(){
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        
        // 获取卡券ID参数
        $couponId = intval(arg('coupon_id'));
        
        // 参数验证
        if ($couponId <= 0) {
            echo json_encode(array(
                'success' => false,
                'message' => '参数错误'
            ));
            exit;
        }
        
        // 创建模型实例
        $QtDiscountCoupons = new QtDiscountCoupons();
        $QtUserRedeemedCoupons = new QtUserRedeemedCoupons();
        $QtPointsLog = new QtPointsLog();
        $qt_users = new qt_users();
        
        // 查找卡券信息
        $coupon = $QtDiscountCoupons->find(array('coupon_id' => $couponId));
        
        // 检查卡券是否存在
        if (empty($coupon)) {
            echo json_encode(array(
                'success' => false,
                'message' => '该卡券不存在'
            ));
            exit;
        }
        
        // 检查卡券状态是否为激活状态
        if ($coupon["status"] != 'active') {
            echo json_encode(array(
                'success' => false,
                'message' => '该卡券当前不可兑换'
            ));
            exit;
        }
        
        // 检查卡券是否在有效期内
        $currentTime = time();
        if ($currentTime < $coupon["start_date"] || $currentTime > $coupon["end_date"]) {
            echo json_encode(array(
                'success' => false,
                'message' => '该卡券不在有效期内'
            ));
            exit;
        }
        
        // 检查是否还有剩余兑换次数
        if ($coupon["max_redemptions"] !== null && $coupon["redemptions_count"] >= $coupon["max_redemptions"]) {
            echo json_encode(array(
                'success' => false,
                'message' => '该卡券已兑完'
            ));
            exit;
        }
        
        // 检查用户积分是否足够
        $userPoints = $this->user["blance"]; // 用户积分存储在blance字段中
        if ($userPoints < $coupon["points_required"]) {
            echo json_encode(array(
                'success' => false,
                'message' => '您的积分不足，无法兑换此卡券'
            ));
            exit;
        }
        
        // 检查用户是否已达到每人限兑次数（如果有设置）
        // 这里我们假设每人限兑次数是通过其他方式控制的，或者在前端已经做了限制
        
        // 开始事务处理
        try {
            // 扣除用户积分
            $newUserPoints = $userPoints - $coupon["points_required"];
            $qt_users->update(
                array("id" => $this->user["id"]),
                array("blance" => $newUserPoints)
                
            );
            
            // 记录积分消费日志
            $QtPointsLog->create(array(
                'user_id' => $this->user["id"],
                'points' => $coupon["points_required"],
                'type' => 'spend',
                'description' => '兑换卡券：' . $coupon["title"]
            ));
               
            // 生成兑换码
            $redeemCode = strtoupper(substr(md5(uniqid()), 0, 12));
            
            // 计算过期时间（30天后过期）
            $exchangeTime = time();
            $expirationDate = strtotime("+30 days");
            
            // 创建用户兑换记录
            $QtUserRedeemedCoupons->create(array(
                'user_id' => $this->user["id"],
                'coupon_code' => $redeemCode,
                'coupon_type' => $coupon["coupon_type"],
                'amount' => $coupon["discount_value"],
                'status' => 0, // 0:未使用
                'exchange_time' => $exchangeTime,
                'expiration_date' => $expirationDate
            ));
            // 更新卡券的已兑换数量
            $newRedemptionsCount = $coupon["redemptions_count"] + 1;
            $QtDiscountCoupons->update(
                array("coupon_id" => $couponId),
                array("redemptions_count" => $newRedemptionsCount)
                
            );
            
            // 准备返回数据
            $responseData = array(
                'success' => true,
                'message' => '兑换成功！',
                'redeem_code' => $redeemCode,
                'coupon_title' => $coupon["title"]
            );
            
            // 根据卡券类型添加提示信息
            if ($coupon["category"] == "physical") {
                $responseData['message'] .= '请留意站内信或联系方式，我们将尽快为您处理实物奖励。';
            } elseif ($coupon["category"] == "service") {
                $responseData['message'] .= '特权服务已生效，请重新登录查看。';
            } elseif ($coupon["category"] == "virtual") {
                $responseData['message'] .= '兑换码已生成，请在个人中心查看。';
            } else {
                $responseData['message'] .= '请在个人中心查看您的卡券。';
            }
            
            echo json_encode($responseData);
            
        } catch (Exception $e) {
            // 发生错误时回滚事务并返回错误信息
            echo json_encode(array(
                'success' => false,
                'message' => '兑换失败，请稍后再试'
            ));
        }
        
        exit;
    }

    // 推广中心
    function actionpopularize(){
        // 查询一些基础统计数据（本月新增收益，本月新增客户）
        $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $qt_points_log = new QtPointsLog();
        $result_earn_all = $qt_points_log->query("SELECT SUM(points) as totalEarn FROM qt_points_log WHERE type='income' AND user_id=".$user["id"]);
        $result_earn_month = $qt_points_log->query("SELECT SUM(points) as totalEarn FROM qt_points_log WHERE type='income' AND created_at>='".date("Y-m")."-01 00:00:00' AND user_id=".$user["id"]);
        
        $result_ref_all = $qt_users->query("SELECT COUNT(1) as totalUser FROM qt_users WHERE referred_by=".$user["id"]);
        $result_ref_month = $qt_users->query("SELECT COUNT(1) as totalUser FROM qt_users WHERE reg_time>".strtotime(date("Y-m")."-01 00:00:00")." AND referred_by=".$user["id"]);
        
        // 查询奖励记录
        $reward_logs = $qt_points_log->findAll(array("user_id"=>$user["id"], "type"=>"income"), "created_at DESC", "*", "0,10");
        
        $this->staticData = array(
            "earn_all"=>empty($result_earn_all[0]["totalEarn"])?0:$result_earn_all[0]["totalEarn"],
            "earn_month"=>empty($result_earn_month[0]["totalEarn"])?0:$result_earn_month[0]["totalEarn"],
            "ref_all"=>empty($result_ref_all[0]["totalUser"])?0:$result_ref_all[0]["totalUser"],
            "ref_month"=>empty($result_ref_month[0]["totalUser"])?0:$result_ref_month[0]["totalUser"]
        );
        
        $this->reward_logs = $reward_logs;
        $this->display("pc/user_promotion.html");
    }
    // 智能体关键词添加
    function actionaddkeywordAgent(){
        $this->layout = "";
        $this->posid = arg("posid",0);
        $this->source_id = arg("source_id",0);
        $this->comfrom = arg("comfrom",0);
        // 获取符合当前智能体广告位的待审核、待付款的关键词
        $QtAgentAdKeyword = new QtAgentAdKeyword();
        $this->result = $QtAgentAdKeyword->query("SELECT * FROM qt_agent_ad_keyword WHERE agentad_id=".$this->posid." AND source_id=".$this->source_id." AND link_status in(1,4)");
        $this->display("v3/main_addkeywordAgent.html");
        
    }
    // 购物车
    function actionCart(){
        $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        // 获取购物车内的商品
        $QtShoppingCart = new QtShoppingCart();
        $QtSources = new QtSources();
        $QtAdsm = new QtAdsm();
        $QtAds = new QtAds();
        $carts = $QtShoppingCart->findAll(array("user_id"=>$user["id"]));
        $newCart = array();
        foreach ($carts as $cart){
            $ad_id = $cart["ad_id"];
            if($cart["product_type"] == "site"){
                $site = $QtAdsm->query("SELECT a.*,b.thumb as site_thumb,b.url as site_url from qt_adsm a,qt_sites b WHERE a.id=".$cart["product_id"]." AND a.site_id=b.id");
                $cart["site"] = $site[0];
                
                if(!empty($ad_id)){
                    $cart["ads"] = $QtAds->find(array("id"=>$ad_id));
                }else{
                    $cart["ads"] = false;
                }
            }else if($cart["product_type"] == "agent"){
                $qt_agent_ad_keyword = new QtAgentAdKeyword();
                $qt_agent_ad = new QtAgentAd();
                $adpos = $qt_agent_ad->find(array("id"=>$cart["product_id"]));
                $source = $QtSources->find(array("id"=>$adpos["source_id"]));
                if($source != false){
                    $thumbnail = !empty($source["thumbnail"])?json_decode($source["thumbnail"],true):$this->config["default_thumbnail"];
			        $source["thumbnail"] = $thumbnail[0]["img"];
                }
                $cart["sources"] = $source;// 广告位详情(智能体详情)
                if(!empty($ad_id)){
                    $cart["ads"] = $qt_agent_ad_keyword->find(array("id"=>$ad_id));// 已经填充的关键词
                }else{
                    $cart["ads"] = false;
                }
            }
            
            array_push($newCart,$cart);
        }
        $this->carts = $newCart;
        $this->blance = $user["blance"];
        
        // 获取用户已经添加的广告内容
        $this->user_ads = $QtAds->findAll(array("userId"=>$user["id"]));
        
    }
    // 获取顶部导航栏
	function getTopNavs(){
	    $QtIndexNav = new QtIndexNav();
	    $result = $QtIndexNav->findAll(null,"sort desc");
	    $list = array(array(
			"name"=>"推荐",
			"id"=>-1
		));
	    foreach ($result as $item){
	        array_push($list,array(
	            "name"=>$item["name"],
	            "id"=>empty($item["cid"])?"tag_".$item["tags"]:$item["cid"]
	        ));
	    }
		return $list;
	}
	// 更新阅读量
	function updateViews($ids){
		$QtSources = new QtSources();
		$idsStr = '';
		foreach($ids as $id){
			if(empty($id)){
				$idsStr = $id;
			}else{
				$idsStr .= ",".$id;
			}
		}
		$idsStr = trim($idsStr,",");
		$QtSources->query("update qt_sources set views=views+1 where id in(".$idsStr.")");
	}
	// 获取热门列表
	function getHotList(){
		$QtSources = new QtSources(); 
		$records = $QtSources->findAll(array("content_status"=>1),"RAND()","id,title,views,dialogue_count,user_nums,shares,likes","0,30");
		// 定义选项数组
		$options = ['<span class="layui-badge layui-bg-orange">热</span>', '<span class="layui-badge">火</span>', ''];
		$options = array(array("txt"=>"热","span"=>"layui-badge layui-bg-orange"),array("txt"=>"火","span"=>"layui-badge"),"");
		$new_records = [];
		$ids=array();
		foreach($records as $record){
			// 随机函数，这里使用 mt_rand() 因为它通常比 rand() 具有更好的随机性
			// 产生 0 到 count($options) - 1 的随机索引
			$randomIndex = mt_rand(0, count($options) - 1);
			// 使用随机索引从数组中取出一个选项
			$selectedOption = $options[$randomIndex];
			$record["selectedOption"] = $selectedOption;
			$record["title"] = truncateStringWithEllipsis($record["title"],30);
			array_push($ids,$record["id"]);
			array_push($new_records, $record);
		}
        $this->updateViews($ids);
		return $new_records;
	}
	// 时间格式
    function timeToRelativeString($timestamp) {
        if (!is_numeric($timestamp) || $timestamp <= 0) {
            // 这里可以根据实际情况进行错误处理，比如抛出一个自定义的异常或者记录错误日志并返回一个默认值等
            return "";
        }
        // 将时间戳转换为当前时区的 DateTime 对象
        $time = new DateTime("@$timestamp");
        // 获取当前时间的 DateTime 对象
        $now = new DateTime();
        // 计算两个时间点之间的间隔
        $interval = $now->diff($time);
    
        if ($interval->y > 0) {
            // 如果差值超过1年，按照“年月日”格式返回
            return $time->format('Y年m月d日');
        } elseif ($interval->m > 0) {
            // 如果差值超过1个月但不超过1年，按照“年月日”格式返回
            return $time->format('Y年m月d日');
        } elseif ($interval->d >= 1) {
            // 如果差值超过1天但不超过1个月，返回天数
            return $interval->d . "天前";
        } elseif ($interval->h >= 1) {
            // 如果差值超过1小时但不超过24小时，返回小时数
            return $interval->h . "小时前";
        } else {
            // 如果差值小于1小时，返回分钟数
            return $interval->i . "分钟前";
        }
    }
	// 首页顶部右侧推荐
	function getRightNavs(){
		$new_records = [];
		$ids=array();
        $qtp = new QtPromotion();
        $source = new QtSources();
        $index_top_right = $qtp->findAll(array("position"=>"index_top_right","promotion_status"=>2));
        if($index_top_right == false){
            return $new_records;
        }
        foreach($index_top_right as $record){
            
            $rec = $source->find(array("id"=>$record["medium_id"]));
            if($rec == false){
                continue;
            }
            
            $thumbnail = !empty($rec["thumbnail"])?json_decode($rec["thumbnail"],true):$this->config["default_thumbnail"];
			$rec["thumbnail"] = $thumbnail[0]["img"];
			$rec["description"] = truncateStringWithEllipsis(strip_tags($rec["description"]),30);
			array_push($ids,$rec["id"]);
            array_push($new_records, $rec);
        }
		$this->updateViews($ids);
        return $new_records;
	}
	function getFileNames($directory) {
        $fileNames = [];
        if (is_dir($directory)) {
            $files = scandir($directory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $fileNames[] = $file;
                }
            }
        } else {
            echo "错误：指定的路径不是一个有效的目录。";
        }
        return $fileNames;
    }
    function getRandomFileNames($directory, $limit = 10) {
        $fileNames = [];
        if (is_dir($directory)) {
            $files = scandir($directory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && is_file($directory . '/' . $file)) {
                    $fileNames[] = str_replace(".html","",$file);
                }
            }
            
            // 打乱文件数组顺序
            shuffle($fileNames);
            
            // 截取前$limit个文件
            return array_slice($fileNames, 0, $limit);
        } else {
            echo "错误：指定的路径不是一个有效的目录。";
            return [];
        }
    }
    /**
     * 首页
     */
	function actionIndex(){
	    // 获取智能体展示区数据
	    $this->agentData = $this->getAgentDisplayData();
        // print_r($this->agentData);exit();

        // 获取公众号展示区域数据
        $this->wechatData = $this->getWechatDisplayData('','index');
        // 获取小程序展示区域数据
        $this->miniProgramData = $this->getMiniProgramDisplayData('all', 1, 1);

        // 获取小游戏展示区域数据
        $this->gameData = $this->getGameDisplayData("",1,"index");
        // 获取文章展示区域数据
        $this->articleData = $this->getArticleDisplayData();
        // 获取精选推荐区域数据
        $this->featuredData = $this->getFeaturedDisplayData();
	    
	   
	}
	function getAdInfo(){
	    // 获取广告信息流第1、2、3条
        $qtp = new QtPromotion();
        $source = new QtSources();
        $ad_records = array();
        $index_feed_first = $qtp->find(array("position"=>"index_feed_first","promotion_status"=>2));
        if($index_feed_first == false){
            $ad_records["index_feed_first"] = false;
        }else{
            $medium_id = $index_feed_first["medium_id"];
            $rec = $source->find(array("id"=>$medium_id));
            $rec["thumbnail"] = !empty($rec["thumbnail"])?json_decode($rec["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));	
    		if(count($rec["thumbnail"])>0){
    			$rec["thumbnail"] = $rec["thumbnail"][0]["img"];
    		}else{
    			$rec["thumbnail"] = "";
    		}
		    $rec["describe_images"] = !empty($rec["describe_images"])?json_decode($rec["describe_images"],true):false;	
            $rec["create_time"] = $this->timeToRelativeString($rec["create_time"]);
            $rec["publish_time"] = $this->timeToRelativeString($rec["publish_time"]);
            $rec["content_type_text"] = constant('ContentType::' . $rec["content_type"]);
            $rec["content_type_color"] = constant('ContentTypeColor::'.$rec["content_type"]);
            $ad_records["index_feed_first"] = $rec;
        }
        $index_feed_second = $qtp->find(array("position"=>"index_feed_second","promotion_status"=>2));
        if($index_feed_second == false){
            $ad_records["index_feed_second"] = false;
        }else{
            $medium_id = $index_feed_second["medium_id"];
            $rec = $source->find(array("id"=>$medium_id));
            $rec["thumbnail"] = !empty($rec["thumbnail"])?json_decode($rec["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));	
    		if(count($rec["thumbnail"])>0){
    			$rec["thumbnail"] = $rec["thumbnail"][0]["img"];
    		}else{
    			$rec["thumbnail"] = "";
    		}
		    $rec["describe_images"] = !empty($rec["describe_images"])?json_decode($rec["describe_images"],true):false;	
            $rec["create_time"] = $this->timeToRelativeString($rec["create_time"]);
            $rec["publish_time"] = $this->timeToRelativeString($rec["publish_time"]);
            $rec["content_type_text"] = constant('ContentType::' . $rec["content_type"]);
            $rec["content_type_color"] = constant('ContentTypeColor::'.$rec["content_type"]);
            $ad_records["index_feed_second"] = $rec;
        }
        $index_feed_third = $qtp->find(array("position"=>"index_feed_third","promotion_status"=>2));
        if($index_feed_third == false){
            $ad_records["index_feed_third"] = false;
        }else{
            $medium_id = $index_feed_third["medium_id"];
            $rec = $source->find(array("id"=>$medium_id));
            $rec["thumbnail"] = !empty($rec["thumbnail"])?json_decode($rec["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));	
    		if(count($rec["thumbnail"])>0){
    			$rec["thumbnail"] = $rec["thumbnail"][0]["img"];
    		}else{
    			$rec["thumbnail"] = "";
    		}
		    $rec["describe_images"] = !empty($rec["describe_images"])?json_decode($rec["describe_images"],true):false;	
            $rec["create_time"] = $this->timeToRelativeString($rec["create_time"]);
            $rec["publish_time"] = $this->timeToRelativeString($rec["publish_time"]);
            $rec["content_type_text"] = constant('ContentType::' . $rec["content_type"]);
            $rec["content_type_color"] = constant('ContentTypeColor::'.$rec["content_type"]);
            $ad_records["index_feed_third"] = $rec;
        }
        // 获取顶部滚动广告列表，此列表最多显示10个推荐资源（具体由后台定时任务处理）
        $index_feed_top_scroll = $qtp->findAll(array("position"=>"index_feed_top_scroll","promotion_status"=>2));
        if($index_feed_top_scroll == false){
            $ad_records["index_feed_top_scroll"] = false;
        }else{
            $arr_index_feed_top_scroll = [];
            foreach($index_feed_top_scroll as $ifts){
                $medium_id = $ifts["medium_id"];
                $rec = $source->find(array("id"=>$medium_id));
                $rec["thumbnail"] = !empty($rec["thumbnail"])?json_decode($rec["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));	
    		if(count($rec["thumbnail"])>0){
    			$rec["thumbnail"] = $rec["thumbnail"][0]["img"];
    		}else{
    			$rec["thumbnail"] = "";
    		}
		    $rec["describe_images"] = !empty($rec["describe_images"])?json_decode($rec["describe_images"],true):false;	
                $rec["create_time"] = $this->timeToRelativeString($rec["create_time"]);
                $rec["publish_time"] = $this->timeToRelativeString($rec["publish_time"]);
                $rec["content_type_text"] = constant('ContentType::' . $rec["content_type"]);
                $rec["content_type_color"] = constant('ContentTypeColor::'.$rec["content_type"]);
                array_push($arr_index_feed_top_scroll,$rec);
            }
            $ad_records["index_feed_top_scroll"] = $arr_index_feed_top_scroll;
        }
        return $ad_records;
	}
	// 首页
	function actionIndexV(){
        $this->token = isset($_COOKIE["auth_quntui_token"]) ? $_COOKIE["auth_quntui_token"] : "";
		$ZdBanner = new ZdBanner();
		      
		$nowTime = strtotime(date("Y-m-d H:i:s"));
		$condition_banner = ' start <= '.$nowTime.' and end >= '.$nowTime.' and bannerType in(1,4) ';
        $this->banners = $ZdBanner->findAll($condition_banner,"id desc");
		// 获取首页推荐分类列表
		$this->topNav = $this->getTopNavs();
		
		// 今日热榜
		$this->hotList = $this->getHotList();

		// 顶部右侧推荐(广告席位9个)
		$this->rightNav = $this->getRightNavs();
		if(count($this->rightNav)<9){
		    $this->showAdTop = true;
		}else{
		    $this->showAdTop = false;
		}
		
		// 获取网站广告
		$this->adsites = $ZdBanner->query("SELECT a.*,b.thumb FROM qt_adsm a,qt_sites b WHERE a.ad_type=2 AND a.site_id=b.id ORDER BY a.id desc LIMIT 9");
		// 获取智能体广告
		$adagent_data = $ZdBanner->query("SELECT a.*,b.title,b.description,b.thumbnail FROM qt_agent_ad a,qt_sources b WHERE a.status=2 AND a.source_id=b.id ORDER BY a.id desc LIMIT 9");
		if($adagent_data != false && count($adagent_data)>0){
		    $newAdAgent = [];
		    foreach ($adagent_data as $agent){
		        $thumbnail = !empty($agent["thumbnail"])?json_decode($agent["thumbnail"],true):$this->config["default_thumbnail"];
        		if(count($thumbnail)>0){
                    $agent["thumbnail"] = $thumbnail[0]["img"]; 
        		}else{
        		    $agent["thumbnail"] = "";
        		}
        		array_push($newAdAgent,$agent);
		    }
    		
    		$this->adagent = $newAdAgent;
		}else{
		    
    		$this->adagent = $adagent_data;
		}
		
    }
    
    /**
     * 生成token
     */
    function generateToken($userId, $duration = 86400) {
        // 设置 JWT 的 Payload 信息
        $payload = array(
            "iss" => "www.phoenixfm.cn", // 签发者
            "aud" => "www.phoenixfm.cn", // 接收方
            "iat" => time(), // 签发时间
            "exp" => time() + $duration, // 过期时间
            "userId" => $userId // 你可以根据需要添加更多信息
        );
    
        // 生成 JWT
        $jwt = JWT::encode($payload, $this->secretKey, 'HS256',$this->secretKey);
        
        return $jwt;
    }
    // 微博登录（移动）
    function actionLoginSinaMobile(){}
    // 登录
    function actionLogin(){
        // 如果有推广代码，将推广代码写到cookie中
        $ref = arg("ref","");
        if(!empty($ref)){
            setcookie("auth_quntui_ref", $ref, time() + 86400*30, "/");
        }else{
            setcookie("auth_quntui_ref", "", time() + 86400*30, "/");
        }
    }
    // 微博登录
    function actionLoginSina(){
        $code = arg("code","");
        $ref = isset($_COOKIE["auth_quntui_ref"])?$_COOKIE["auth_quntui_ref"]:"";
        if(empty($code)){
            $this->errormsg = "授权登录失败，请稍后再试！";
            $this->icon = '<div class="ax-result ax-error"><i class="ax-iconfont ax-icon-close-o"></i></div>';
            $this->display("main_error.html");
			exit();
        }
        $url = "https://api.weibo.com/oauth2/access_token";
        $result = sendPost($url,array(
            "client_id"=>"976601347",
            "client_secret"=>"f14e316439540d87e55ed35a4a0cc655",
            "grant_type"=>"authorization_code",
            "redirect_uri"=>"http://www.phoenixfm.cn/pc/main/loginsina.html",
            "code"=>$code
        ));
        if(empty($result)){
            $this->errormsg = "授权登录失败，请稍后再试！";
            $this->icon = '<div class="ax-result ax-error"><i class="ax-iconfont ax-icon-close-o"></i></div>';
            $this->display("main_error.html");
			exit();
        }
        $result = json_decode($result,true);
        //print_r($result);exit();
        $access_token = $result["access_token"];
        $sina_uid = $result["uid"];
        $redisObj = new ZDRedis();
        $redisObj->set("sina_access_token",$access_token,7000);
        // 获取用户信息完成登录
        $url_user = "https://api.weibo.com/2/users/show.json?access_token=".$access_token."&uid=".$sina_uid;
        $userInfo = sendGet($url_user);
        if(empty($userInfo)){
            $this->errormsg = "授权登录失败，请稍后再试！";
            $this->icon = '<div class="ax-result ax-error"><i class="ax-iconfont ax-icon-close-o"></i></div>';
            $this->display("main_error.html");
			exit();
        }
        $qt_users = new qt_users();
        $qt_user_redeemed_coupons = new QtUserRedeemedCoupons();
        $userInfo = json_decode($userInfo,true);
        $user_id = generateUUID();
        $randomNumber = mt_rand(1, 12);
        $avatar = "/i/img/avatar/userAvatar$randomNumber.png";
        $nickName = $userInfo["name"];
        if(empty($nickName)){
            $nickName = "火羽Hubird友";
        }
        $discount_code = generateUUID(9);
        $local_user = $qt_users->find(array("source"=>3,"reg_type"=>3,"unionid"=>$sina_uid));
        if($local_user == false){
            $addid = $qt_users->create(array(
                "userId"=>$user_id,
                "avatar_file"=>$avatar,
                "reg_time"=>time(),
                "reg_ip"=>getIp(),
                "last_login"=>time(),
                "last_ip"=>getIp(),
                "status"=>1,
                "nickName"=>$nickName,
                "unionid"=>$sina_uid,
                "source"=>3,
                "reg_type"=>3,
                "discount_code"=>$discount_code,
                "discount_code_cr_ip"=>getIp()
            ));
            if($addid){
                // 如果有推广代码
                if(isset($ref) && !empty($ref)){
                    // 验证ref
                    $ref_result = $qt_users->find(array("discount_code"=>$ref));
                    if($ref_result != false){
                        // 验证当前IP与推荐码IP是否一致，如果一致则认为是同一个用户
                        $currentIp = getIp();
                        if($currentIp != $ref_result["discount_code_cr_ip"]){
                            // 判断是否有效用户（手机号登录或者微博登录）
                            if(!empty($sina_uid)){
                                // 微博登录用户 视为有效用户，进行如下逻辑处理
                                /**
                                 * 1、当前注册用户发放一张5折优惠券，并给账户增加50积分；
                                 * 2、判断当前邀请人共邀请了多少人，邀请一个人，奖励一张首单5折优惠券和50积分，超过3个人的判断是否给过1折券，如果没给过，奖励1折券
                                */
                                // 当前用户（被邀请人）奖励一张优惠券
                                sendCoupons($addid,"9E24F7FD",false);
                                sendMessage($addid,'','coupon_send');
                                // 当前用户（被邀请人）奖励50积分 并且更新推荐人
                                $qt_users->update(array("id"=>$addid),array(
                                    "referred_by"=>$ref_result["id"],
                                    "level"=>($ref_result["level"]/1+1),
                                    "blance"=>50
                                ));
                                scoreRecodsLog($addid,"+50","注册奖励","income");
                                sendMessage($addid,['注册奖励',50],'score_send');
                                // 邀请人奖励发放
                                $refcount = $qt_users->findCount(array("referred_by"=>$ref_result["id"]));
                                if($refcount==1){
                                    // 奖励首单5折优惠券和50积分
                                    sendCoupons($ref_result["id"],"9E24F7FD",false);
                                    sendMessage($ref_result["id"],'','coupon_send');
                                }else if($refcount>=3){
                                    // 判断被邀请人是否有消费
                                    $refusers = $qt_users->findAll(array("referred_by"=>$ref_result["id"]),"id desc","id");
                                    $isconsu = true;
                                    $qt_user_consume_log = new QtUserConsumeLog();
                                    foreach ($refusers as $u){
                                        $quclc = $qt_user_consume_log->findCount(array("user_id"=>$u["id"]));
                                        if($quclc == 0){
                                            $isconsu = false;
                                        }
                                    }
                                    // 奖励首单1折优惠券
                                    sendMessage($ref_result["id"],'','coupon_send');
                                    if($isconsu){
                                        // 被邀请人都有消费 奖励1折优惠券
                                        sendCoupons($ref_result["id"],"59F11939",false);
                                        sendMessage($ref_result["id"],'','coupon_send');
                                    }
                                }
                                // 每邀请成功一个人奖励50积分
                                $qt_users->update(array("id"=>$ref_result["id"]),array(
                                    "blance"=>50+$ref_result["blance"]/1
                                ));
                                sendMessage($ref_result["id"],['成功邀请用户注册奖励',50],'score_send');
                                scoreRecodsLog($ref_result["id"],"+50","成功邀请用户注册奖励","income");
                            }
                        }
                    }
                    // 新用户限时优惠
                    $limittime = 1730217600;//10月30日之前生效
                    if(time()<$limittime){
                        // 赠送10000积分，增加5折优惠券，站内广告位每个位置赠送一个优惠券
                        // 当前用户奖励优惠券
                        sendCoupons($addid,"B2415F82",false);
                        sendCoupons($addid,"96C87E05",false);
                        sendCoupons($addid,"3E4C4012",false);
                        sendCoupons($addid,"CEB3EDF0",false);
                        sendCoupons($addid,"446B3957",false);
                        sendCoupons($addid,"9E24F7FD",false);
                        sendMessage($addid,'','coupon_send');
                        // 当前用户奖励10000积分 并且更新推荐人
                        $newUser = $qt_users->find(array("id"=>$addid));
                        $new_blance = $newUser["blance"]/1+10000;
                        $qt_users->update(array("id"=>$addid),array(
                            "blance"=>$new_blance
                        ));
                        scoreRecodsLog($addid,"+10000","注册奖励","income");
                        sendMessage($addid,['注册奖励',10000],'score_send');
                    }
                }
                $token = $this->generateToken($user_id);
                setcookie("auth_quntui_token", $token, time() + 86400*30, "/");
                $this->jump(url("pc/main","index"));
            }else{
                $this->errormsg = "授权登录失败，请稍后再试！";
                $this->icon = '<div class="ax-result ax-error"><i class="ax-iconfont ax-icon-close-o"></i></div>';
                $this->display("main_error.html");
    			exit();
            }
        }else{
            $token = $this->generateToken($local_user["userId"]);
            setcookie("auth_quntui_token", $token, time() + 86400*30, "/");
            $this->jump(url("pc/main","index"));
        }
    }
    // 取消授权
    function actioncancelloginsina(){}
    // 反馈信息
    function actionFeedBack(){
        // 获取用户的反馈历史记录
        $QtUserFeedback = new QtUserFeedback();
        $feedback_list = $QtUserFeedback->findAll(
            array("user_id" => $this->user["id"]), 
            "create_time DESC"
        );
        
        // 格式化时间显示
        foreach ($feedback_list as &$feedback) {
            $feedback["create_time"] = date('Y-m-d H:i:s', $feedback["create_time"]); 
        }
        
        $this->feedback_list = $feedback_list;
        $this->feedback_count = count($feedback_list);
        
        $this->display("pc/user_feedback.html");
    }


    // 提交问题反馈
    /**
     * 获取用户积分余额（AJAX）
     */
    function actionGetUserPoints() {
        // 设置响应头为JSON格式
        header('Content-Type: application/json');
        
        try {
            // 检查用户是否已登录
            if (!$this->user) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '请先登录'
                ));
                exit();
            }
            
            // 获取用户积分
            $points = $this->user["blance"];
            
            echo json_encode(array(
                'success' => true,
                'points' => $points
            ));
            
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误：' . $e->getMessage()
            ));
        }
        
        exit();
    }
    
    function actionsubmitFeedback(){
        // 设置响应头为JSON格式
        header('Content-Type: application/json; charset=utf-8');
        
        try {
            // 检查用户是否已登录
            if (!$this->user) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '请先登录后再提交反馈'
                ), JSON_UNESCAPED_UNICODE);
                exit();
            }
            
            // 获取POST数据
            $content = trim(arg('content', ''));
            
            // 验证数据
            if (empty($content)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '反馈内容不能为空'
                ), JSON_UNESCAPED_UNICODE);
                exit();
            }
            
            if (mb_strlen($content, 'UTF-8') < 10) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '反馈内容至少需要10个字符'
                ), JSON_UNESCAPED_UNICODE);
                exit();
            }
            
            if (mb_strlen($content, 'UTF-8') > 500) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '反馈内容不能超过500个字符'
                ), JSON_UNESCAPED_UNICODE);
                exit();
            }
            
            // 创建反馈记录
            $QtUserFeedback = new QtUserFeedback();
            $feedbackData = array(
                'user_id' => $this->user['id'],
                'content' => $content,
                'create_time' => time(),
                'update_time' => date('Y-m-d H:i:s')
            );
            
            $result = $QtUserFeedback->create($feedbackData);
            
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'message' => '反馈提交成功，我们会尽快处理您的问题！'
                ), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => '反馈提交失败，请稍后再试'
                ), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误：' . $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
        
        exit();
    }
    /**
     * 获取树形结构
     */
    function getAmisCompatibleTree($pid = 0) {
		// 尝试从缓存中获取数据
		$redis = new ZDRedis();
		$cacheKey = "amis_tree_$pid";
        $cachedTree = $redis->get($cacheKey);
        if ($cachedTree!== false) {
            return json_decode($cachedTree, true);
        }
        $tree = [];
        $ZdCategory = new ZdCategory();
        $results = $ZdCategory->query("SELECT id, categoryName, pid, isLeaf, level, categoryType, sort FROM zd_category WHERE pid = ".$pid." and categoryName<>'' and categoryName is not Null ORDER BY sort ASC");
        foreach ($results as $row) {
            $node = [
                'label' => $row['categoryName'],  // 节点显示的文本
                'value' => $row['id'],            // 节点的值，通常是唯一标识符
                'isLeaf' => $row['isLeaf'] == 1,  // 是否是叶子节点
                'children' => [],                 // 子节点数组
                'level' => $row['level'],         // 节点的层级
                'type' => $row['categoryType'],   // 分类类型
                'sort' => $row['sort']            // 排序字段
            ];
            if (!$node['isLeaf']) {
                $node['children'] = $this->getAmisCompatibleTree($row['id']);
            }
            $tree[] = $node;
        }
        $redis->set($cacheKey, json_encode($tree));
        return $tree;
    }
    // 图片列表
    function actionListimages(){
        $QtSources = new QtSources(); 
        $page = (int)arg("page",1);
		if($page>16){
		    $page = 16;
		}
		$this->page = $page;
		$condition = array("content_status"=>1,"content_type"=>"image");
		$records = $QtSources->findAll($condition,"publish_time desc,weight desc","content_url,content_type,id,title,thumbnail,category_name,category_id,publish_time,description,views,dialogue_count,user_nums,shares,likes",array($page, 30));
		$pager = $QtSources->page;
		$new_records = [];
		$ids=array();
		foreach($records as $record){
			$record["publish_time"] = $this->timeToRelativeString($record["publish_time"]);
			$record["dialogue_count"] = format_number($record["dialogue_count"]);
			$record["user_nums"] = format_number($record["user_nums"]);
			$thumbnail = !empty($record["thumbnail"])?json_decode($record["thumbnail"],true):$this->config["default_thumbnail"];
			
			if(count($thumbnail)>0){
                $record["thumbnail"] = $thumbnail[0]["img"]; 
			}else{
			    $record["thumbnail"] = "";
			}
			array_push($ids,$record["id"]);
			array_push($new_records, $record);
		}
		$this->updateViews($ids);
        if($pager == false){
            $pager = array("total_count"=>0,"page_size"=>35,"total_page"=>1);
        }
		$this->records=$new_records;
		$this->pager=$pager;
    }
	// 列表（智能体、公众号、小程序、小游戏）
	function actionList(){
		$ct = arg("ct",314);
		$this->ct = $ct;
		
        if($ct/1 == 314){
            // 获取智能体推荐位数据，包括置顶推荐位一个，普通推荐位11个
            $this->new_records = $this->get_recommend_agents();
            $this->display("pc/main_agents.html");
        }else if($ct/1 == 11){
            // 获取公众号推荐位数据，包括置顶推荐位一个，普通推荐位6个
            $new_records = $this->get_recommend_officials();
            $this->display("pc/main_official.html");
        }else if($ct/1 == 243){
            $content_type = "xcx";
            // 获取微信小程序推荐位数据，6个推荐位
            // $new_records = $this->get_recommend_miniprograms();
            $this->display("pc/main_miniprograms.html");
        }else if($ct/1 == 244){
            $content_type = "xyx";
            // 获取游戏推荐位数据，4个普通推荐位，1个置顶推荐位
            // $new_records = $this->get_recommend_games();
            $this->display("pc/main_games.html");
        }
	}
	function action404(){}
	// 详情页面
	function actionDetails(){
        $id = arg("id","");
        $QtSources = new QtSources();
        $record = $QtSources->find(["id"=>$id]);
        if($record == false){
            $this->display("pc/404.html");
            exit();
        }
        // 如果状态不是正常，则返回404
        if($record["content_status"] != 1){
            $this->display("pc/404.html");
            exit();

        }
        $this->config["site_title"] = $record["title"]."-".$this->config["site_title"];
        $this->config["site_keywords"] = $record["tags"]."-".$this->config["site_keywords"];
        $this->config["site_description"] = $record["description"]."-".$this->config["site_description"];
        $record["thumbnail"] = !empty($record["thumbnail"])?json_decode($record["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));	
        $thus = [];
        if(count($record["thumbnail"])>0){
            $thus = $record["thumbnail"];
            $record["thumbnail"] = $record["thumbnail"][0]["img"];
            
        }else{
            $record["thumbnail"] = "";
        }
        
        $record["describe_images"] = !empty($record["describe_images"])?json_decode($record["describe_images"],true):false;
        	
        $record["publish_time"] = $this->timeToRelativeString($record["publish_time"]);
        $record["update_time"] = $this->timeToRelativeString($record["update_time"]);
        $record["description"] = strip_tags($record["description"]);
        $record["title"] = strip_tags($record["title"]);
        if(!empty($record["content"])){
            $parsedown = new Parsedown();
            $record["content"] = $parsedown->text($record["content"]);
            
            $html_thum = "<p style=\"text-align: center;\">";
            if(!empty($thus)){
                foreach ($thus as $thum){
                    $html_thum .= "<img style=\"height:300px !important;\" src=\"".$thum["img"]."\" />";
                }
            }
            $html_thum .= "</p>";
            $record["content"] = htmlspecialchars_decode($record["content"]);
            $record["content"] = strip_tags($record["content"], '<html><head><body><div><p><a><img><h1><h2><h3><h4><h5><h6><ul><ol><li><span><strong><em><b><i><u><table><tr><td><th><form><input><textarea><button><select><option>');
            $record["content"] = $html_thum.$record["content"];
            $record["content"] = $record["content"]."本站由 <a href=\"https://www.phoenixfm.cn\" target=\"_blank\">Phoenixfm.cn</a> 强力驱动";
        }
        // print_r($record["describe_images"]);
        // description字段增加本站相关信息有助于SEO
        $record["description"] = $record["description"]." 本站由 <a href=\"https://www.phoenixfm.cn\" target=\"_blank\">Phoenixfm.cn</a> 强力驱动";
        if($record["content_type"] == "xyx"){
            $describe_images = array();
            for($i=0;$i<count($record["describe_images"]);$i++){
                $_item = $record["describe_images"][$i];
                $_img = json_decode($_item["img"],true);
                array_push($describe_images,array("img"=>empty($_img["img"])?"":$_img["img"]));
            }
            $record["describe_images"] = $describe_images;
        }
        
        $this->record = $record;
        if($record["content_type"] == "agent"){
            // 获取相关推荐数据
            $this->related_agents = $this->get_related_data("agent", $record["category_name"], 5, $record["id"]);
            $this->display("pc/detail_agent.html");
        }else if($record["content_type"] == "xyx"){
            // 获取相关推荐数据
            $this->related_games = $this->get_related_data("xyx", $record["category_name"], 5, $record["id"]);
            
            $this->display("pc/detail_game.html");
        }else if($record["content_type"] == "article"){
            // 获取相关推荐数据
            $this->related_articles = $this->get_related_data("article", $record["category_name"], 5, $record["id"]);
            $this->display("pc/detail_article.html");
        }else if($record["content_type"] == "gzh"){
            // 获取相关推荐数据
            $this->related_officials = $this->get_related_data("gzh", $record["category_name"], 5, $record["id"]);
            $this->display("pc/detail_official.html");
        }else if($record["content_type"] == "xcx"){
            // 获取相关推荐数据
            $this->related_miniprograms = $this->get_related_data("xcx", $record["category_name"], 5, $record["id"]);
            $this->display("pc/detail_miniprogram.html");
        }else{
            $this->display("pc/404.html");
            exit();
        }
    }
	// 免费收录
	function actionSubmit(){}

    // 充值记录
    function actionrecharge(){
        // 创建模型实例
        $QtUserPayLog = new QtUserPayLog();
        
        // 获取当前用户的充值记录，按充值时间倒序排列
        $recharge_records = $QtUserPayLog->findAll(
            array("user_id" => $this->user["id"]), 
            "pay_time DESC"
        );
        
        // 处理充值记录数据
        $processed_records = array();
        foreach ($recharge_records as $record) {
            // 支付渠道文本
            switch($record["pay_channel"]) {
                case 0:
                    $record["pay_channel_text"] = "支付宝";
                    break;
                case 1:
                    $record["pay_channel_text"] = "微信";
                    break;
                default:
                    $record["pay_channel_text"] = "未知";
                    break;
            }
            
            // 商品类型文本
            switch($record["product_type"]) {
                case 0:
                    $record["product_type_text"] = "屋币";
                    break;
                case 1:
                    $record["product_type_text"] = "包年VIP";
                    break;
                default:
                    $record["product_type_text"] = "未知";
                    break;
            }
            
            // 格式化金额（单位：分转元）
            $record["amount_yuan"] = $record["amount"] / 100;
            
            // 格式化时间
            $record["pay_time_format"] = date('Y-m-d H:i:s', $record["pay_time"]);
            
            $processed_records[] = $record;
        }
        
        $this->recharge_records = $processed_records;
        $this->recharge_count = count($processed_records);
        
        $this->display("pc/user_recharge.html");
    }
    
    /**
     * 用户消费记录页面
     */
    function actionuserconsumption(){
        // 创建模型实例
        $ZdConsume = new ZdConsume();
        
        // 获取当前用户的消费记录，按消费时间倒序排列
        $consumption_records = $ZdConsume->findAll(
            array("uid" => $this->user["id"]), 
            "consumeCreate DESC"
        );
        
        // 处理消费记录数据
        $processed_records = array();
        foreach ($consumption_records as $record) {
            // 消费类型文本
            switch($record["consumeType"]) {
                case 1:
                    $record["consume_type_text"] = "微信群";
                    break;
                case 2:
                    $record["consume_type_text"] = "公众号";
                    break;
                case 3:
                    $record["consume_type_text"] = "个人号";
                    break;
                case 10:
                    $record["consume_type_text"] = "智能体";
                    break;
                case 11:
                    $record["consume_type_text"] = "网站广告";
                    break;
                default:
                    $record["consume_type_text"] = "未知";
                    break;
            }
            
            // 格式化时间
            $record["consume_time_format"] = date('Y-m-d H:i:s', strtotime($record["consumeCreate"]));
            
            $processed_records[] = $record;
        }
        
        $this->consumption_records = $processed_records;
        $this->consumption_count = count($processed_records);
        
        $this->display("pc/user_consumption.html");
    }
	/**
	 * 获取推荐智能体列表
	 * @param int $limit 返回数量，默认10条
	 * @return array 推荐的智能体列表
	 */
	function get_recommend_agents($limit = 11) {
		$QtSources = new QtSources();
		
		// 获取推荐的智能体，按权重和发布时间排序
		$agents = $QtSources->query(
			"SELECT author,id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, user_nums, shares, likes, stars, price, sale_type, weight 
			 FROM qt_sources 
			 WHERE content_status = 1 AND content_type = 'agent' 
			 ORDER BY weight DESC, publish_time DESC 
			 LIMIT " . intval($limit)
		);
		
		// 处理智能体数据
		$processedAgents = array();
		foreach ($agents as $agent) {
			// 处理缩略图
			$thumbnail = !empty($agent["thumbnail"]) ? json_decode($agent["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
			if (count($thumbnail) > 0) {
				$agent["thumbnail"] = $thumbnail[0]["img"];
			} else {
				$agent["thumbnail"] = $this->config["default_thumbnail"];
			}
			
			// 处理时间显示
			$agent["publish_time"] = $this->timeToRelativeString($agent["publish_time"]);
			
			// 格式化数字
			$agent["views"] = format_number($agent["views"]);
			$agent["dialogue_count"] = format_number($agent["dialogue_count"]);
			$agent["user_nums"] = format_number($agent["user_nums"]);
			$agent["likes"] = format_number($agent["likes"]);
			
			// 添加评分信息
			if (!isset($agent["stars"]) || empty($agent["stars"])) {
				$agent["rating"] = $this->generateRating();
			} else {
				$agent["rating"] = array(
					"score" => floatval($agent["stars"]),
					"count" => intval(0),
					"stars" => $this->generateStars(floatval($agent["stars"]))
				);
			}
			
			// 格式化价格
			if ($agent['price'] == 0) {
				$agent['price_display'] = '免费';
			}  else {
				$agent['price_display'] = '¥' . $agent['price'] . '/月';
			}
			// 返回用户随机头像，使用https://picsum.photos/id/101/40/40进行随机设置
            $agent['avatar'] = 'https://picsum.photos/id/' . rand(1, 100) . '/40/40';
			$processedAgents[] = $agent;
		}
		
		return $processedAgents;
	}
	
	/**
	 * 获取推荐公众号列表
	 * @param int $limit 返回数量，默认7条
	 * @return array 推荐的公众号列表
	 */
	function get_recommend_officials($limit = 7) {
		$QtSources = new QtSources();
		
		// 获取推荐的公众号，按权重和发布时间排序
		$officials = $QtSources->query(
			"SELECT id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, user_nums, shares, likes, stars, price, sale_type, weight 
			 FROM qt_sources 
			 WHERE content_status = 1 AND content_type = 'gzh' 
			 ORDER BY weight DESC, publish_time DESC 
			 LIMIT " . intval($limit)
		);
		
		// 处理公众号数据
		$processedOfficials = array();
		foreach ($officials as $official) {
			// 处理缩略图
			$thumbnail = !empty($official["thumbnail"]) ? json_decode($official["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
			if (count($thumbnail) > 0) {
				$official["thumbnail"] = $thumbnail[0]["img"];
			} else {
				$official["thumbnail"] = $this->config["default_thumbnail"];
			}
			
			// 处理时间显示
			$official["publish_time"] = $this->timeToRelativeString($official["publish_time"]);
			
			// 格式化数字
			$official["views"] = format_number($official["views"]);
			$official["dialogue_count"] = format_number($official["dialogue_count"]);
			$official["user_nums"] = format_number($official["user_nums"]);
			$official["likes"] = format_number($official["likes"]);
			
			// 添加评分信息
			if (!isset($official["stars"]) || empty($official["stars"])) {
				$official["rating"] = $this->generateRating();
			} else {
				$official["rating"] = array(
					"score" => floatval($official["stars"]),
					"count" => intval(0),
					"stars" => $this->generateStars(floatval($official["stars"]))
				);
			}
			
			$processedOfficials[] = $official;
		}
		
		return $processedOfficials;
	}
	
	/**
	 * 获取推荐小程序列表
	 * @param int $limit 返回数量，默认6条
	 * @return array 推荐的小程序列表
	 */
	function get_recommend_miniprograms($limit = 6) {
		$QtSources = new QtSources();
		
		// 获取推荐的小程序，按权重和发布时间排序
		$miniprograms = $QtSources->query(
			"SELECT id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, user_nums, shares, likes, rating_score, price, price_type, weight 
			 FROM qt_sources 
			 WHERE content_status = 1 AND content_type = 'xcx' 
			 ORDER BY weight DESC, publish_time DESC 
			 LIMIT " . intval($limit)
		);
		
		// 处理小程序数据
		$processedMiniprograms = array();
		foreach ($miniprograms as $miniprogram) {
			// 处理缩略图
			$thumbnail = !empty($miniprogram["thumbnail"]) ? json_decode($miniprogram["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
			if (count($thumbnail) > 0) {
				$miniprogram["thumbnail"] = $thumbnail[0]["img"];
			} else {
				$miniprogram["thumbnail"] = $this->config["default_thumbnail"];
			}
			
			// 处理时间显示
			$miniprogram["publish_time"] = $this->timeToRelativeString($miniprogram["publish_time"]);
			
			// 格式化数字
			$miniprogram["views"] = format_number($miniprogram["views"]);
			$miniprogram["dialogue_count"] = format_number($miniprogram["dialogue_count"]);
			$miniprogram["user_nums"] = format_number($miniprogram["user_nums"]);
			$miniprogram["likes"] = format_number($miniprogram["likes"]);
			
			// 添加评分信息
			if (!isset($miniprogram["rating_score"]) || empty($miniprogram["rating_score"])) {
				$miniprogram["rating"] = $this->generateRating();
			} else {
				$miniprogram["rating"] = array(
					"score" => floatval($miniprogram["rating_score"]),
					"count" => intval($miniprogram["rating_count"] ?? 0),
					"stars" => $this->generateStars(floatval($miniprogram["rating_score"]))
				);
			}
			
			$processedMiniprograms[] = $miniprogram;
		}
		
		return $processedMiniprograms;
	}
	
	/**
	 * 获取推荐游戏列表
	 * @param int $limit 返回数量，默认5条
	 * @return array 推荐的游戏列表
	 */
	function get_recommend_games($limit = 5) {
		$QtSources = new QtSources();
		
		// 获取推荐的游戏，按权重和发布时间排序
		$games = $QtSources->query(
			"SELECT id, title, thumbnail, category_name, publish_time, description, views, dialogue_count, user_nums, shares, likes, rating_score, price, price_type, weight 
			 FROM qt_sources 
			 WHERE content_status = 1 AND content_type = 'xyx' 
			 ORDER BY weight DESC, publish_time DESC 
			 LIMIT " . intval($limit)
		);
		
		// 处理游戏数据
		$processedGames = array();
		foreach ($games as $game) {
			// 处理缩略图
			$thumbnail = !empty($game["thumbnail"]) ? json_decode($game["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
			if (count($thumbnail) > 0) {
				$game["thumbnail"] = $thumbnail[0]["img"];
			} else {
				$game["thumbnail"] = $this->config["default_thumbnail"];
			}
			
			// 处理时间显示
			$game["publish_time"] = $this->timeToRelativeString($game["publish_time"]);
			
			// 格式化数字
			$game["views"] = format_number($game["views"]);
			$game["dialogue_count"] = format_number($game["dialogue_count"]);
			$game["user_nums"] = format_number($game["user_nums"]);
			$game["likes"] = format_number($game["likes"]);
			
			// 添加评分信息
			if (!isset($game["rating_score"]) || empty($game["rating_score"])) {
				$game["rating"] = $this->generateRating();
			} else {
				$game["rating"] = array(
					"score" => floatval($game["rating_score"]),
					"count" => intval($game["rating_count"] ?? 0),
					"stars" => $this->generateStars(floatval($game["rating_score"]))
				);
			}
			
			$processedGames[] = $game;
		}
		
		return $processedGames;
	}
	
	/**
	 * 获取相关推荐数据
	 * @param string $content_type 内容类型 (agent, xyx, xcx, gzh, article)
	 * @param int $category_id 分类ID
	 * @param int $limit 返回数量，默认5条
	 * @param int $exclude_id 排除的ID
	 * @return array 相关推荐数据
	 */
	function get_related_data($content_type, $category_id, $limit = 5, $exclude_id = 0) {
		$QtSources = new QtSources();
		
		// 构建查询条件
		$sql = "select * from qt_sources where content_status=1 and content_type='".$content_type."' ";
		// 如果有分类ID，则按分类查询
		if (!empty($category_id)) {
            $sql .= "and category_name='".$category_id."' ";
		}
		
		// 排除当前内容
		if (!empty($exclude_id)) {
            $sql .= "and id != ".$exclude_id;
		}
        $sql .= " order by weight desc,id desc limit 10";
        
		$records = $QtSources->query($sql);
		// 处理数据
		$processedRecords = array();
		foreach ($records as $record) {
			// 处理缩略图
			$thumbnail = !empty($record["thumbnail"]) ? json_decode($record["thumbnail"], true) : array(array("img" => $this->config["default_thumbnail"]));
			if (count($thumbnail) > 0) {
				$record["thumbnail"] = $thumbnail[0]["img"];
			} else {
				$record["thumbnail"] = $this->config["default_thumbnail"];
			}
			
			// 处理时间显示
			$record["publish_time"] = $this->timeToRelativeString($record["publish_time"]);
			
			// 格式化数字
			$record["views"] = format_number($record["views"]);
			$record["dialogue_count"] = format_number($record["dialogue_count"]);
			$record["user_nums"] = format_number($record["user_nums"]);
			$record["likes"] = format_number($record["likes"]);
			$record["fans_count"] = format_number($record["fans_count"]);
			
			// 添加评分信息
			$record["rating"] = $this->generateRating();
			
			$processedRecords[] = $record;
		}
		
		return $processedRecords;
	}
	/**
	 * 智能体列表页面
	 */
	function actionAgents(){
		$page = (int)arg("page",1);
		if($page>16){
		    $page = 16;
		}
		$this->page = $page;
		
		$QtSources = new QtSources(); 
		$condition = array("content_status"=>1,"content_type"=>"agent");
		
		// 查询智能体数据，增加更多字段用于渲染
		$records = $QtSources->findAll($condition,"publish_time desc,weight desc","content_url,content_type,id,title,thumbnail,category_name,category_id,publish_time,description,views,dialogue_count,user_nums,shares,likes,rating_score,price,price_type,weight,tags",array($page, 30));
		
		$pager = $QtSources->page;
		$new_records = [];
		$ids = [];
		
		foreach($records as $record){
			$record["publish_time"] = $this->timeToRelativeString($record["publish_time"]);
			$record["dialogue_count"] = format_number($record["dialogue_count"]);
			$record["user_nums"] = format_number($record["user_nums"]);
			
			// 处理缩略图
			$thumbnail = !empty($record["thumbnail"]) ? json_decode($record["thumbnail"], true) : $this->config["default_thumbnail"];
			if(is_array($thumbnail) && count($thumbnail) > 0){
                $record["thumbnail"] = $thumbnail[0]["img"]; 
			}else{
			    $record["thumbnail"] = $this->config["default_thumbnail"];
			}
			
			// 处理标签
			if(!empty($record["tags"])){
				$record["tag_list"] = explode(',', $record["tags"]);
			}else{
				$record["tag_list"] = [];
			}
			
			array_push($ids, $record["id"]);
			array_push($new_records, $record);
		}
		
		$this->updateViews($ids);
		
        if($pager == false){
            $pager = array("total_count"=>0,"page_size"=>30,"total_page"=>1, "current_page"=>1);
        }
        
		// 将数据存储在模板变量中
		$this->records = array("records"=>$new_records,"pager"=>$pager);
		
		// 设置页面SEO信息
		$this->config["site_keywords"] = "AI智能体,人工智能,智能助手,办公效率,创意设计,学习教育,数据分析";
		$this->config["site_description"] = "发现最优秀的AI智能体，覆盖办公效率、创意设计、数据分析、学习教育等多个领域，让AI为您的工作和生活赋能";
		$this->config["site_title"] = "AI智能体专区 - 发现最优秀的智能体";
		
		$this->display("pc/main_agents.html");
	}
	/**
	 * 获取智能体列表数据（AJAX接口）
	 */
	function actionGetAgentsData() {
		header('Content-Type: application/json');
		
		$page = (int)arg("page",1);
		if($page>16){
		    $page = 16;
		}
		
		$QtSources = new QtSources(); 
		$condition = array("content_status"=>1,"content_type"=>"agent");
		
		// 查询智能体数据
		$records = $QtSources->findAll($condition,"publish_time desc,weight desc","content_url,content_type,id,title,thumbnail,category_name,category_id,publish_time,description,views,dialogue_count,user_nums,shares,likes,rating_score,price,price_type,weight,tags",array($page, 30));
		
		$pager = $QtSources->page;
		$new_records = [];
		$ids = [];
		
		foreach($records as $record){
			$record["publish_time"] = $this->timeToRelativeString($record["publish_time"]);
			$record["dialogue_count"] = format_number($record["dialogue_count"]);
			$record["user_nums"] = format_number($record["user_nums"]);
			
			// 处理缩略图
			$thumbnail = !empty($record["thumbnail"]) ? json_decode($record["thumbnail"], true) : $this->config["default_thumbnail"];
			if(is_array($thumbnail) && count($thumbnail) > 0){
                $record["thumbnail"] = $thumbnail[0]["img"]; 
			}else{
			    $record["thumbnail"] = $this->config["default_thumbnail"];
			}
			
			// 处理标签
			if(!empty($record["tags"])){
				$record["tag_list"] = explode(',', $record["tags"]);
			}else{
				$record["tag_list"] = [];
			}
			
			array_push($ids, $record["id"]);
			array_push($new_records, $record);
		}
		
		$this->updateViews($ids);
		
        if($pager == false){
            $pager = array("total_count"=>0,"page_size"=>30,"total_page"=>1, "current_page"=>1);
        }
        
		// 返回JSON数据
		echo json_encode(array(
			"success" => true,
			"data" => array("records"=>$new_records,"pager"=>$pager)
		));
		exit;
	}
	/**
	 * 积分购买
	 */
	function actionBuyScore(){
	    // 获取用户能使用的优惠券
	    $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $qt_user_redeemed_coupons = new QtUserRedeemedCoupons();
        $qt_discount_coupons = new QtDiscountCoupons();
        $kq = $qt_user_redeemed_coupons->findAll(array("coupon_type"=>"am","status"=>0,"user_id"=>$this->user["id"]));
        $newlist = [];
        foreach ($kq as $k){
            $coupon_code = $k["coupon_code"];
            $r = $qt_discount_coupons->find(array("status"=>"active","coupon_code"=>$coupon_code));
            array_push($newlist,$r);
        }
        
        $this->coupons = $newlist;
	}
	/**
	 * 账号中心
	 */
	function actionAccount(){
        
        $this->display("pc/user_profile.html");
	}
    /**
     * 保存用户信息
     */
    function actionsaveprofile(){
        $nickName = arg("nickname","");
        $phone = arg("phone","");
        $qq = arg("qq","");
        $email = arg("email","");
        $gender = arg("gender","");
        $bio = arg("bio","");
        $avatarurl = arg("avatarurl","");
        $user = $this->user;
        
        $QtUser = new QtUsers();
        $updateres = $QtUser->update(array("id"=>$user["id"]),[
            "nickName"=>$nickName,
            "phone"=>$phone,
            "qq"=>$qq,
            "email"=>$email,
            "gender"=>$gender,
            "avatar_file"=>$avatarurl,
        ]);
        if($updateres == false){
            error("更新用户信息失败");
        }
        success();

    }
	
	// 充值记录
	function actionRecrecords(){}
    // 推广服务
    function actionpro(){
        $this->display("pc/promotion.html");
    }
	
	// 新增广告位
	function actionPromotion(){
		// 获取我的网站
		$qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $sites = new QtSites();
        $this->sites = $sites->findAll(array("userId"=>$user["id"]));
	}
	/**
	 * 我的广告位
	 * @return void
	 */
	function actionPromotionHistory(){
	    $qt_adsm = new QtAdsm();
	    $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $ads = $qt_adsm->query("SELECT * FROM qt_adsm WHERE site_id in(SELECT id FROM qt_sites WHERE userId=".$user["id"].") ORDER BY id desc");
        $newList = [];
        foreach ($ads as $ad){
            $ad["sign"] = md5("03ac2b2eb8102be7854".$ad["id"]);
            // 获取广告位数据
            $QtAdStatics = new QtAdStatics();
            $result = $QtAdStatics->query("SELECT count(*) as count,ac FROM qt_ad_statics WHERE adid=".$ad["id"]." GROUP BY ac");
            $data = array();
            if($result != false){
                foreach ($result as $res){
                    $exposure = 0;
                    $isClickOfMouse = 0;
                    $isClickOfMouseEffective = 0;
                    if($res["ac"] == "exposure"){
                        $exposure = $res["count"];
                    }
                    if($res["ac"] == "isClickOfMouse"){
                        $isClickOfMouse = $res["count"];
                    }
                    if($res["ac"] == "ClickRecord"){
                        $isClickOfMouseEffective = $res["count"];
                    }
                    $data["exposure"] = $exposure;
                    $data["isClickOfMouse"] = $isClickOfMouse;
                    $data["isClickOfMouseEffective"] = $isClickOfMouseEffective;
                    
                }
            }
            $ad["adstaticdata"] = $data;
            $ad["site_name"] = "<span class=\"ax-tag\" theme=\"warning\" corner=\"round\">".$ad["site_name"]."</span>";
            array_push($newList,$ad);
            
        }
        
        // 获取智能体广告位
        $QtAgentAd = new QtAgentAd();
        $QtAgentAdKeyword = new QtAgentAdKeyword();
        $QtSources = new QtSources();
        $agentAd = $QtAgentAd->findAll(array("user_id"=>$user["id"]));
        foreach ($agentAd as $agent){
            $source_id = $agent["source_id"];
            $qts = $QtSources->find(array("id"=>$source_id));
            $thumbnail = !empty($qts["thumbnail"])?json_decode($qts["thumbnail"],true):$this->config["default_thumbnail"];
            $agentonlinecount = $QtAgentAdKeyword->findCount(array("po_user_id"=>$user["id"],"source_id"=>$source_id,"agentad_id"=>$agent["id"],"link_status"=>7));
            $map = array(
                "id"=>"agent_".$agent["id"],
                "desc"=>$qts["description"],
                "title"=>$qts["title"],
                "pro_type"=>100,
                "site_name"=>"<span class=\"ax-tag\" theme=\"primary\" corner=\"round\">智能体</span>",
                "ad_type"=>1,
                "ad_status"=>$agent["status"],
                "ad_pro"=>"pay",
                "ad_page_url"=>$qts["content_url"],
                "require_score"=>$agent["prices"],
                "max"=>$agent["link_nums"],
                "online_time"=>$agent["online_time"],
                "thumbnail"=>$thumbnail[0]["img"],
                "online"=>$agentonlinecount
            );
            array_unshift($newList,$map);
        }
        $this->ads = $newList;
	}

	// 用户须知
	function actionUserNotice(){}
	// 联系我们
	function actionMarketcooperation(){}
	// 用户协议
	function actionUserAgreement(){
        $this->display("pc/privacy.html");
    }
	// 隐私政策
	function actionUserPrivacy(){
        $this->display("pc/privacy.html");
    }
    // 法律声明
    function actionLegal() {
        $this->display("pc/legal.html");
    }
    // 服务条款
    function actionTerms() {
        $this->display("pc/terms.html");
    }
	// 版权声明
	function actionCopyrightNotice(){}
	// 广告法
	function actionadvertisinglaw(){}
	// 我的网站
	function actionSites(){
	    $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $sites = new QtSites();
        $sites = $sites->findAll(array("userId"=>$user["id"]));
        
        // 一级分类
        $ZdCategory = new ZdCategory();
        $this->categorys = $ZdCategory->query("SELECT id, categoryName as label, pid as pId FROM zd_category WHERE pid = 327 and categoryName<>'' and categoryName is not Null ORDER BY sort ASC");
        $newsites=array();//print_r($sites);exit();
        foreach($sites as $site){
            $site_category_second = $site["site_category_second"];
            $ca = $ZdCategory->find(array("id"=>$site_category_second));
            if($ca != false){
                
                $c_txt = $ca["categoryName"];
                $site["site_category_second_txt"] = $c_txt;
                $site["site_category_txt"] = $ca["pcategoryName"];
            }
            array_push($newsites,$site);
        }
        $this->sites = $newsites;
	}
	// 我的广告内容
	function actionAdvertisingSpace(){
	    $QtAds = new QtAds();
	    $qt_users = new qt_users();
	    $QtAdStatics = new QtAdStatics();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        $ads = $QtAds->findAll(array("userId"=>$user["id"]),"id desc");
        // 查询此广告相关数据（曝光、点击）
        $ad_data = array();
        foreach ($ads as $ad){
            $gid = $ad["id"];
            // $exposure = $QtAdStatics->findCount(array("gid"=>$gid,"ac"=>"exposure"));
            // $isClickOfMouse = $QtAdStatics->findCount(array("gid"=>$gid,"ac"=>"isClickOfMouse"));
            // $ad["ad_data"] = array("exposure"=>$exposure,"isClickOfMouse"=>$isClickOfMouse);
            array_push($ad_data,$ad);
        }
        $this->ads = $ad_data;
	}
    // 添加广告内容
    function actionAddAd(){}
    // 站内推广
    function actionNative(){
        $media_id = (string)arg("media_id",0);
        $this->media_id = $media_id;
        $this->media_id_bind = "1";
        if(isset($media_id) && !empty($media_id) && $media_id>0){
            // 判断这个媒体是不是此登录账号下的资源，如果不是则提醒，非账号资源会绑定到账号下，并且扣除账号积分进行推广
            $qt_users = new qt_users();
            $user = $qt_users->find(array("userId"=>$this->user["userId"]));
            $qts = new QtSources();
            $qts_result = $qts->find(array("id"=>$media_id));
            if($qts_result == false){
                $this->tips('资源ID错误，请确认资源是否正确选择。',url("pc/main","list"));
            }
            if($qts_result["create_uid"] != $user["id"]){
                $this->media_id_bind = "2";
            }
        }
    }
    // 推广历史
    function actionNativeHistory(){}
    // 其他资源
    function actionmyagents(){}
    // 我的图片
    function actionmypics(){}
    // 我的视频
    function actionmyvideos(){}
    // 站内信
    function actionmessages(){
        // 创建站内信模型实例
        $qt_site_messages = new QtSiteMessages();
        $qt_users = new QtUsers();
        
        // 获取当前用户ID
        $user_id = $this->user["id"];
        
        // 获取分页参数
        $page = intval(arg('page', 1));
        $pageSize = 10; // 每页显示10条消息
        $offset = ($page - 1) * $pageSize;
        
        // 获取用户未读消息数量
        $unread_count = $qt_site_messages->findCount(array(
            "receiver_id" => $user_id,
            "status" => 0
        ));
        
        // 获取用户消息总数
        $total_count = $qt_site_messages->findCount(array(
            "receiver_id" => $user_id
        ));
        
        // 计算总页数
        $total_pages = ceil($total_count / $pageSize);
        
        // 确保页码在有效范围内
        if ($page < 1) $page = 1;
        if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
        
        // 获取当前页的消息列表，按创建时间倒序排列
        $messages = $qt_site_messages->findAll(
            array("receiver_id" => $user_id),
            "created_at DESC",
            "*",
            array($offset, $pageSize)
        );
        
        // 处理消息数据，获取发送者信息
        $processed_messages = array();
        foreach ($messages as $message) {
            // 获取发送者信息（如果是系统消息，sender_id为0）
            if ($message["sender_id"] == 0) {
                $message["sender_name"] = "系统消息";
                $message["sender_avatar"] = "/i/img/avatar/system.png";
            } else {
                $sender = $qt_users->find(array("id" => $message["sender_id"]));
                if ($sender) {
                    $message["sender_name"] = !empty($sender["nickName"]) ? $sender["nickName"] : "未知用户";
                    $message["sender_avatar"] = !empty($sender["avatar_file"]) ? $sender["avatar_file"] : "/i/img/avatar/default.png";
                } else {
                    $message["sender_name"] = "未知用户";
                    $message["sender_avatar"] = "/i/img/avatar/default.png";
                }
            }
            
            // 格式化时间显示
            $message["formatted_time"] = $this->timeToRelativeString(strtotime($message["created_at"]));
            
            $processed_messages[] = $message;
        }
        
        // 生成页码数组
        $page_numbers = array();
        for ($i = 1; $i <= $total_pages; $i++) {
            $page_numbers[] = $i;
        }
        
        // 传递数据到模板
        $this->messages = $processed_messages;
        $this->unread_count = $unread_count;
        $this->total_count = $total_count;
        $this->current_page = $page;
        $this->total_pages = $total_pages;
        $this->page_size = $pageSize;
        $this->page_numbers = $page_numbers;
        
        // 显示模板
        $this->display("pc/user_messages.html");
    }
    
    /**
     * 获取站内信详情（AJAX接口）
     */
    function actionGetMessageDetail() {
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        try {
            // 获取消息ID参数
            $message_id = intval(arg('message_id', 0));
            
            // 验证参数
            if (empty($message_id)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '参数错误'
                ));
                exit();
            }
            
            // 创建模型实例
            $qt_site_messages = new QtSiteMessages();
            $qt_users = new QtUsers();
            
            // 获取消息详情
            $message = $qt_site_messages->find(array(
                "id" => $message_id,
                "receiver_id" => $this->user["id"]
            ));
            
            // 检查消息是否存在
            if (!$message) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '消息不存在或无权限查看'
                ));
                exit();
            }
            
            // 获取发送者信息
            if ($message["sender_id"] == 0) {
                $message["sender_name"] = "系统消息";
                $message["sender_avatar"] = "/i/img/avatar/system.png";
            } else {
                $sender = $qt_users->find(array("id" => $message["sender_id"]));
                if ($sender) {
                    $message["sender_name"] = !empty($sender["nickName"]) ? $sender["nickName"] : "未知用户";
                    $message["sender_avatar"] = !empty($sender["avatar_file"]) ? $sender["avatar_file"] : "/i/img/avatar/default.png";
                } else {
                    $message["sender_name"] = "未知用户";
                    $message["sender_avatar"] = "/i/img/avatar/default.png";
                }
            }
            
            // 格式化时间
            $message["formatted_time"] = date('Y-m-d H:i:s', strtotime($message["created_at"]));
            
            // 如果消息是未读状态，标记为已读
            if ($message["status"] == 0) {
                $qt_site_messages->update(
                    array("id" => $message_id),
                    array("status" => 1)
                );
            }
            
            // 返回成功响应
            echo json_encode(array(
                'success' => true,
                'data' => $message
            ));
            
        } catch (Exception $e) {
            // 错误处理
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误: ' . $e->getMessage()
            ));
        }
        
        exit();
    }
    
    /**
     * 标记消息为已读（AJAX接口）
     */
    function actionMarkMessageAsRead() {
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        try {
            // 获取消息ID参数
            $message_id = intval(arg('message_id', 0));
            
            // 验证参数
            if (empty($message_id)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '参数错误'
                ));
                exit();
            }
            
            // 创建模型实例
            $qt_site_messages = new QtSiteMessages();
            
            // 检查消息是否存在且属于当前用户
            $message = $qt_site_messages->find(array(
                "id" => $message_id,
                "receiver_id" => $this->user["id"]
            ));
            
            if (!$message) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '消息不存在或无权限操作'
                ));
                exit();
            }
            
            // 如果消息已经是已读状态
            if ($message["status"] == 1) {
                echo json_encode(array(
                    'success' => true,
                    'message' => '消息已经是已读状态'
                ));
                exit();
            }
            
            // 更新消息状态为已读
            $result = $qt_site_messages->update(
                array("id" => $message_id),
                array("status" => 1)
            );
            
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'message' => '消息已标记为已读'
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => '操作失败，请稍后再试'
                ));
            }
            
        } catch (Exception $e) {
            // 错误处理
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误: ' . $e->getMessage()
            ));
        }
        
        exit();
    }
    
    /**
     * 标记所有未读消息为已读（AJAX接口）
     */
    function actionMarkAllMessagesAsRead() {
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        try {
            // 创建模型实例
            $qt_site_messages = new QtSiteMessages();
            
            // 更新所有未读消息为已读
            $result = $qt_site_messages->update(
                array("receiver_id" => $this->user["id"], "status" => 0),
                array("status" => 1)
            );
            
            echo json_encode(array(
                'success' => true,
                'message' => '所有未读消息已标记为已读'
            ));
            
        } catch (Exception $e) {
            // 错误处理
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误: ' . $e->getMessage()
            ));
        }
        
        exit();
    }
    
    /**
     * 发送站内信（管理员功能）
     */
    function actionSendSiteMessage() {
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        try {
            // 检查是否为管理员（这里简化处理，实际应该有权限验证）
            // if (!$this->isAdmin()) {
            //     echo json_encode(array(
            //         'success' => false,
            //         'message' => '权限不足'
            //     ));
            //     exit();
            // }
            
            // 获取POST数据
            $receiver_id = intval(arg('receiver_id', 0));
            $title = trim(arg('title', ''));
            $content = trim(arg('content', ''));
            
            // 验证参数
            if (empty($receiver_id) || empty($title) || empty($content)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '请填写完整的信息'
                ));
                exit();
            }
            
            // 检查接收者是否存在
            $qt_users = new QtUsers();
            $receiver = $qt_users->find(array("id" => $receiver_id));
            
            if (!$receiver) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '接收者不存在'
                ));
                exit();
            }
            
            // 创建站内信模型实例
            $qt_site_messages = new QtSiteMessages();
            
            // 准备消息数据
            $message_data = array(
                'sender_id' => $this->user["id"], // 发送者ID
                'receiver_id' => $receiver_id,    // 接收者ID
                'title' => $title,                // 消息标题
                'content' => $content,            // 消息内容
                'status' => 0,                    // 未读状态
                'created_at' => date('Y-m-d H:i:s') // 创建时间
            );
            
            // 发送消息
            $result = $qt_site_messages->create($message_data);
            
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'message' => '消息发送成功'
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => '消息发送失败，请稍后再试'
                ));
            }
            
        } catch (Exception $e) {
            // 错误处理
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误: ' . $e->getMessage()
            ));
        }
        
        exit();
    }
    
    /**
     * 管理员发送站内信页面
     */
    function actionAdminSendMessage() {
        // 检查是否为管理员（这里简化处理，实际应该有权限验证）
        // if (!$this->isAdmin()) {
        //     $this->tips('权限不足', url('pc/main', 'index'));
        //     return;
        // }
        
        // 显示发送消息页面
        $this->display("admin/send_message.html");
    }
    
    // 修改用户信息
    function actionModUser(){
    }
    // 积分记录
    function actionScoreRecords(){
        header('Content-Type: application/json');
        
        $page = (int)arg("current",1); 
        $count = (int)arg("count",10); 
        $filter = arg("filter", "all"); // all, earn, spend
        $dateRange = arg("dateRange", "30"); // 7, 30, 90
        
        $qt_points_log = new QtPointsLog();
        $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        
        // 构建查询条件
        $conditions = array("user_id"=>$user["id"]);
        
        // 类型筛选
        $typeCondition = "";
        if ($filter === 'earn') {
            $typeCondition = " AND type = 'earn'";
        } elseif ($filter === 'spend') {
            $typeCondition = " AND type = 'spend'";
        }
        
        // 日期范围筛选
        $dateCondition = "";
        if ($dateRange === '7') {
            $dateCondition = " AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        } elseif ($dateRange === '30') {
            $dateCondition = " AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
        } elseif ($dateRange === '90') {
            $dateCondition = " AND created_at >= DATE_SUB(NOW(), INTERVAL 90 DAY)";
        }
        
        // 查询记录
        $offset = ($page - 1) * $count;
        $records = $qt_points_log->query(
            "SELECT id, type, points, description, created_at FROM qt_points_log 
             WHERE user_id = :user_id" . 
             $typeCondition . 
             $dateCondition . 
             " ORDER BY id DESC 
             LIMIT :offset, :count",
            array(
                ":user_id" => $user["id"],
                ":offset" => $offset,
                ":count" => $count
            )
        );
        
        // 查询总数
        $countQuery = "SELECT COUNT(*) as total FROM qt_points_log 
                      WHERE user_id = :user_id" . 
                      $typeCondition . 
                      $dateCondition;
        
        $countResult = $qt_points_log->query($countQuery, array(
            ":user_id" => $user["id"]
        ));
        
        $total = $countResult[0]['total'];
        $totalPages = ceil($total / $count);
        
        $object = array(
            'data' => $records,
            'current' => $page, 
            'pagesNum' => $totalPages, 
            'itemsNum' => $total
        );
        
        echo json_encode($object);
    }
    // 站内信
    function actionSiteMessages(){
        $qt_site_messages = new QtSiteMessages();
        $this->unread = $qt_site_messages->findCount(array("receiver_id"=>$this->user["id"],"status"=>0));
    }
    // 添加友情链接
    function actionaddlink(){
    }
    // 友情链接
    function actionlinks(){}
    // 优惠券详情页面
    function actionshopDetails(){
        $coupon_code = arg("coupon_code","");
        if(empty($coupon_code)){
            $this->jump(url("pc/main","sign"));
        }
        $qt_discount_coupons = new QtDiscountCoupons();
        $this->qdc = $qt_discount_coupons->find(array("coupon_code"=>$coupon_code));
        // print_r($this->qdc);exit()
    }
    
    // 网站地图
    function actionsitemap(){}
    
    /**
     * 获取智能体展示区数据
     * @return array
     */
    function getAgentDisplayData() {
        $ZDRedis = new ZDRedis();
        $QtSources = new QtSources();
        $QtPromotion = new QtPromotion();
        
        // 优先从缓存获取
        $cacheKey = "agent_display_data";
        $cachedData = $ZDRedis->get($cacheKey);
        $cachedData = "";
        if (!empty($cachedData)) {
            return json_decode($cachedData, true);
        }
        
        // 获取智能体相关数据
        $agentData = array();
        $agentData['topPromotion'] = [];
        // 1. 获取置顶推广位数据（智能体区域）
        $topPromotion = $QtPromotion->find(array(
            "position" => "agent_top",
            "promotion_status" => 2  // 已审核状态
        ));
        
        if ($topPromotion) {
            $topAgent = $QtSources->find(array(
                "id" => $topPromotion["medium_id"]
            ));
            
            if ($topAgent) {
                $agentData['topPromotion'] = $this->formatAgentData($topAgent, true); // true 表示是置顶推广
            }
        }
        
        // 2. 获取普通推广位数据（智能体区域）
        $promotions = $QtPromotion->findAll(array(
            "position" => "agent_normal",
            "promotion_status" => 2
        )); // 获取3个推广位
        $promotionAgents = array();
        foreach ($promotions as $promotion) {
            $agent = $QtSources->find(array(
                "id" => $promotion["medium_id"]
            ));
            
            if ($agent) {
                $promotionAgents[] = $this->formatAgentData($agent, false, true); // 第三个参数表示是推广位
            }
        }
        $agentData['promotions'] = $promotionAgents;
        
        // 3. 获取普通展示位数据（非推广）
        // 排除已经被推广的内容
        $excludeIds = array();
        if (!empty($agentData['topPromotion'])) {
            $excludeIds[] = $agentData['topPromotion']['id'];
        }
        foreach ($promotionAgents as $promo) {
            $excludeIds[] = $promo['id'];
        }
        
        $whereCondition = "content_type='agent' AND content_status=1";
        if (!empty($excludeIds)) {
            $whereCondition .= " AND id NOT IN (" . implode(',', $excludeIds) . ")";
        }
        
        $normalAgents = $QtSources->query(
            "SELECT * FROM qt_sources WHERE {$whereCondition} ORDER BY weight desc, publish_time desc LIMIT 4"
        );
        
        $normalAgentsData = array();
        foreach ($normalAgents as $agent) {
            $normalAgentsData[] = $this->formatAgentData($agent);
        }
        $agentData['normalAgents'] = $normalAgentsData;
        
        // 缓存数据30分钟
        $ZDRedis->set($cacheKey, json_encode($agentData), 1800);
        
        return $agentData;
    }
    
    /**
     * 获取智能体列表数据（用于页面展示）
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @return array
     */
    function getAgentsDisplayData($page = 1, $pageSize = 12) {
        $QtSources = new QtSources();
        $QtPromotion = new QtPromotion();
        
        $agentsData = array();
        
        // 1. 获取置顶推广位数据
        $topPromotion = $QtPromotion->find(array(
            "position" => "agent_top",
            "promotion_status" => 2  // 已审核状态
        ));
        
        if ($topPromotion) {
            $topAgent = $QtSources->find(array(
                "id" => $topPromotion["medium_id"],
                "content_type" => "agent",
                "content_status" => 1
            ));
            
            if ($topAgent) {
                $agentsData['topPromotion'] = $this->formatAgentData($topAgent, true); // true 表示是置顶推广
            }
        }
        
        // 如果置顶推广位没有数据，从普通智能体中随机选择一个作为置顶
        if (empty($agentsData['topPromotion'])) {
            $randomAgent = $QtSources->query(
                "SELECT * FROM qt_sources WHERE content_type='agent' AND content_status=1 ORDER BY RAND() LIMIT 1"
            );
            
            if (!empty($randomAgent)) {
                $agentsData['topPromotion'] = $this->formatAgentData($randomAgent[0], true);
            }
        }
        
        // 2. 获取普通推广位数据
        $promotions = $QtPromotion->findAll(array(
            "position" => "agent_normal",
            "promotion_status" => 2
        ));
        
        $promotionAgents = array();
        foreach ($promotions as $promotion) {
            $agent = $QtSources->find(array(
                "id" => $promotion["medium_id"],
                "content_type" => "agent",
                "content_status" => 1
            ));
            
            if ($agent) {
                $promotionAgents[] = $this->formatAgentData($agent, false, true); // 第三个参数表示是推广位
            }
        }
        
        // 如果推广位数据不足，从普通智能体中随机补充
        $targetPromotionCount = 3; // 目标推广位数量
        if (count($promotionAgents) < $targetPromotionCount) {
            $needPromotions = $targetPromotionCount - count($promotionAgents);
            
            // 获取已使用的ID，避免重复
            $excludeIds = array();
            if (!empty($agentsData['topPromotion'])) {
                $excludeIds[] = $agentsData['topPromotion']['id'];
            }
            foreach ($promotionAgents as $promo) {
                $excludeIds[] = $promo['id'];
            }
            
            $excludeCondition = "";
            if (!empty($excludeIds)) {
                $excludeCondition = " AND id NOT IN (" . implode(',', $excludeIds) . ")";
            }
            
            $additionalAgents = $QtSources->query(
                "SELECT * FROM qt_sources WHERE content_type='agent' AND content_status=1{$excludeCondition} ORDER BY RAND() LIMIT {$needPromotions}"
            );
            
            foreach ($additionalAgents as $agent) {
                $promotionAgents[] = $this->formatAgentData($agent, false, true);
            }
        }
        
        $agentsData['promotions'] = $promotionAgents;
        
        // 3. 获取普通展示位数据（非推广）
        // 排除已经被推广的内容
        $excludeIds = array();
        if (!empty($agentsData['topPromotion'])) {
            $excludeIds[] = $agentsData['topPromotion']['id'];
        }
        foreach ($promotionAgents as $promo) {
            $excludeIds[] = $promo['id'];
        }
        
        $excludeCondition = "";
        if (!empty($excludeIds)) {
            $excludeCondition = " AND id NOT IN (" . implode(',', $excludeIds) . ")";
        }
        
        // 计算偏移量
        $offset = ($page - 1) * $pageSize;
        
        $normalAgents = $QtSources->query(
            "SELECT * FROM qt_sources WHERE content_type='agent' AND content_status=1{$excludeCondition} ORDER BY weight DESC, publish_time DESC LIMIT {$offset}, {$pageSize}"
        );
        
        $normalAgentsData = array();
        foreach ($normalAgents as $agent) {
            $normalAgentsData[] = $this->formatAgentData($agent);
        }
        
        // 如果普通数据不足，随机补充
        if (count($normalAgentsData) < $pageSize) {
            $needNormal = $pageSize - count($normalAgentsData);
            
            // 获取已使用的ID，避免重复
            $allExcludeIds = array_merge($excludeIds, array_column($normalAgentsData, 'id'));
            $allExcludeCondition = "";
            if (!empty($allExcludeIds)) {
                $allExcludeCondition = " AND id NOT IN (" . implode(',', $allExcludeIds) . ")";
            }
            
            $additionalNormalAgents = $QtSources->query(
                "SELECT * FROM qt_sources WHERE content_type='agent' AND content_status=1{$allExcludeCondition} ORDER BY RAND() LIMIT {$needNormal}"
            );
            
            foreach ($additionalNormalAgents as $agent) {
                $normalAgentsData[] = $this->formatAgentData($agent);
            }
        }
        
        $agentsData['normalAgents'] = $normalAgentsData;
        
        // 获取总数用于分页
        $countResult = $QtSources->query(
            "SELECT COUNT(*) as total FROM qt_sources WHERE content_type='agent' AND content_status=1{$excludeCondition}"
        );
        $agentsData['total'] = $countResult[0]['total'];
        
        return $agentsData;
    }

    /**
     * 格式化智能体数据
     * @param array $agent 原始数据
     * @param bool $isTop 是否为置顶推广
     * @param bool $isPromotion 是否为推广位
     * @return array
     */
    function formatAgentData($agent, $isTop = false, $isPromotion = false) {
        // 处理缩略图
        $thumbnail = !empty($agent["thumbnail"]) ? json_decode($agent["thumbnail"], true) : array();
        if (!empty($thumbnail) && isset($thumbnail[0]["img"])) {
            $agent["thumbnail"] = $thumbnail[0]["img"];
        } else {
            $agent["thumbnail"] = $this->config["default_thumbnail"] ?? "https://picsum.photos/300/200";
        }
        
        // 处理描述图片
        $agent["describe_images"] = !empty($agent["describe_images"]) ? 
            json_decode($agent["describe_images"], true) : false;
        
        // 处理时间
        $agent["publish_time"] = $this->timeToRelativeString($agent["publish_time"]);
        
        // 清理HTML标签
        $agent["description"] = strip_tags($agent["description"]);
        $agent["title"] = strip_tags($agent["title"]);
        
        // 限制描述长度
        if (strlen($agent["description"]) > 100) {
            $agent["description"] = mb_substr($agent["description"], 0, 100, 'UTF-8') . '...';
        }
        
        // 设置内容类型
        $agent["content_type_text"] = constant('ContentType::' . $agent["content_type"]);
        $agent["content_type_color"] = constant('ContentTypeColor::' . $agent["content_type"]);
        
        // 模拟评分和活跃数据（实际项目中应该从数据库获取）
        $agent["rating"] = $this->generateRating();
        $agent["monthly_active"] = $this->generateMonthlyActive();
        
        // 设置类型标识
        $agent["isTop"] = $isTop;
        $agent["isPromotion"] = $isPromotion;
        
        return $agent;
    }
    
    /**
     * 生成评分数据（模拟）
     * @return array
     */
    function generateRating() {
        $rating = rand(35, 50) / 10; // 3.5-5.0分
        $reviewCount = rand(50, 500);
        
        return array(
            "score" => $rating,
            "count" => $reviewCount,
            "stars" => $this->generateStars($rating)
        );
    }
    
    /**
     * 生成星级显示
     * @param float $rating
     * @return array
     */
    function generateStars($rating) {
        $stars = array();
        $fullStars = floor($rating);
        $hasHalfStar = ($rating - $fullStars) >= 0.5;
        
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fullStars) {
                $stars[] = "full";
            } elseif ($i == $fullStars + 1 && $hasHalfStar) {
                $stars[] = "half";
            } else {
                $stars[] = "empty";
            }
        }
        
        return $stars;
    }
    
    /**
     * 生成月活跃数据（模拟）
     * @return string
     */
    function generateMonthlyActive() {
        $active = rand(1000, 50000);
        
        if ($active >= 10000) {
            return round($active / 1000, 1) . "0+";
        } else {
            return number_format($active) . "+";
        }
    }
    
    /**
     * 获取公众号展示区数据
     * @param string $category 分类筛选（默认为全部）
     * @return array
     */
    function getWechatDisplayData($category = '',$p='') {
        try {
            $QtSources = new QtSources();
            $QtPromotion = new QtPromotion();
            $page = arg('page', 1); // 获取页码参数，默认为第1页
            $sort = arg('sort', 'default'); // 获取排序参数，默认为default
            
            $p = empty($p)?arg("p",""):$p;

            
            // 确保页码为正整数
            $page = max(1, intval($page));
            
            $wechatData = array();
            
            // 1. 获取置顶推广位数据（公众号区域）
            $topPromotion = $QtPromotion->find(array(
                "position" => "wechat_top",
                "promotion_status" => 2  // 已审核状态
            ));
            
            if ($topPromotion) {
                $topWechatConditions = array(
                    "id" => $topPromotion["medium_id"]
                );
                
                // 如果有分类筛选，添加分类条件
                if ($category != '' && !empty($category)) {
                    $topWechatConditions['category_name'] = $category;
                }
                
                $topWechat = $QtSources->find($topWechatConditions);
                
                if ($topWechat) {
                    $wechatData['topPromotion'] = $this->formatWechatData($topWechat, true, false);
                }
            }
            
            // 2. 获取普通推广位数据（公众号区域）
            $promotions = $QtPromotion->findAll(array(
                "position" => "wechat_normal",
                "promotion_status" => 2
            )); // 获取3个推广位
            
            $promotionWechats = array();
            if ($promotions) {
                foreach ($promotions as $promotion) {
                    $wechatConditions = array(
                        "id" => $promotion["medium_id"]
                    );
                    
                    // 如果有分类筛选，添加分类条件
                    if ($category != '' && !empty($category)) {
                        $wechatConditions['category_name'] = $category;
                    }
                    
                    $wechat = $QtSources->find($wechatConditions);
                    
                    if ($wechat) {
                        $promotionWechats[] = $this->formatWechatData($wechat, false, true);
                    }
                }
            }
            $wechatData['promotions'] = $promotionWechats;
            
            // 3. 获取普通展示位数据（非推广）
            $excludeIds = array();
            if (!empty($wechatData['topPromotion'])) {
                $excludeIds[] = intval($wechatData['topPromotion']['id']);
            }
            foreach ($promotionWechats as $promo) {
                $excludeIds[] = intval($promo['id']);
            }
            
            // 构建查询条件
            $whereConditions = array(
                "content_type = 'gzh'",
                "content_status = 1"
            );
            
            // 添加分类筛选条件
            if ($category != '' && !empty($category)) {
                $whereConditions[] = "category_name = '{$category}'";
            }
            
            // 排除已展示的ID
            if (!empty($excludeIds)) {
                $excludeIdStr = implode(',', $excludeIds);
                $whereConditions[] = "id NOT IN ({$excludeIdStr})";
            }
            
            $whereClause = implode(' AND ', $whereConditions);
            
            // 根据排序参数构建ORDER BY子句
            $orderByClause = "weight DESC, publish_time DESC"; // 默认排序
            switch ($sort) {
                case 'fans':
                    $orderByClause = "monthly_active DESC, weight DESC";
                    break;
                case 'rating':
                    $orderByClause = "stars DESC, weight DESC";
                    break;
                case 'time':
                    $orderByClause = "publish_time DESC, weight DESC";
                    break;
                case 'default':
                default:
                    $orderByClause = "weight DESC, publish_time DESC";
                    break;
            }
            
            // 计算分页偏移量
            $perPage = 15; // 每页显示15个公众号
            if($p == "index"){
                $perPage = 7;
            }
            $offset = ($page - 1) * $perPage;
            
            // 获取普通展示位数据（分页）
            $normalWechats = $QtSources->query(
                "SELECT * FROM qt_sources WHERE {$whereClause} ORDER BY {$orderByClause} LIMIT {$offset}, {$perPage}"
            );
            
            $normalWechatsData = array();
            if ($normalWechats) {
                foreach ($normalWechats as $wechat) {
                    $normalWechatsData[] = $this->formatWechatData($wechat, false, false);
                }
            }
            
            // 如果置顶推广位没有数据，从普通媒体中随机选择1个填充（仅在第一页）
            if (empty($wechatData['topPromotion']) && !empty($normalWechatsData) && $page == 1) {
                $randomIndex = array_rand($normalWechatsData);
                $wechatData['topPromotion'] = $normalWechatsData[$randomIndex];
                // 从普通展示位中移除已用作置顶推广位的数据
                unset($normalWechatsData[$randomIndex]);
                $normalWechatsData = array_values($normalWechatsData); // 重建索引
            }
            
            // 如果普通推广位没有数据，从剩余普通媒体中随机选择填充（最多2个，仅在第一页）
            $targetPromotionCount = 2;
            if (count($wechatData['promotions']) < $targetPromotionCount && !empty($normalWechatsData) && $page == 1) {
                $needPromotions = $targetPromotionCount - count($wechatData['promotions']);
                $availableForPromotion = min($needPromotions, count($normalWechatsData));
                
                for ($i = 0; $i < $availableForPromotion; $i++) {
                    $randomIndex = array_rand($normalWechatsData);
                    $wechatData['promotions'][] = $normalWechatsData[$randomIndex];
                    // 从普通展示位中移除已用作推广位的数据
                    unset($normalWechatsData[$randomIndex]);
                    $normalWechatsData = array_values($normalWechatsData); // 重建索引
                }
            }
            
            $wechatData['normalWechats'] = $normalWechatsData;
            
            // 添加分类信息
            $wechatData['currentCategory'] = $category;
            $sql = "SELECT category_name,count(1) AS total FROM qt_sources WHERE content_status = 1 AND content_type = 'gzh' AND category_name IS NOT NULL AND category_name<>'' GROUP BY category_name ORDER BY total DESC LIMIT 10";
            $result = $QtSources->query($sql);
            $wechatData['categories'] = $result;
            
            return $wechatData;
            
        } catch (Exception $e) {
            error_log("getWechatDisplayData 错误: " . $e->getMessage() . " 文件: " . $e->getFile() . " 行号: " . $e->getLine());
            return array(
                'topPromotion' => null,
                'promotions' => array(),
                'normalWechats' => array(),
                'currentCategory' => $category,
                'categories' => array(
                    array('key' => 'all', 'name' => '全部'),
                    array('key' => 'technology', 'name' => '教育'),
                    array('key' => 'life', 'name' => '生活'),
                    array('key' => 'finance', 'name' => '影视')
                )
            );
        }
    }
    
    /**
     * 获取小程序展示区数据
     * @param string $category 分类筛选（默认为全部）
     * @param int $page 页码（默认为1）
     * @param int $p 标记是列表页请求还是首页请求（默认为1）
     * @return array
     */
    function getMiniProgramDisplayData($category = 'all', $page = 1, $p = 1, $sort = 'default') {
        try {
            $QtSources = new QtSources();
            $QtPromotion = new QtPromotion();
            
            $miniProgramData = array();
            
            // 获取当前分类名称
            $categoryName = $category=='all' ? '' : $category;
            
            // 1. 获取置顶推广位数据（小程序区域）- 支持多个轮播位
            $topPromotions = $QtPromotion->findAll(array(
                "position" => "xcx_top",
                "promotion_status" => 2  // 已审核状态
            ), "weight desc, id desc", "*", array(1, 1)); // 获取最多5个轮播位
            
            $topPromotionData = array();
            if ($topPromotions) {
                foreach ($topPromotions as $topPromotion) {
                    $topMiniProgramConditions = array(
                        "id" => $topPromotion["medium_id"]
                    );
                    
                    // 如果有分类筛选，添加分类条件
                    if ($category != 'all' && !empty($categoryName)) {
                        $topMiniProgramConditions['category_name'] = $categoryName;
                    }
                    
                    $topMiniProgram = $QtSources->find($topMiniProgramConditions);
                    
                    if ($topMiniProgram) {
                        $topPromotionData[] = $this->formatMiniProgramData($topMiniProgram, true, false);
                    }
                }
            }
            $miniProgramData['topPromotions'] = $topPromotionData;
            
            // 2. 获取普通推广位数据（小程序区域）
            $promotions = $QtPromotion->findAll(array(
                "position" => "xcx_normal",
                "promotion_status" => 2
            ), "weight desc, id desc", "*", array(1, 3)); // 获取3个推广位
            
            $promotionMiniPrograms = array();
            if ($promotions) {
                foreach ($promotions as $promotion) {
                    $miniProgramConditions = array(
                        "id" => $promotion["medium_id"]
                    );
                    
                    // 如果有分类筛选，添加分类条件
                    if ($category != 'all' && !empty($categoryName)) {
                        $miniProgramConditions['category_name'] = $categoryName;
                    }
                    
                    $miniProgram = $QtSources->find($miniProgramConditions);
                    
                    if ($miniProgram) {
                        $promotionMiniPrograms[] = $this->formatMiniProgramData($miniProgram, false, true);
                    }
                }
            }
            $miniProgramData['promotions'] = $promotionMiniPrograms;
            
            // 3. 获取普通展示位数据（非推广）
            $excludeIds = array();
            if (!empty($miniProgramData['topPromotions'])) {
                foreach ($miniProgramData['topPromotions'] as $topPromo) {
                    $excludeIds[] = intval($topPromo['id']);
                }
            }
            foreach ($promotionMiniPrograms as $promo) {
                $excludeIds[] = intval($promo['id']);
            }
            
            // 构建查询条件
            $whereConditions = array(
                "content_type = 'xcx'",
                "content_status = 1"
            );
            
            // 添加分类筛选条件
            if ($category != 'all' && !empty($categoryName)) {
                $whereConditions[] = "category_name = '" . $categoryName . "'";
            }
            
            // 排除已展示的ID
            if (!empty($excludeIds)) {
                $excludeIdStr = implode(',', $excludeIds);
                $whereConditions[] = "id NOT IN ({$excludeIdStr})";
            }
            
            $whereClause = implode(' AND ', $whereConditions);
            
            // 根据排序方式确定排序规则
            switch ($sort) {
                case 'latest':
                    $orderBy = "publish_time DESC";
                    break;
                case 'hot':
                    $orderBy = "views DESC";
                    break;
                case 'rating':
                    $orderBy = "stars DESC";
                    break;
                default:
                    $orderBy = "weight DESC, publish_time DESC";
                    break;
            }
            
            // 根据$p参数确定每页显示数量
            $perPage = ($p == 1) ? 30 : 7; // 列表页每页30条，首页每页15条
            
            // 计算分页偏移量
            $offset = ($page - 1) * $perPage;
            
            // 获取普通展示位数据（分页）
            $normalMiniPrograms = $QtSources->query(
                "SELECT * FROM qt_sources WHERE {$whereClause} ORDER BY {$orderBy} LIMIT {$offset}, {$perPage}"
            );
            
            $normalMiniProgramsData = array();
            if ($normalMiniPrograms) {
                foreach ($normalMiniPrograms as $miniProgram) {
                    $normalMiniProgramsData[] = $this->formatMiniProgramData($miniProgram, false, false);
                }
            }
            
            // 只在第一页显示置顶推广位和普通推广位
            if ($page == 1) {
                // 如果轮播位数据不足，从普通媒体中随机选择填充（最多5个轮播位）
                $targetCarouselCount = 1;
                if (count($miniProgramData['topPromotions']) < $targetCarouselCount && !empty($normalMiniProgramsData)) {
                    $needCarousels = $targetCarouselCount - count($miniProgramData['topPromotions']);
                    $availableForCarousel = min($needCarousels, count($normalMiniProgramsData));
                    
                    for ($i = 0; $i < $availableForCarousel; $i++) {
                        $randomIndex = array_rand($normalMiniProgramsData);
                        $miniProgramData['topPromotions'][] = $normalMiniProgramsData[$randomIndex];
                        // 从普通展示位中移除已用作轮播位的数据
                        unset($normalMiniProgramsData[$randomIndex]);
                        $normalMiniProgramsData = array_values($normalMiniProgramsData); // 重建索引
                    }
                }
                
                // 如果普通推广位没有数据，从剩余普通媒体中随机选择填充（最多3个）
                $targetPromotionCount = 3;
                if (count($miniProgramData['promotions']) < $targetPromotionCount && !empty($normalMiniProgramsData)) {
                    $needPromotions = $targetPromotionCount - count($miniProgramData['promotions']);
                    $availableForPromotion = min($needPromotions, count($normalMiniProgramsData));
                    
                    for ($i = 0; $i < $availableForPromotion; $i++) {
                        $randomIndex = array_rand($normalMiniProgramsData);
                        $miniProgramData['promotions'][] = $normalMiniProgramsData[$randomIndex];
                        // 从普通展示位中移除已用作推广位的数据
                        unset($normalMiniProgramsData[$randomIndex]);
                        $normalMiniProgramsData = array_values($normalMiniProgramsData); // 重建索引
                    }
                }
                
                // 保留部分普通展示位用于下方网格显示
                $miniProgramData['normalMiniPrograms'] = $normalMiniProgramsData;
            } else {
                // 非第一页不显示推广位，只显示普通数据
                $miniProgramData['topPromotions'] = array();
                $miniProgramData['promotions'] = array();
                $miniProgramData['normalMiniPrograms'] = $normalMiniProgramsData;
            }
            
            // 添加分类信息
            $miniProgramData['currentCategory'] = $category;
            $miniProgramData['categories'] = array(
                array('key' => 'all', 'name' => '全部'),
                array('key' => 'tool', 'name' => '工具'),
                array('key' => 'ecommerce', 'name' => '购物'),
                array('key' => 'game', 'name' => '游戏')
            );
            
            return $miniProgramData;
            
        } catch (Exception $e) {
            error_log("getMiniProgramDisplayData 错误: " . $e->getMessage() . " 文件: " . $e->getFile() . " 行号: " . $e->getLine());
            return array(
                'topPromotions' => array(),
                'promotions' => array(),
                'normalMiniPrograms' => array(),
                'currentCategory' => $category,
                'categories' => array(
                    array('key' => 'all', 'name' => '全部'),
                    array('key' => 'tool', 'name' => '工具'),
                    array('key' => 'ecommerce', 'name' => '购物'),
                    array('key' => 'game', 'name' => '游戏')
                )
            );
        }
    }
    
    /**
     * 获取小游戏展示区数据
     * @param string $category 分类筛选（默认为全部）
     * @param int $page 页码（默认为1）
     * @return array
     */
    function getGameDisplayData($category = 'all', $page = 1,$p="") {
        try {
            $QtSources = new QtSources();
            $QtPromotion = new QtPromotion();
            
            $gameData = array();
            $p= empty($p)?arg("p",""):$p;
            // 获取当前分类名称
            $categoryName = $category=="all"?"":$category;
            
            // 只在第一页显示推广位
            if ($page == 1) {
                // 1. 获取置顶推广位数据（小游戏区域）
                $topPromotion = $QtPromotion->find(array(
                    "position" => "xyx_top",
                    "promotion_status" => 2  // 已审核状态
                ));
                
                if ($topPromotion) {
                    $topGameConditions = array(
                        "id" => $topPromotion["medium_id"]
                    );
                    
                    // 如果有分类筛选，添加分类条件
                    if ($category != 'all' && !empty($categoryName)) {
                        $topGameConditions['category_name'] = $categoryName;
                    }
                    
                    $topGame = $QtSources->find($topGameConditions);
                    
                    if ($topGame) {
                        $gameData['topPromotion'] = $this->formatGameData($topGame, true, false);
                    }
                }
                
                // 2. 获取普通推广位数据（小游戏区域）
                $promotions = $QtPromotion->findAll(array(
                    "position" => "xyx_normal",
                    "promotion_status" => 2
                )); // 获取推广位
                
                $promotionGames = array();
                if ($promotions) {
                    foreach ($promotions as $promotion) {
                        $gameConditions = array(
                            "id" => $promotion["medium_id"]
                        );
                        
                        // 如果有分类筛选，添加分类条件
                        if ($category != 'all' && !empty($categoryName)) {
                            $gameConditions['category_name'] = $categoryName;
                        }
                        
                        $game = $QtSources->find($gameConditions);
                        
                        if ($game) {
                            $promotionGames[] = $this->formatGameData($game, false, true);
                        }
                    }
                }
                $gameData['promotions'] = $promotionGames;
            } else {
                // 非第一页不显示推广位
                $gameData['topPromotion'] = null;
                $gameData['promotions'] = array();
            }
            
            // 3. 获取普通展示位数据（非推广）
            $excludeIds = array();
            if (!empty($gameData['topPromotion'])) {
                $excludeIds[] = intval($gameData['topPromotion']['id']);
            }
            foreach ($gameData['promotions'] as $promo) {
                $excludeIds[] = intval($promo['id']);
            }
            
            // 构建查询条件
            $whereConditions = array(
                "content_type = 'xyx'",
                "content_status = 1"
            );
            
            // 添加分类筛选条件
            if ($category != 'all' && !empty($categoryName)) {
                $whereConditions[] = "category_name = '{$categoryName}'";
            }
            
            // 排除已展示的ID
            if (!empty($excludeIds)) {
                $excludeIdStr = implode(',', $excludeIds);
                $whereConditions[] = "id NOT IN ({$excludeIdStr})";
            }
            
            $whereClause = implode(' AND ', $whereConditions);
            
            // 分页参数
            $perPage = 15; // 每页显示12个游戏
            if($p == "index"){
                $perPage = 5;
            }
            $offset = ($page - 1) * $perPage;
            
            // 获取普通展示位数据（分页）
            $normalGames = $QtSources->query(
                "SELECT * FROM qt_sources WHERE {$whereClause} ORDER BY weight DESC, publish_time DESC LIMIT {$offset}, {$perPage}"
            );
            
            $normalGamesData = array();
            if ($normalGames) {
                foreach ($normalGames as $game) {
                    $normalGamesData[] = $this->formatGameData($game, false, false);
                }
            }
            
            // 只在第一页处理推广位填充逻辑
            if ($page == 1) {
                // 如果置顶推广位没有数据，从普通媒体中随机选择1个填充
                if (empty($gameData['topPromotion']) && !empty($normalGamesData)) {
                    $randomIndex = array_rand($normalGamesData);
                    $gameData['topPromotion'] = $normalGamesData[$randomIndex];
                    // 从普通展示位中移除已用作置顶推广位的数据
                    unset($normalGamesData[$randomIndex]);
                    $normalGamesData = array_values($normalGamesData); // 重建索引
                }
                
                // 如果普通推广位没有数据，从剩余普通媒体中随机选择填充（最多2个）
                $targetPromotionCount = 2;
                if (count($gameData['promotions']) < $targetPromotionCount && !empty($normalGamesData)) {
                    $needPromotions = $targetPromotionCount - count($gameData['promotions']);
                    $availableForPromotion = min($needPromotions, count($normalGamesData));
                    
                    for ($i = 0; $i < $availableForPromotion; $i++) {
                        $randomIndex = array_rand($normalGamesData);
                        $gameData['promotions'][] = $normalGamesData[$randomIndex];
                        // 从普通展示位中移除已用作推广位的数据
                        unset($normalGamesData[$randomIndex]);
                        $normalGamesData = array_values($normalGamesData); // 重建索引
                    }
                }
            }
            
            $gameData['normalGames'] = $normalGamesData;
            
            // 添加分类信息
            $gameData['currentCategory'] = $category;
            $gameData['categories'] = array(
                array('key' => 'all', 'name' => '全部'),
                array('key' => 'casual', 'name' => '休闲益智'),
                array('key' => 'puzzle', 'name' => '辅助工具'),
                array('key' => 'action', 'name' => '棋牌扑克')
            );
            
            return $gameData;
            
        } catch (Exception $e) {
            error_log("getGameDisplayData 错误: " . $e->getMessage() . " 文件: " . $e->getFile() . " 行号: " . $e->getLine());
            return array(
                'topPromotion' => null,
                'promotions' => array(),
                'normalGames' => array(),
                'currentCategory' => $category,
                'categories' => array(
                    array('key' => 'all', 'name' => '全部'),
                    array('key' => 'casual', 'name' => '休闲益智'),
                    array('key' => 'puzzle', 'name' => '辅助工具'),
                    array('key' => 'action', 'name' => '棋牌扑克')
                )
            );
        }
    }
    
    /**
     * 获取文章展示区数据
     * @param string $category 分类筛选（默认为全部）
     * @return array
     */
    function getArticleDisplayData($category = 'all') {
        try {
            $QtSources = new QtSources();
            $QtPromotion = new QtPromotion();
            
            $articleData = array();
            
            // 分类映射表
            $categoryMap = array(
                'all' => '',
                'recommend' => '推荐',
                'hot' => '热门',
                'latest' => '最新'
            );
            
            // 获取当前分类名称
            $categoryName = isset($categoryMap[$category]) ? $categoryMap[$category] : '';
            
            // 1. 获取置顶推广位数据（文章区域）
            $topPromotion = $QtPromotion->find(array(
                "position" => "article_top",
                "promotion_status" => 2  // 已审核状态
            ));
            
            if ($topPromotion) {
                $topArticleConditions = array(
                    "id" => $topPromotion["medium_id"],
                    "content_type" => "article",
                    "content_status" => 1
                );
                
                $topArticle = $QtSources->find($topArticleConditions);
                
                if ($topArticle) {
                    $articleData['topPromotion'] = $this->formatArticleData($topArticle, true, false);
                }
            }
            
            // 2. 获取普通推广位数据（文章区域）
            $promotions = $QtPromotion->findAll(array(
                "position" => "article_normal",
                "promotion_status" => 2
            )); // 获取3个推广位
            
            $promotionArticles = array();
            if ($promotions) {
                foreach ($promotions as $promotion) {
                    $articleConditions = array(
                        "id" => $promotion["medium_id"],
                        "content_type" => "article",
                        "content_status" => 1
                    );
                    
                    $article = $QtSources->find($articleConditions);
                    
                    if ($article) {
                        $promotionArticles[] = $this->formatArticleData($article, false, true);
                    }
                }
            }
            $articleData['promotions'] = $promotionArticles;
            
            // 3. 获取普通展示位数据（非推广）
            $excludeIds = array();
            if (!empty($articleData['topPromotion'])) {
                $excludeIds[] = intval($articleData['topPromotion']['id']);
            }
            foreach ($promotionArticles as $promo) {
                $excludeIds[] = intval($promo['id']);
            }
            
            // 构建查询条件
            $whereConditions = array(
                "content_type = 'article'",
                "content_status = 1"
            );
            
            // 排除已展示的ID
            if (!empty($excludeIds)) {
                $excludeIdStr = implode(',', $excludeIds);
                $whereConditions[] = "id NOT IN ({$excludeIdStr})";
            }
            
            $whereClause = implode(' AND ', $whereConditions);
            
            // 获取普通展示位数据（固定数量4个）
            $baseNormalCount = 4; // 固定展示数量
            
            // 根据分类使用不同的排序方式
            $orderBy = "";
            if ($category == 'recommend') {
                // 推荐：随机获取
                $orderBy = "RAND()";
            } else if ($category == 'hot') {
                // 最热：根据views排序
                $orderBy = "views DESC";
            } else if ($category == 'latest') {
                // 最新：按照ID倒序获取
                $orderBy = "id DESC";
            } else {
                // 默认排序：权重和发布时间
                $orderBy = "weight DESC, publish_time DESC";
            }
            
            $normalArticles = $QtSources->query(
                "SELECT * FROM qt_sources WHERE {$whereClause} ORDER BY {$orderBy} LIMIT {$baseNormalCount}"
            );
            
            $normalArticlesData = array();
            if ($normalArticles) {
                foreach ($normalArticles as $article) {
                    $normalArticlesData[] = $this->formatArticleData($article, false, false);
                }
            }
            
            // 如果置顶推广位没有数据，从普通媒体中随机选择1个填充
            if (empty($articleData['topPromotion']) && !empty($normalArticlesData)) {
                $randomIndex = array_rand($normalArticlesData);
                $articleData['topPromotion'] = $normalArticlesData[$randomIndex];
                // 从普通展示位中移除已用作置顶推广位的数据
                unset($normalArticlesData[$randomIndex]);
                $normalArticlesData = array_values($normalArticlesData); // 重建索引
            }
            
            // 如果普通推广位没有数据，从剩余普通媒体中随机选择填充（最多2个）
            $targetPromotionCount = 2;
            if (count($articleData['promotions']) < $targetPromotionCount && !empty($normalArticlesData)) {
                $needPromotions = $targetPromotionCount - count($articleData['promotions']);
                $availableForPromotion = min($needPromotions, count($normalArticlesData));
                
                for ($i = 0; $i < $availableForPromotion; $i++) {
                    $randomIndex = array_rand($normalArticlesData);
                    $articleData['promotions'][] = $normalArticlesData[$randomIndex];
                    // 从普通展示位中移除已用作推广位的数据
                    unset($normalArticlesData[$randomIndex]);
                    $normalArticlesData = array_values($normalArticlesData); // 重建索引
                }
            }
            
            $articleData['normalArticles'] = $normalArticlesData;
            
            // 添加分类信息
            $articleData['currentCategory'] = $category;
            $articleData['categories'] = array(
                array('key' => 'all', 'name' => '推荐'),
                array('key' => 'hot', 'name' => '热门'),
                array('key' => 'latest', 'name' => '最新')
            );
            
            return $articleData;
            
        } catch (Exception $e) {
            error_log("getArticleDisplayData 错误: " . $e->getMessage() . " 文件: " . $e->getFile() . " 行号: " . $e->getLine());
            return array(
                'topPromotion' => null,
                'promotions' => array(),
                'normalArticles' => array(),
                'currentCategory' => $category,
                'categories' => array(
                    array('key' => 'all', 'name' => '推荐'),
                    array('key' => 'hot', 'name' => '热门'),
                    array('key' => 'latest', 'name' => '最新')
                )
            );
        }
    }
    
    /**
     * 格式化公众号数据
     * @param array $wechat 原始数据
     * @param bool $isTop 是否为置顶推广
     * @param bool $isPromotion 是否为推广位
     * @return array
     */
    function formatWechatData($wechat, $isTop = false, $isPromotion = false) {
        // 复用formatAgentData的逻辑，但针对公众号进行优化
        return $this->formatCommonData($wechat, $isTop, $isPromotion);
    }
    
    /**
     * 格式化小程序数据
     * @param array $miniProgram 原始数据
     * @param bool $isTop 是否为置顶推广
     * @param bool $isPromotion 是否为推广位
     * @return array
     */
    function formatMiniProgramData($miniProgram, $isTop = false, $isPromotion = false) {
        // 复用formatAgentData的逻辑，但针对小程序进行优化
        return $this->formatCommonData($miniProgram, $isTop, $isPromotion);
    }
    
    /**
     * 格式化小游戏数据
     * @param array $game 原始数据
     * @param bool $isTop 是否为置顶推广
     * @param bool $isPromotion 是否为推广位
     * @return array
     */
    function formatGameData($game, $isTop = false, $isPromotion = false) {
        // 复用formatAgentData的逻辑，但针对小游戏进行优化
        return $this->formatCommonData($game, $isTop, $isPromotion);
    }
    
    /**
     * 格式化文章数据
     * @param array $article 原始数据
     * @param bool $isTop 是否为置顶推广
     * @param bool $isPromotion 是否为推广位
     * @return array
     */
    function formatArticleData($article, $isTop = false, $isPromotion = false) {
        // 复用formatAgentData的逻辑，但针对文章进行优化
        return $this->formatCommonData($article, $isTop, $isPromotion);
    }
    
    /**
     * 通用数据格式化方法
     * @param array $data 原始数据
     * @param bool $isTop 是否为置顶推广
     * @param bool $isPromotion 是否为推广位
     * @return array
     */
    function formatCommonData($data, $isTop = false, $isPromotion = false) {
        // 处理缩略图
        $thumbnail = !empty($data["thumbnail"]) ? json_decode($data["thumbnail"], true) : array();
        if (!empty($thumbnail) && isset($thumbnail[0]["img"])) {
            $data["thumbnail"] = $thumbnail[0]["img"];
        } else {
            $data["thumbnail"] = $this->config["default_thumbnail"] ?? "https://picsum.photos/300/200";
        }
        
        // 处理描述图片
        $data["describe_images"] = !empty($data["describe_images"]) ? 
            json_decode($data["describe_images"], true) : false;
        
        // 处理时间
        $data["publish_time"] = $this->timeToRelativeString($data["publish_time"]);
        $data["create_time"] = isset($data["create_time"]) ? $this->timeToRelativeString($data["create_time"]) : $data["publish_time"];
        
        // 清理HTML标签
        $data["description"] = strip_tags($data["description"]);
        $data["title"] = strip_tags($data["title"]);
        
        // 限制描述长度
        if (mb_strlen($data["description"], 'UTF-8') > 100) {
            $data["description"] = mb_substr($data["description"], 0, 100, 'UTF-8') . '...';
        }
        
        // 设置内容类型
        $data["content_type_text"] = constant('ContentType::' . $data["content_type"]);
        $data["content_type_color"] = constant('ContentTypeColor::' . $data["content_type"]);
        
        // 处理用户数和对话数
        $data["user_nums"] = isset($data["user_nums"]) ? format_number($data["user_nums"]) : "0";
        $data["dialogue_count"] = isset($data["dialogue_count"]) ? format_number($data["dialogue_count"]) : "0";
        
        // 生成评分和活跃数据（如果数据库中没有真实数据）
        if (!isset($data["rating_score"]) || empty($data["rating_score"])) {
            $data["rating"] = $this->generateRating();
        } else {
            $data["rating"] = array(
                "score" => floatval($data["rating_score"]),
                "count" => intval($data["rating_count"] ?? 0),
                "stars" => $this->generateStars(floatval($data["rating_score"]))
            );
        }
        
        if (!isset($data["monthly_active"]) || empty($data["monthly_active"])) {
            $data["monthly_active"] = $this->generateMonthlyActive();
        } else {
            $data["monthly_active"] = format_number($data["monthly_active"]) . "+";
        }
        
        // 设置类型标识
        $data["isTop"] = $isTop;
        $data["isPromotion"] = $isPromotion;
        $data["displayType"] = $isTop ? 'top' : ($isPromotion ? 'promotion' : 'normal');
        
        // 添加链接
        $data["url"] = url('pc/main', 'detail', array('id' => $data['id']));
        
        return $data;
    }
    
    /**
     * 获取精选推荐区数据
     * @return array
     */
    function getFeaturedDisplayData() {
        try {
            $QtSources = new QtSources();
            $QtPromotion = new QtPromotion();
            
            $featuredData = array();
            
            // 获取精选推荐位数据（featured位置）
            $featuredPromotion = $QtPromotion->find(array(
                "position" => "featured_main",
                "promotion_status" => 2
            ));
            
            if ($featuredPromotion) {
                $featuredItem = $QtSources->find(array(
                    "id" => $featuredPromotion["medium_id"],
                    "content_status" => 1
                ));
                
                if ($featuredItem) {
                    $featuredData['featuredItem'] = $this->formatCommonData($featuredItem, false, true);
                }
            }
            
            if (empty($featuredData['featuredItem'])) {
                $featuredData['featuredItem'] = null;
            }
            
            return $featuredData;
            
        } catch (Exception $e) {
            error_log("getFeaturedDisplayData 错误: " . $e->getMessage() . " 文件: " . $e->getFile() . " 行号: " . $e->getLine());
            return array(
                'featuredItem' => null
            );
        }
    }
    
    /**
     * AJAX接口：获取公众号分类数据
     */
    function actionGetWechatByCategory() {
        header('Content-Type: application/json; charset=utf-8');
        
        $category = arg('category', '');
        if($category == 'all'){
            $category = '';
        }
        try {
            $wechatData = $this->getWechatDisplayData($category);
            
            // 返回 JSON数据
            echo json_encode(array(
                'success' => true,
                'data' => $wechatData
            ), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '获取数据失败：' . $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
        
        exit();
    }
    
    /**
     * AJAX接口：获取小程序分类数据
     */
    function actionGetMiniProgramByCategory() {
        header('Content-Type: application/json; charset=utf-8');
        
        $category = arg('category', 'all');
        $page = arg('page', 1); // 获取页码参数
        $p = arg('p', 1); // 获取页面类型参数
        
        try {
            $miniProgramData = $this->getMiniProgramDisplayData($category, $page, $p);
            
            // 返回 JSON数据
            echo json_encode(array(
                'success' => true,
                'data' => $miniProgramData
            ), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '获取数据失败：' . $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
        
        exit();
    }
    
    /**
     * AJAX接口：获取小游戏分类数据
     */
    function actionGetGameByCategory() {
        header('Content-Type: application/json; charset=utf-8');
        
        $category = arg('category', 'all');
        $page = arg('page', 1); // 获取页码参数
        
        try {
            $gameData = $this->getGameDisplayData($category, $page);
            
            // 返回 JSON数据
            echo json_encode(array(
                'success' => true,
                'data' => $gameData
            ), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '获取数据失败：' . $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
        
        exit();
    }
    
    // 签到接口
    function actionSign() {
        // 设置响应头为JSON格式
        header('Content-Type: application/json; charset=utf-8');
        
        try {
            $id = $this->user["id"];
            $QtSigns = new QtSigns();
            $qt_users = new QtUsers();
            
            // 获取用户信息
            $user = $qt_users->find(array("id" => $id));
            
            // 判断是否已经签到过了
            $today = strtotime(date("Y-m-d"));
            $count = $QtSigns->findCount(array("sign_in_date" => $today, "user_id" => $id));
            
            if ($count > 0) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '您今天已经签到了！'
                ), JSON_UNESCAPED_UNICODE);
                exit();
            }
            
            // 签到积分（默认5分）
            $score = 5;
            $new_sign_item = array(
                "user_id" => $user["id"],
                "sign_in_date" => $today,
                "points_earned" => $score
            );
            
            // 创建签到记录
            $addid = $QtSigns->create($new_sign_item);
            
            if ($addid > 0) {
                // 更新用户积分
                $blance = $user["blance"];
                $new_blance = $blance + $score;
                $qt_users->update(array("id" => $user["id"]), array("blance" => $new_blance));
                
                // 记录积分变动日志
                $qt_points_log = new QtPointsLog();
                $qt_points_log->create(array(
                    "user_id" => $user["id"],
                    "points" => $score,
                    "type" => "earn",
                    "description" => "签到奖励",
                    "created_at" => date("Y-m-d H:i:s")
                ));
                
                echo json_encode(array(
                    'success' => true,
                    'message' => '签到成功！获得'.$score.'积分',
                    'points' => $new_blance,
                    'today' => true
                ), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => '签到失败，请稍后再试！'
                ), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误：' . $e->getMessage()
            ), JSON_UNESCAPED_UNICODE);
        }
        
        exit();
    }
    
    // 投稿页面
    // 投稿页面
    function actioncontribute(){
        // 获取分类数据
        $zdCategory = new ZdCategory();
        $allCategories = $zdCategory->findAll(array(), 'sort DESC');
        
        // 按分类类型分组
        $groupedCategories = array();
        $categoryTypes = array(
            1 => '微信群',
            2 => '公众号',
            3 => '个人号',
            4 => '小程序',
            5 => '小游戏',
            6 => '资讯',
            7 => '精品课程',
            8 => 'AI智能体',
            10 => '网站分类',
            11 => '推广文章'
        );
        
        // 初始化分组
        foreach ($categoryTypes as $typeId => $typeName) {
            $groupedCategories[$typeId] = array(
                'name' => $typeName,
                'categories' => array()
            );
        }
        
        // 将分类按类型分组
        foreach ($allCategories as $category) {
            $typeId = $category['categoryType'];
            // 只处理二级分类（pid > 0 且 isLeaf = 2）
            if ($category['pid'] > 0 && $category['isLeaf'] == 2) {
                $groupedCategories[$typeId]['categories'][] = $category;
            }
        }
        
        // 移除空的分组
        foreach ($groupedCategories as $typeId => $group) {
            if (empty($group['categories'])) {
                unset($groupedCategories[$typeId]);
            }
        }
        
        $this->categories = $groupedCategories;
        
        $this->config["site_keywords"] = "内容投稿,文章投稿,公众号投稿,小程序投稿,智能体投稿,小游戏投稿";
        $this->config["site_description"] = "在PhoenixFM平台进行内容投稿，分享您的文章、公众号、小程序、智能体、小游戏等优质内容，获得积分奖励。";
        $this->config["site_title"] = "内容投稿 - PhoenixFM";

        $this->display('pc/user_contribute.html');
    }
    
    // 投稿提交处理
    function actioncontributesubmit(){
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        // 检查用户是否登录
        if (!$this->user) {
            echo json_encode(['success' => false, 'message' => '请先登录后再投稿']);
            return;
        }
        
        // 获取POST数据
        $data = json_decode(file_get_contents('php://input'), true);
        
        // 验证必填字段
        if (empty($data['content_type']) || empty($data['title']) || empty($data['description'])) {
            echo json_encode(['success' => false, 'message' => '请填写必填字段']);
            return;
        }
        
        // 准备数据
        $sourceData = [
            'title' => $data['title'],
            'content_type' => $data['content_type'],
            'description' => $data['description'],
            'author' => isset($data['author']) && !empty($data['author']) ? $data['author'] : $this->user['nickName'],
            'create_time' => time(),
            'update_time' => time(),
            'create_uid' => $this->user['id'],
            'creator' => $this->user['nickName'],
            'update_uid' => $this->user['id'],
            'updator' => $this->user['nickName'],
            'content_status' => isset($data['content_status']) && !empty($data['content_status']) ? $data['content_status'] : 3, // 默认为审核中状态
        ];
        
        // 添加可选字段
        $optionalFields = [
            'content_url', 'tags', 'plat', 'area', 'sub_title', 
            'language', 'duration', 'is_free', 'price', 'category_id',
            'account_name', 'author_qq', 'dynasty', 'stars', 'content'
        ];
        
        foreach ($optionalFields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $sourceData[$field] = $data[$field];
            }
        }
        
        // 特殊处理图片字段
        // 处理缩略图
        if (isset($data['thumbnail']) && !empty($data['thumbnail'])) {
            // 如果是数组格式，转换为JSON字符串存储
            if (is_array($data['thumbnail'])) {
                $sourceData['thumbnail'] = json_encode($data['thumbnail']);
            } else {
                $sourceData['thumbnail'] = json_encode([["img"=>$data['thumbnail']]]);
            }
        }
        
        // 处理详情截图
        if (isset($data['describe_images']) && !empty($data['describe_images'])) {
            // 如果是数组格式，转换为JSON字符串存储
            if (is_array($data['describe_images'])) {
                $sourceData['describe_images'] = json_encode($data['describe_images']);
            } else {
                $sourceData['describe_images'] = $data['describe_images'];
            }
        }
        
        // 处理二维码
        if (isset($data['qrcode']) && !empty($data['qrcode'])) {
            $sourceData['qrcode'] = $data['qrcode'];
        }
        
        // 处理作者二维码
        if (isset($data['author_code']) && !empty($data['author_code'])) {
            $sourceData['author_code'] = $data['author_code'];
        }
        
        // 保存到数据库
        $qtSources = new QtSources();
        $result = $qtSources->create($sourceData);
        
        if ($result>0) {
            // 投稿成功，记录积分奖励
            $this->awardContributionPoints($data['content_type'], $this->user['id']);
            
            echo json_encode(['success' => true, 'message' => '投稿成功，等待审核']);
        } else {
            echo json_encode(['success' => false, 'message' => '投稿失败，请稍后再试']);
        }
    }
    
    // 根据内容类型奖励积分
    private function awardContributionPoints($contentType, $userId) {
        // 定义不同类型内容的积分奖励
        $pointAwards = [
            'article' => 50,     // 文章
            'gzh' => 100,        // 公众号
            'agent' => 200,      // 智能体
            'xcx' => 150,        // 小程序
            'xyx' => 180,        // 小游戏
            'video' => 120,      // 视频
            'audio' => 100,      // 音频
            'news' => 30,        // 新闻
            'story' => 40,       // 故事
            'book' => 200,       // 书籍
            'course' => 150,     // 课程
            'image' => 30,       // 图片
            'podcast' => 80      // 播客
        ];
        
        $points = isset($pointAwards[$contentType]) ? $pointAwards[$contentType] : 20;
        
        // 更新用户积分
        $qtUsers = new qt_users();
        $user = $qtUsers->find(['id' => $userId]);
        if ($user) {
            $newBalance = $user['blance'] + $points;
            $qtUsers->update(['id' => $userId], ['blance' => $newBalance]);
        }
        
        // 记录积分变动日志
        $qtPointsLog = new QtPointsLog();
        $logData = [
            'user_id' => $userId,
            'points' => $points,
            'type' => 1, // 1表示获得积分
            'description' => '投稿奖励：' . $contentType,
        ];
        $qtPointsLog->create($logData);
    }
	
	
	
	
	
	/**
	 * 处理推广位申请
	 */
	function actionApplyPromotion() {
        // 设置响应头为JSON格式
        header('Content-Type: application/json');
        
        try {
            // 检查用户是否已登录
            if (!$this->user) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '请先登录后再申请推广位'
                ));
                exit();
            }
            
            // 获取POST数据
            $promotionArea = arg('promotion_area', '');
            $promotionType = arg('promotion_type', '');
            $promotionDays = intval(arg('promotion_days', 0));
            $mediaContent = intval(arg('media_content', 0));
            $promotionUrl = arg('promotion_url', '');
            
            // 验证数据
            if (empty($promotionArea) || empty($promotionType) || empty($promotionDays) || empty($mediaContent)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '请填写完整的申请信息'
                ));
                exit();
            }
            
            
            // 获取用户信息
            $qtUsers = new QtUsers();
            $user = $qtUsers->find(array("id" => $this->user["id"]));
            
            // 获取媒体内容信息
            $qtSources = new QtSources();
            $source = $qtSources->find(array("id" => $mediaContent));
            
            if (!$source) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '选择的媒体内容不存在'
                ));
                exit();
            }
            
            // 检查媒体内容是否属于当前用户
            if ($source["create_uid"] != $this->user["id"]) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '您只能推广自己创建的媒体内容'
                ));
                exit();
            }
            
            // 定义推广区域映射
            $promotionAreas = array(
                '1' => '智能体展示区',
                '2' => '公众号展示区',
                '3' => '小程序展示区',
                '4' => '小游戏展示区',
                '5' => '文章展示区',
                '6' => '精选推荐区'
            );
            
            // 定义推广位类型映射
            $promotionTypes = array(
                '1' => '置顶推广位',
                '2' => '大图推广位',
                '3' => '轮播推广位',
                '4' => '普通推广位',
                '5' => '列表推广位',
                '6' => '网格推广位'
            );
            
            // 定义积分消耗规则（根据推广时长）
            $pointsRequired = 0;
            switch ($promotionDays) {
                case 7:
                    $pointsRequired = 100;
                    break;
                case 30:
                    $pointsRequired = 300;
                    break;
                case 90:
                    $pointsRequired = 800;
                    break;
                default:
                    echo json_encode(array(
                        'success' => false,
                        'message' => '不支持的推广时长'
                    ));
                    exit();
            }
            
            // 检查用户积分是否足够
            if ($user["blance"] < $pointsRequired) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '您的积分不足，当前积分：' . $user["blance"] . '，需要积分：' . $pointsRequired
                ));
                exit();
            }
            
            // 开始事务处理
            $qtPromotion = new QtPromotion();
            $qtPointsLog = new QtPointsLog();
            
            // 扣除用户积分
            $newBalance = $user["blance"] - $pointsRequired;
            $qtUsers->update(array("id" => $user["id"]), array("blance" => $newBalance));
            
            // 记录积分消费日志
            $qtPointsLog->create(array(
                'user_id' => $user["id"],
                'points' => $pointsRequired,
                'type' => 'spend',
                'description' => '申请推广位消费：' . $promotionAreas[$promotionArea] . ' - ' . $promotionTypes[$promotionType] . ' - ' . $promotionDays . '天'
            ));
            
            // 计算推广时间
            $startTime = time();
            $endTime = strtotime("+" . $promotionDays . " days");
            
            // 创建推广位申请记录
            $promotionData = array(
                'position' => $promotionAreas[$promotionArea],
                'desc' => $promotionTypes[$promotionType],
                'medium_id' => $mediaContent,
                'starttime' => $startTime,
                'endtime' => $endTime,
                'consume' => $pointsRequired,
                'uid' => $user["id"],
                'promotion_duration' => $promotionDays,
                'promotion_status' => 1 // 等待投放（等待审核）
            );
            
            $promotionId = $qtPromotion->create($promotionData);
            
            if ($promotionId) {
                // 发送申请成功通知给用户
                $this->sendPromotionApplicationNotification($user["id"], $promotionId, $source["title"], $promotionAreas[$promotionArea], $promotionDays);
                
                echo json_encode(array(
                    'success' => true,
                    'message' => '推广位申请成功，等待管理员审核',
                    'points' => $newBalance
                ));
            } else {
                // 如果创建失败，回滚积分
                $qtUsers->update(array("id" => $user["id"]), array("blance" => $user["blance"]));
                echo json_encode(array(
                    'success' => false,
                    'message' => '申请失败，请稍后再试'
                ));
            }
            
        } catch (Exception $e) {
            // 如果出现异常，回滚积分
            if (isset($qtUsers) && isset($user) && isset($pointsRequired)) {
                $qtUsers->update(array("id" => $user["id"]), array("blance" => $user["blance"]));
            }
            
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误：' . $e->getMessage()
            ));
        }
        
        exit();
	}
	
	/**
	 * 处理媒体认领申请
	 */
    function actionClaimMedia() {
        // 设置响应头为JSON格式
        header('Content-Type: application/json');
        
        try {
            // 检查用户是否已登录
            if (!$this->user) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '请先登录后再认领媒体内容'
                ));
                exit();
            }
            
            // 获取POST数据
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
            $mediaId = intval($data['media_id']);
            
            // 验证数据
            if (empty($mediaId)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '请选择要认领的媒体内容'
                ));
                exit();
            }
            
            // 获取媒体内容信息
            $qtSources = new QtSources();
            $media = $qtSources->find(array("id" => $mediaId));
            
            if (!$media) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '选择的媒体内容不存在'
                ));
                exit();
            }
            
            // 检查媒体内容是否已经被认领
            if (!empty($media["create_uid"]) && $media["create_uid"] != $this->user["id"]) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '该媒体内容已被其他用户认领'
                ));
                exit();
            }
            
            // 检查用户是否已经认领了该媒体内容
            if ($media["create_uid"] == $this->user["id"]) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '您已经认领了该媒体内容'
                ));
                exit();
            }
            
            // 更新媒体内容的创建者信息
            $qtSources->update(
                array("id" => $mediaId), 
                array(
                    "create_uid" => $this->user["id"],
                    "update_time" => time()
                )
            );
            
            // 记录认领日志
            $qtPromotionReferral = new QtPromotionReferral();
            $referralData = array(
                'user_id' => $this->user["id"],
                'media_id' => $mediaId,
                'media_title' => $media["title"],
                'status' => 1, // 1表示待审核
                'create_time' => time()
            );
            $qtPromotionReferral->create($referralData);
            
            echo json_encode(array(
                'success' => true,
                'message' => '认领申请已提交，请等待管理员审核'
            ));
            
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误：' . $e->getMessage()
            ));
        }
        
        exit();
    }
	
	/**
	 * 发送推广位申请通知给用户
	 */
	private function sendPromotionApplicationNotification($userId, $promotionId, $mediaTitle, $promotionArea, $promotionDays) {
	    try {
	        $qtSiteMessages = new QtSiteMessages();
	        
	        $messageData = array(
	            'sender_id' => 0, // 系统消息
	            'receiver_id' => $userId,
	            'title' => '推广位申请提交成功',
	            'content' => '您申请的推广位已成功提交，媒体内容"' . $mediaTitle . '"将在"' . $promotionArea . '"展示' . $promotionDays . '天，等待管理员审核。',
	            'status' => 0, // 未读
	            'created_at' => date('Y-m-d H:i:s')
	        );
	        
	        $qtSiteMessages->create($messageData);
	    } catch (Exception $e) {
	        // 记录错误日志，但不影响主流程
	        error_log("发送推广位申请通知失败: " . $e->getMessage());
	    }
	}
	
	/**
	 * 获取用户可推广的媒体内容
	 */
	function actionGetUserMedia() {
        header('Content-Type: application/json');
        
        try {
            
            
            // 获取用户创建的媒体内容
            $qtSources = new QtSources();
            $mediaList = $qtSources->findAll(array(
                "create_uid" => $this->user["id"],
                "content_status" => 1 // 已上线的内容
            ), "id DESC", "id, title, content_type");
            
            // 格式化媒体内容类型显示
            $contentTypeMap = array(
                'agent' => '智能体',
                'gzh' => '公众号',
                'xcx' => '小程序',
                'xyx' => '小游戏',
                'article' => '文章'
            );
            
            $formattedMedia = array();
            foreach ($mediaList as $media) {
                $formattedMedia[] = array(
                    'id' => $media['id'],
                    'title' => $media['title'] . ' (' . (isset($contentTypeMap[$media['content_type']]) ? $contentTypeMap[$media['content_type']] : $media['content_type']) . ')'
                );
            }
            
            echo json_encode(array(
                'success' => true,
                'data' => $formattedMedia
            ));
            
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '获取媒体内容失败：' . $e->getMessage()
            ));
        }
        
        exit();
	}
    
    /**
     * 积分购买页面
     */
    function actionbuy_points() {
        // 检查用户是否已登录
        if (!$this->user) {
            $this->tips("请先登录", url("pc/main", "login"));
            return;
        }
        
        // 设置页面SEO信息
        $this->config["site_keywords"] = "积分购买,积分充值,购买积分";
        $this->config["site_description"] = "购买积分，获取更多网站服务和特权";
        $this->config["site_title"] = "积分购买 - PhoenixFM";
        
        // 显示模板
        $this->display("pc/user_buy_points.html");
    }
    
    /**
     * 处理积分购买请求
     */
    function actionprocess_buy_points() {
       
        
        // 获取POST参数
        $packageId = intval(arg("package_id"));
        
        // 定义积分套餐 (人民币与积分的汇率根据现有规则设定)
        // 根据观察到的推广积分使用情况，设定1元人民币=10积分的汇率
        $packages = array(
            1 => array("name" => "基础套餐", "price" => 10, "points" => 100),      // 1元=10积分
            2 => array("name" => "标准套餐", "price" => 50, "points" => 550),     // 1元=11积分 (优惠)
            3 => array("name" => "高级套餐", "price" => 100, "points" => 1200),   // 1元=12积分 (更大优惠)
            4 => array("name" => "尊享套餐", "price" => 200, "points" => 2500)    // 1元=12.5积分 (最大优惠)
        );
        
        // 检查套餐是否存在
        if (!isset($packages[$packageId])) {
            echo json_encode(array('success' => false, 'message' => '无效的套餐'), JSON_UNESCAPED_UNICODE);
            return;
        }
        
        $package = $packages[$packageId];
        
        // 创建支付订单记录
        $ZdOrder = new ZdOrder();
        $orderData = array(
            "orderid" => generateOrderId(), // 生成订单ID
            "orderTitle" => $package["name"] . " (" . $package["points"] . "积分)",
            "orderProducts" => $package["name"] . " (" . $package["points"] . "积分)",
            "orderAmount" => $package["price"] * 100, // 转换为分
            "orderStatus" => 1, // 1:待支付
            "orderCreate" => time(),
            "uid" => $this->user["id"],
            "orderType" => 2, // 2:购买积分订单
            "payway" => "weixin", // 微信支付
            "scores" => $package["points"], // 购买的积分数量
            "param" => generateUUID() // 随机参数，用于校验通知结果
        );
        
        $orderId = $ZdOrder->create($orderData);
        
        if ($orderId > 0) {
            // 返回支付信息
            echo json_encode(array(
                'success' => true,
                'message' => '订单创建成功',
                'order_id' => $orderId,
                'out_trade_no' => $orderData["orderid"],
                'amount' => $package["price"],
                'package' => $package
            ), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('success' => false, 'message' => '订单创建失败'), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * 下单
     */
    function actionOrder(){
        $amount =arg("amount",0);
        $payway = arg("payway","");
        $ad_coupon = arg("ad_coupon","");
        $qt_users = new qt_users();
        $user = $qt_users->find(array("userId"=>$this->user["userId"]));
        if($amount<=0){
            error("金额必须大于0");
        }
        if($payway==""){
            error("请选择支付方式");
        }
        
        // 确定实际支付金额
        $actAmount = 0;
        switch($amount){
            case 1:
                $actAmount = 1000; // 10元
                break;
            case 2:
                $actAmount = 5000; // 50 元
                break;
            case 3:
                $actAmount = 10000; // 100 元
                break;
            case 4:
                $actAmount = 20000; // 200 元
                break;
        } 
        $ZdOrder = new ZdOrder();
        $orderId = generateOrderId();
        $param = generateUUID();// 用来校验订单，每笔订单都不一样
        $coupon_id = 0;
        if(!empty($ad_coupon)){
            // 获取优惠券信息，判断优惠券是否属于这个用户，是否过期
            $qt_user_redeemed_coupons = new QtUserRedeemedCoupons();
            $qt_discount_coupons = new QtDiscountCoupons();
            $r = $qt_discount_coupons->find(array("status"=>"active","coupon_code"=>$ad_coupon));
            if($r == false){
                error("优惠券无法使用1");
            }
            $rd = $qt_user_redeemed_coupons->find(array("user_id"=>$user["id"],"status"=>0,"coupon_code"=>$ad_coupon));
            if($rd == false){
                error("优惠券无法使用2");
            }
            $coupon_id = $rd["id"];
            $discount_type = $r["discount_type"];
            $discount_value = $r["discount_value"];
            $min_spend = $r["min_spend"]/1*100;// 转换为分
            // 判断是否满足优惠券使用规则
            if($discount_type=='fixed_amount' && $actAmount<=$min_spend/1){
                error("优惠券无法使用");
            }
            // 根据优惠券为订单减免
            if($discount_type == "fixed_amount"){
                $actAmount = $actAmount/1-$discount_value/1;
            }else if($discount_type == "percentage"){
                $actAmount = $actAmount/1*$discount_value/1;
            }
        }
        
        $newid = $ZdOrder->create(array(
            "orderid"=>$orderId,
            "orderTitle"=>"积分购买",
            "orderProducts"=>"积分购买",
            "orderAmount"=>$actAmount,
            "orderStatus"=>1,
            "orderCreate"=>time(),
            "uid"=>$user["id"],
            "orderType"=>2,
            "param"=>$param,
            "coupon_code"=>$coupon_id,
            "payway"=>$payway
        ));
        if($newid>0){
            
            // 发起支付请求
            $payResult = $this->PayOrder($orderId,number_format($actAmount / 100, 2),$param);
            if($payResult["code"]/1==1){                
                success(array(
                    "qrCodeUrl"=>$payResult["img"],
                    "orderStatusApiUrl"=>url("web/api","GetOrder",array("orderId"=>$orderId))
                ));
            }else{
                $ZdOrder->update(array("id"=>$newid),array("orderStatus"=>4,"payResultDesc"=>$payResult["msg"],"payResult"=>json_encode($payResult,JSON_UNESCAPED_UNICODE)));
                error($payResult["msg"]);
            }
        }else{
            error("订单创建失败，请稍后再试！");
        }
    }
    /**
     * 发起支付请求获取二维码
     * https://z-pay.cn/
     */
    function PayOrder($orderId,$money,$param){
        $money = 0.01;
        $newItem = array(
            "pid"=>$GLOBALS['PAY_PID'],
            "name"=>"积分充值",
            "clientip"=>getIp(),
            "device"=>getDeviceType(),
            "money"=>$money,
            "type"=>"wxpay",
            "out_trade_no"=>$orderId,
            "notify_url"=>url("web/api","PayNotify"),
            "pid"=>generateUUID(),
            "cid"=>"zpay",
            "param"=>$orderId,
            "return_url"=>url("main","PayResult")
        );
        $sign=$this->get_sign($newItem,$GLOBALS['PAY_KEY']);
        $sendResult=getbody($GLOBALS['PAY_URL']."mapi.php","pid=".$GLOBALS['PAY_PID']."&type=wxpay&notify_url=".url("web/api","PayNotify")."&out_trade_no=$orderId&name=积分充值&money=$money&param=$param&sign_type=MD5&sign=$sign");
        
        $log = new spLog();
        $log->log($sendResult,"ERROR");
        if(!empty($sendResult)){
            return json_decode($sendResult,true);
        }else{
            return false;
        }
    }
    /**
     * 生成支付签名
     */
    function get_sign(array $datas,$hashkey){
        ksort($datas);
        reset($datas);
         
        $pre =array();
        foreach ($datas as $key => $data){
            if(is_null($data)||$data===''){continue;}
            if($key=='sign' || $key=='sign_type'){
                continue;
            }
            $pre[$key]=stripslashes($data);
        }
         
        $arg  = '';
        $qty = count($pre);
        $index=0;
         
        foreach ($pre as $key=>$val){
            $arg.="$key=$val";
            if($index++<($qty-1)){
                $arg.="&";
            }
        }
        
        return strtolower(md5($arg.$hashkey));
    }
    /**
     * 支付回调处理（由支付平台回调）
     */
    function actionPointsPaymentCallback() {
        // 获取参数
        $outTradeNo = arg("out_trade_no");
        $paymentStatus = arg("status", "success");
        
        // 查找订单
        $ZdOrder = new ZdOrder();
        $order = $ZdOrder->find(array("orderid" => $outTradeNo));
        
        if (!$order) {
            // 记录错误日志
            error_log("积分购买回调失败：订单不存在，订单号：" . $outTradeNo);
            echo "fail";
            return;
        }
        
        // 获取用户信息
        $qt_users = new QtUsers();
        $user = $qt_users->find(array("id" => $order["uid"]));
        
        if (!$user) {
            // 记录错误日志
            error_log("积分购买回调失败：用户不存在，用户ID：" . $order["uid"]);
            echo "fail";
            return;
        }
        
        if ($order["orderStatus"] == 2) {
            // 订单已支付，无需重复处理
            echo "success";
            return;
        }
        
        if ($paymentStatus == "success") {
            // 更新订单状态为已支付
            $ZdOrder->update(array("id" => $order["id"]), array(
                "orderStatus" => 2, // 2:已支付
                "orderCompleteTime" => time(),
                "payResult" => "支付成功"
            ));
            
            // 提取套餐信息
            $points = $order["scores"];
            $packageName = $order["orderTitle"];
            
            // 更新用户积分
            $newBalance = $user["blance"] + $points;
            $qt_users->update(array("id" => $user["id"]), array("blance" => $newBalance));
            
            // 记录积分变动日志
            $qt_points_log = new QtPointsLog();
            $qt_points_log->create(array(
                "user_id" => $user["id"],
                "points" => $points,
                "type" => "purchase",
                "description" => "购买积分套餐: " . $packageName,
                "created_at" => date("Y-m-d H:i:s")
            ));
            
            // 发送站内消息通知
            sendMessage($user["id"], array(
                "s1" => "购买积分套餐",
                "s2" => $points
            ), "score_send", 0, "积分购买成功");
            
            echo "success";
        } else {
            // 更新订单状态为支付失败
            $ZdOrder->update(array("id" => $order["id"]), array(
                "orderStatus" => 3 // 3:支付失败
            ));
            
            echo "fail";
        }
    }
    
    /**
     * 获取积分购买订单状态
     */
    function actionget_points_order_status() {
        $outTradeNo = arg("out_trade_no");
        
        if (empty($outTradeNo)) {
            echo json_encode(array('code' => 1, 'msg' => '订单号不能为空'), JSON_UNESCAPED_UNICODE);
            return;
        }
        
        // 查找订单
        $ZdOrder = new ZdOrder();
        $order = $ZdOrder->find(array("orderid" => $outTradeNo));
        
        if (!$order) {
            echo json_encode(array('code' => 1, 'msg' => '订单不存在'), JSON_UNESCAPED_UNICODE);
            return;
        }
        
        // 返回订单状态
        echo json_encode(array(
            'code' => 0,
            'msg' => 'success',
            'data' => array(
                'orderStatus' => $order["orderStatus"]
            )
        ), JSON_UNESCAPED_UNICODE);
    }
	
	/**
	 * 管理员审核推广位申请
	 */
	function actionReviewPromotion() {
        header('Content-Type: application/json');
        
        try {
            // 检查是否为管理员（这里简化处理，实际应该有权限验证）
            // if (!$this->isAdmin()) {
            //     echo json_encode(array(
            //         'success' => false,
            //         'message' => '权限不足'
            //     ));
            //     exit();
            // }
            
            $promotionId = intval(arg('promotion_id', 0));
            $action = arg('action', ''); // approve: 通过, reject: 拒绝
            $reason = arg('reason', ''); // 拒绝原因
            
            if (empty($promotionId) || empty($action)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '参数错误'
                ));
                exit();
            }
            
            $qtPromotion = new QtPromotion();
            $promotion = $qtPromotion->find(array("id" => $promotionId));
            
            if (!$promotion) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '推广位申请不存在'
                ));
                exit();
            }
            
            // 检查推广位状态是否为等待审核
            if ($promotion["promotion_status"] != 1) {
                echo json_encode(array(
                    'success' => false,
                    'message' => '该推广位申请状态不正确，无法进行审核'
                ));
                exit();
            }
            
            // 更新推广位状态
            $newStatus = 0;
            if ($action === 'approve') {
                $newStatus = 2; // 投放中
            } elseif ($action === 'reject') {
                $newStatus = 3; // 停止投放
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => '不支持的操作'
                ));
                exit();
            }
            
            $result = $qtPromotion->update(
                array("id" => $promotionId),
                array("promotion_status" => $newStatus)
            );
            
            if ($result) {
                // 发送审核结果通知给用户
                $this->sendPromotionReviewNotification($promotion["uid"], $promotionId, $action, $reason, $promotion);
                
                $message = $action === 'approve' ? '推广位申请已通过' : '推广位申请已拒绝';
                echo json_encode(array(
                    'success' => true,
                    'message' => $message
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => '操作失败，请稍后再试'
                ));
            }
            
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => '系统错误：' . $e->getMessage()
            ));
        }
        
        exit();
	}
	
	/**
	 * 发送推广位审核结果通知给用户
	 */
	private function sendPromotionReviewNotification($userId, $promotionId, $action, $reason, $promotion) {
	    try {
	        $qtSiteMessages = new QtSiteMessages();
	        $qtSources = new QtSources();
	        
	        // 获取媒体内容信息
	        $source = $qtSources->find(array("id" => $promotion["medium_id"]));
	        $mediaTitle = $source ? $source["title"] : '未知内容';
	        
	        $title = $action === 'approve' ? '推广位申请审核通过' : '推广位申请审核未通过';
	        
	        if ($action === 'approve') {
	            $content = '您申请的"' . $mediaTitle . '"推广位申请已通过审核，即将开始展示。';
	        } else {
	            $content = '您申请的"' . $mediaTitle . '"推广位申请未通过审核。';
	            if (!empty($reason)) {
	                $content .= '原因：' . $reason;
	            }
	        }
	        
	        $messageData = array(
	            'sender_id' => 0, // 系统消息
	            'receiver_id' => $userId,
	            'title' => $title,
	            'content' => $content,
	            'status' => 0, // 未读
	            'created_at' => date('Y-m-d H:i:s')
	        );
	        
	        $qtSiteMessages->create($messageData);
	    } catch (Exception $e) {
	        // 记录错误日志，但不影响主流程
	        error_log("发送推广位审核通知失败: " . $e->getMessage());
	    }
	}

    

    /**
     * 推广管理
     */
	function actionPromotion_manage(){
        // 获取当前用户信息
        $qt_users = new QtUsers();
        $user = $qt_users->find(array("id" => $this->user["id"]));
        
        // 从推广统计表获取统计数据
        $qt_promotion_stats = new QtPromotionStats();
        $stats = $qt_promotion_stats->find(array("user_id" => $user["id"]));
        
        if (!$stats) {
            // 如果没有统计数据，初始化为0
            $stats = array(
                "total_referrals" => 0,
                "total_consumption_rebate" => 0
            );
        }
        
        // 查询总收益
        $qt_points_log = new QtPointsLog();
        $result_earn_all = $qt_points_log->query("SELECT SUM(points) as totalEarn FROM qt_points_log WHERE type='income' AND user_id=".$user["id"]);
        
        $this->staticData = array(
            "ref_all" => $stats["total_referrals"],
            "consumed_users" => $stats["total_consumption_rebate"] > 0 ? 1 : 0, // 简化处理
            "earn_all" => empty($result_earn_all[0]["totalEarn"]) ? 0 : $result_earn_all[0]["totalEarn"]
        );
        
        // 查询被邀请用户列表
        $invited_users = $qt_users->query("SELECT u.*, 
            (SELECT SUM(points) FROM qt_points_log WHERE user_id=u.id AND type='spend') as consume_amount,
            (SELECT SUM(points) FROM qt_points_log WHERE user_id=".$user["id"]." AND description LIKE CONCAT('%',u.id,'%') AND type='income') as reward_points
            FROM qt_users u WHERE u.referred_by=".$user["id"]." ORDER BY u.reg_time DESC LIMIT 20");
        
        $this->invited_users = $invited_users;
        
        // 获取推广位列表
        $qtPromotion = new QtPromotion();
        $page = intval(arg('page', 1));
        $pageSize = 10; // 每页显示10条记录
        $offset = ($page - 1) * $pageSize;
        
        // 获取当前用户的推广位总数
        $totalPromotions = $qtPromotion->findCount(array("uid" => $user["id"]));
        
        // 获取当前用户的推广位列表（分页）
        $promotions = $qtPromotion->findAll(
            array("uid" => $user["id"]),
            "id DESC",
            "*",
            array($offset, $pageSize)
        );
        
        // 获取推广位统计数据
        $totalPromotionsCount = $qtPromotion->findCount(array("uid" => $user["id"])); // 总推广位
        $ongoingPromotionsCount = $qtPromotion->findCount(array("uid" => $user["id"], "promotion_status" => 2)); // 进行中
        $pendingPromotionsCount = $qtPromotion->findCount(array("uid" => $user["id"], "promotion_status" => 1)); // 待审核
        $finishedPromotionsCount = $qtPromotion->findCount(array("uid" => $user["id"], "promotion_status" => 3)); // 已结束
        
        // 将统计数据传递给模板
        $this->promotionStats = array(
            "total" => $totalPromotionsCount,
            "ongoing" => $ongoingPromotionsCount,
            "pending" => $pendingPromotionsCount,
            "finished" => $finishedPromotionsCount
        );
        
        // 获取相关的媒体内容信息
        $qtSources = new QtSources();
        foreach ($promotions as &$promotion) {
            $source = $qtSources->find(array("id" => $promotion["medium_id"]));
            $promotion["media_title"] = $source ? $source["title"] : "未知内容";
            $promotion["content_type"] = $source ? $source["content_type"] : "";
            
            // 格式化时间
            $promotion["formatted_starttime"] = date("Y-m-d", $promotion["starttime"]);
            $promotion["formatted_endtime"] = date("Y-m-d", $promotion["endtime"]);
            
            // 状态文本映射
            $statusMap = array(
                1 => "待审核",
                2 => "进行中",
                3 => "已结束"
            );
            $promotion["status_text"] = isset($statusMap[$promotion["promotion_status"]]) ? $statusMap[$promotion["promotion_status"]] : "未知";
            
            // 状态样式映射
            $statusClassMap = array(
                1 => "bg-yellow-100 text-yellow-800",
                2 => "bg-green-100 text-green-800",
                3 => "bg-gray-100 text-gray-800"
            );
            $promotion["status_class"] = isset($statusClassMap[$promotion["promotion_status"]]) ? $statusClassMap[$promotion["promotion_status"]] : "bg-gray-100 text-gray-800";
        }
        
        // 计算分页信息
        $totalPage = ceil($totalPromotions / $pageSize);
        
        // 生成页码数组
        $startPage = max(1, $page - 2);
        $endPage = min($totalPage, $startPage + 4);
        $startPage = max(1, $endPage - 4);
        
        $pageNumbers = array();
        for ($i = $startPage; $i <= $endPage; $i++) {
            $pageNumbers[] = $i;
        }
        
        $this->promotions = $promotions;
        $this->currentPage = $page;
        $this->totalPage = $totalPage;
        $this->totalPromotions = $totalPromotions;
        $this->pageNumbers = $pageNumbers;  // 添加页码数组
        
        // 获取可认领的媒体内容
        $claimable_media = $qtSources->findAll(
            array("content_status" => 1), // 已发布的媒体内容
            "publish_time DESC",
            "*",
            array(0, 20) // 获取前20条记录
        );
        
        // 处理可认领的媒体内容数据
        foreach ($claimable_media as &$media) {
            // 设置默认图标
            $media["icon_class"] = "fa fa-file";
            $media["bg_color_class"] = "bg-gray-200";
            $media["text_color_class"] = "text-gray-600";
            
            // 根据内容类型设置图标和颜色
            switch ($media["content_type"]) {
                case "agent":
                    $media["icon_class"] = "fa fa-robot";
                    $media["bg_color_class"] = "bg-blue-100";
                    $media["text_color_class"] = "text-blue-600";
                    $media["type_label"] = "智能体";
                    $media["type_bg_class"] = "bg-blue-100";
                    $media["type_text_class"] = "text-blue-800";
                    break;
                case "gzh":
                    $media["icon_class"] = "fa fa-weixin";
                    $media["bg_color_class"] = "bg-green-100";
                    $media["text_color_class"] = "text-green-600";
                    $media["type_label"] = "公众号";
                    $media["type_bg_class"] = "bg-green-100";
                    $media["type_text_class"] = "text-green-800";
                    break;
                case "xcx":
                    $media["icon_class"] = "fa fa-th-large";
                    $media["bg_color_class"] = "bg-purple-100";
                    $media["text_color_class"] = "text-purple-600";
                    $media["type_label"] = "小程序";
                    $media["type_bg_class"] = "bg-purple-100";
                    $media["type_text_class"] = "text-purple-800";
                    break;
                case "xyx":
                    $media["icon_class"] = "fa fa-gamepad";
                    $media["bg_color_class"] = "bg-yellow-100";
                    $media["text_color_class"] = "text-yellow-600";
                    $media["type_label"] = "小游戏";
                    $media["type_bg_class"] = "bg-yellow-100";
                    $media["type_text_class"] = "text-yellow-800";
                    break;
                default:
                    $media["type_label"] = "文章";
                    $media["type_bg_class"] = "bg-gray-100";
                    $media["type_text_class"] = "text-gray-800";
                    break;
            }
            
            // 格式化时间
            $media["formatted_publish_time"] = date("Y-m-d", $media["publish_time"]);
        }
        $this->claimable_media = $claimable_media;
        
        $this->display("pc/user_recommendation.html");
    }

    /**
     * 获取可认领的媒体内容（AJAX接口）
     */
    function actionGetClaimableMedia(){
        // 设置响应头为JSON
        header('Content-Type: application/json');
        
        try {
            // 获取分页参数
            $page = intval(arg('page', 1));
            $pageSize = 10; // 每页显示10条记录
            $offset = ($page - 1) * $pageSize;
            
            // 获取搜索和筛选参数
            $type = arg('type', '');
            $keyword = arg('keyword', '');
            
            // 获取可认领的媒体内容
            $qtSources = new QtSources();
            
            // 构建SQL查询条件
            $whereClause = "content_status = 1";
            $params = array();
            
            // 添加类型筛选条件
            if (!empty($type)) {
                $whereClause .= " AND content_type = :type";
                $params[":type"] = $type;
            }
            
            // 添加关键词搜索条件
            if (!empty($keyword)) {
                $whereClause .= " AND title LIKE :word";
                $params[":word"] = '%' . $keyword . '%';
            }
            
            // 获取可认领的媒体内容总数
            $countSql = "SELECT COUNT(*) as count FROM qt_sources WHERE " . $whereClause;
            $countResult = $qtSources->query($countSql, $params);
            $totalClaimableMedia = $countResult[0]['count'];
            
            // 获取可认领的媒体内容（分页）
            $sql = "SELECT * FROM qt_sources WHERE " . $whereClause . " ORDER BY publish_time DESC LIMIT :offset, :pageSize";
            $params[":offset"] = $offset;
            $params[":pageSize"] = $pageSize;
            $claimable_media = $qtSources->query($sql, $params);
            // 处理可认领的媒体内容数据
            foreach ($claimable_media as &$media) {
                // 设置默认图标
                $media["icon_class"] = "fa fa-file";
                $media["bg_color_class"] = "bg-gray-200";
                $media["text_color_class"] = "text-gray-600";
                
                // 根据内容类型设置图标和颜色
                switch ($media["content_type"]) {
                    case "agent":
                        $media["icon_class"] = "fa fa-robot";
                        $media["bg_color_class"] = "bg-blue-100";
                        $media["text_color_class"] = "text-blue-600";
                        $media["type_label"] = "智能体";
                        $media["type_bg_class"] = "bg-blue-100";
                        $media["type_text_class"] = "text-blue-800";
                        break;
                    case "gzh":
                        $media["icon_class"] = "fa fa-weixin";
                        $media["bg_color_class"] = "bg-green-100";
                        $media["text_color_class"] = "text-green-600";
                        $media["type_label"] = "公众号";
                        $media["type_bg_class"] = "bg-green-100";
                        $media["type_text_class"] = "text-green-800";
                        break;
                    case "xcx":
                        $media["icon_class"] = "fa fa-th-large";
                        $media["bg_color_class"] = "bg-purple-100";
                        $media["text_color_class"] = "text-purple-600";
                        $media["type_label"] = "小程序";
                        $media["type_bg_class"] = "bg-purple-100";
                        $media["type_text_class"] = "text-purple-800";
                        break;
                    case "xyx":
                        $media["icon_class"] = "fa fa-gamepad";
                        $media["bg_color_class"] = "bg-yellow-100";
                        $media["text_color_class"] = "text-yellow-600";
                        $media["type_label"] = "小游戏";
                        $media["type_bg_class"] = "bg-yellow-100";
                        $media["type_text_class"] = "text-yellow-800";
                        break;
                    default:
                        $media["type_label"] = "文章";
                        $media["type_bg_class"] = "bg-gray-100";
                        $media["type_text_class"] = "text-gray-800";
                        break;
                }
                
                // 格式化时间
                $media["formatted_publish_time"] = date("Y-m-d", $media["publish_time"]);
            }
            
            $list = [];
            foreach($claimable_media as $k=>$v){
                $claimable_media[$k]["thumbnail"] = !empty($v["thumbnail"])?json_decode($v["thumbnail"],true):array(array("img"=>$this->config["default_thumbnail"]));
                $thumbnail = $claimable_media[$k]["thumbnail"];
                
                if(!empty($thumbnail) && count($thumbnail)){
                    $claimable_media[$k]["thumbnail"] = $thumbnail[0]["img"];
                }else{
                    $claimable_media[$k]["thumbnail"] = $this->config["default_thumbnail"];
                }
                
            }

            // 计算分页信息
            $totalPage = ceil($totalClaimableMedia / $pageSize);
            
            // 生成页码数组
            $startPage = max(1, $page - 2);
            $endPage = min($totalPage, $startPage + 4);
            $startPage = max(1, $endPage - 4);
            
            $pageNumbers = array();
            for ($i = $startPage; $i <= $endPage; $i++) {
                $pageNumbers[] = $i;
            }
            
            // 构造返回数据
            $responseData = array(
                "success" => true,
                "data" => array(
                    "media" => $claimable_media,
                    "pagination" => array(
                        "currentPage" => $page,
                        "totalPage" => $totalPage,
                        "totalItems" => $totalClaimableMedia,
                        "pageNumbers" => $pageNumbers,
                        "startItem" => ($page - 1) * $pageSize + 1,
                        "endItem" => min($page * $pageSize, $totalClaimableMedia)
                    )
                )
            );
            
            echo json_encode($responseData);
        } catch (Exception $e) {
            // 错误处理
            $errorResponse = array(
                "success" => false,
                "message" => $e->getMessage()
            );
            echo json_encode($errorResponse);
        }
    }
    /**
     * 推广管理
     */
	function actionAdminPromotionReview() {
        // 这里应该检查管理员权限
        // if (!$this->isAdmin()) {
        //     $this->tips('权限不足', url('pc/main', 'index'));
        //     return;
        // }
        
        // 获取待审核的推广位申请
        $qtPromotion = new QtPromotion();
        $pendingPromotions = $qtPromotion->findAll(
            array("promotion_status" => 1), // 等待审核的状态
            "id DESC"
        );
        
        // 获取相关的媒体内容和用户信息
        $qtSources = new QtSources();
        $qtUsers = new QtUsers();
        
        foreach ($pendingPromotions as &$promotion) {
            // 获取媒体内容信息
            $source = $qtSources->find(array("id" => $promotion["medium_id"]));
            $promotion["media_title"] = $source ? $source["title"] : "未知内容";
            $promotion["content_type"] = $source ? $source["content_type"] : "";
            
            // 获取用户信息
            $user = $qtUsers->find(array("id" => $promotion["uid"]));
            $promotion["user_name"] = $user ? $user["nickName"] : "未知用户";
            $promotion["user_id"] = $user ? $user["id"] : 0;
            
            // 格式化时间
            $promotion["formatted_starttime"] = date("Y-m-d H:i", $promotion["starttime"]);
            $promotion["formatted_endtime"] = date("Y-m-d H:i", $promotion["endtime"]);
        }
        
        $this->pendingPromotions = $pendingPromotions;
        $this->display("pc/admin_promotion_review.html");
    }
    
    /**
     * 我的稿件页面
     */
    function actionmyarticles() {
        // 检查用户是否已登录
        if (!$this->user) {
            $this->tips("请先登录", url("pc/main", "login"));
            return;
        }
        
        // 获取分页参数
        $page = intval(arg("page", 1));
        $pageSize = 10; // 每页显示10条记录
        $offset = ($page - 1) * $pageSize;
        
        // 创建模型实例
        $qtSources = new QtSources();
        
        // 获取当前用户的所有稿件总数
        $totalArticles = $qtSources->findCount(array(
            "create_uid" => $this->user["id"]
        ));
        
        // 计算总页数
        $totalPages = ceil($totalArticles / $pageSize);
        
        // 确保页码在有效范围内
        if ($page < 1) $page = 1;
        if ($page > $totalPages && $totalPages > 0) $page = $totalPages;
        
        // 获取当前页的稿件列表，按创建时间倒序排列
        $articles = $qtSources->findAll(
            array("create_uid" => $this->user["id"]),
            "create_time DESC",
            "*",
            array($offset, $pageSize)
        );
        
        // 处理稿件数据
        $processedArticles = array();
        foreach ($articles as $article) {
            // 格式化时间显示
            $article["formatted_time"] = date("Y-m-d H:i", $article["create_time"]);
            
            // 内容类型中文映射
            $contentTypeMap = array(
                "article" => "文章",
                "gzh" => "公众号",
                "xcx" => "小程序",
                "xyx" => "小游戏",
                "agent" => "智能体",
                "video" => "视频",
                "audio" => "音频",
                "news" => "新闻",
                "story" => "故事",
                "book" => "书籍",
                "course" => "课程",
                "image" => "图片",
                "podcast" => "播客"
            );
            
            $article["content_type_text"] = isset($contentTypeMap[$article["content_type"]]) ? 
                $contentTypeMap[$article["content_type"]] : $article["content_type"];
            
            // 状态中文映射
            $statusMap = array(
                1 => "已上线",
                2 => "已下线",
                3 => "审核中"
            );
            
            $article["status_text"] = isset($statusMap[$article["content_status"]]) ? 
                $statusMap[$article["content_status"]] : "未知状态";
            
            // 根据状态设置样式类
            switch ($article["content_status"]) {
                case 1:
                    $article["status_class"] = "text-green-600 bg-green-100";
                    break;
                case 2:
                    $article["status_class"] = "text-gray-600 bg-gray-100";
                    break;
                case 3:
                    $article["status_class"] = "text-yellow-600 bg-yellow-100";
                    break;
                default:
                    $article["status_class"] = "text-gray-600 bg-gray-100";
            }
            
            // 处理缩略图
            if (!empty($article["thumbnail"])) {
                $thumbnails = json_decode($article["thumbnail"], true);
                if (is_array($thumbnails) && !empty($thumbnails)) {
                    $article["thumbnail_url"] = $thumbnails[0]["img"];
                } else {
                    $article["thumbnail_url"] = $article["thumbnail"];
                }
            } else {
                $article["thumbnail_url"] = "/i/img/default-thumbnail.png";
            }
            
            $processedArticles[] = $article;
        }
        
        // 生成页码数组
        $pageNumbers = array();
        for ($i = 1; $i <= $totalPages; $i++) {
            $pageNumbers[] = $i;
        }
        
        // 传递数据到模板
        $this->articles = $processedArticles;
        $this->totalArticles = $totalArticles;
        $this->currentPage = $page;
        $this->totalPages = $totalPages;
        $this->pageNumbers = $pageNumbers;
        $this->pageSize = $pageSize;
        
        // 设置页面SEO信息
        $this->config["site_keywords"] = "我的稿件,内容管理,投稿管理";
        $this->config["site_description"] = "管理您在PhoenixFM平台投稿的所有稿件内容";
        $this->config["site_title"] = "我的稿件 - PhoenixFM";
        
        // 显示模板
        $this->display("pc/user_myarticles.html");
    }
    
    /**
     * 404错误页面
     */
    function actionNotFound() {
        // 设置HTTP状态码为404
        header("HTTP/1.1 404 Not Found");
        
        // 设置页面SEO信息
        $this->config["site_keywords"] = "404,页面未找到,错误页面";
        $this->config["site_description"] = "抱歉，您访问的页面不存在";
        $this->config["site_title"] = "页面未找到 - PhoenixFM";
        
        // 显示404页面模板
        $this->display("pc/404.html");
    }

}
