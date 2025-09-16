<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "protected/include/ks3File/Ks3Client.class.php";
require_once "protected/include/ks3File/core/Utils.class.php";

// 字符串截取
function truncateTitle($title, $length = 20, $etc = '...') {
    if (mb_strlen($title, 'UTF-8') > $length) {
        return mb_substr($title, 0, $length, 'UTF-8') . $etc;
    }
    return $title;
}


// 验证是否是网络图片地址
function is_valid_image_url($url) {
    // 检查是否是有效的 URL
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }
    // 获取 URL 的头信息
    $headers = @get_headers($url, 1);
    if ($headers === false) {
        return false;
    }
    // 检查是否包含 Content-Type 头信息
    if (!isset($headers['Content-Type'])) {
        return false;
    }
    $content_type = $headers['Content-Type'];
    // 检查 Content-Type 是否是图片类型
    $image_types = array(
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/bmp',
        'image/webp',
        'image/svg+xml'
    );
    if (in_array($content_type, $image_types)) {
        return true;
    }
    return false;
}

// 格式化时间
function timeToRelativeString($timestamp) {
    // 将时间戳转换为当前时区的 DateTime 对象
    $time = new DateTime("@$timestamp");
    // 获取当前时间的 DateTime 对象
    $now = new DateTime();
    // 计算两个时间点之间的间隔
    $interval = $now->diff($time);

    // 判断时间是在当前时间之前还是之后
    $isFuture = $interval->invert ? '前' : '后';

    if ($interval->y > 0) {
        // 如果差值超过1年，按照“年月日”格式返回
        return $time->format('Y年m月d日');
    } elseif ($interval->m > 0) {
        // 如果差值超过1个月但不超过1年，按照“年月日”格式返回
        return $time->format('Y年m月d日');
    } elseif ($interval->d >= 1) {
        // 如果差值超过1天但不超过1个月，返回天数
        return $interval->d . "天" . $isFuture;
    } elseif ($interval->h >= 1) {
        // 如果差值超过1小时但不超过24小时，返回小时数
        return $interval->h . "小时" . $isFuture;
    } elseif ($interval->i >= 1) {
        // 如果差值超过1分钟但不超过60分钟，返回分钟数
        return $interval->i . "分钟" . $isFuture;
    } else {
        // 如果差值小于1分钟，返回“刚刚”
        return "刚刚";
    }
}

function splitList($list) {
    $left = [];
    $right = [];
    $count = count($list);
    $half = (int)ceil($count / 2); // 向上取整，确保左边多一个元素
    for ($i = 0; $i < $count; $i++) {
        if ($i < $half) {
            $left[] = $list[$i];
        } else {
            $right[] = $list[$i];
        }
    }
    return ['leftList' => $left, 'rightList' => $right];
}
// 验证字符串是否是IP地址，支持ipv4、ipv6
function is_valid_ip($input) {
    // 先尝试验证为 IPv4 地址
    if (filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return true;
    }
    // 再尝试验证为 IPv6 地址
    if (filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        return true;
    }
    // 都不符合则返回 false
    return false;
}

/**
 * 获取网络文件大小
*/
function get_file_size($url) {
    $url = parse_url($url);
    if (empty($url['host'])) {
        return false;
    }
    $url['port'] = empty($url['post']) ? 80 : $url['post'];
    $url['path'] = empty($url['path']) ? '/' : $url['path'];
    $fp = fsockopen($url['host'], $url['port'], $error);
    if($fp) {
        fputs($fp, "GET " . $url['path'] . " HTTP/1.1\r\n");
        fputs($fp, "Host:" . $url['host']. "\r\n\r\n");
        while (!feof($fp)) {
            $str = fgets($fp);
            if (trim($str) == '') {
                break;
            }else if(preg_match('/Content-Length:(.*)/si', $str, $arr)){
                return trim($arr[1]);
            }
        }
        fclose ( $fp);
        return false;
    }else{
        return false;
    }
}
/**
 * 判断文件类型
 * 文本：js\css\html\htm\xhtml\txt\cvs\xml\pdf\doc\ppt\xlsx\xls\pptx\docx
 * 图片：jpg\jpeg\jpe\jp2\gif\png\ico\svg\bmp
 * 音视频：mp3\mp4\mov\mpe\mpeg\mpeg\wma
 * 其他：zip\swf\ttf\eot\otf\fon\font\ttc\woff\woff2
*/
function chkFType($mimetype){
    $typearr=array('js','css','html','htm','xhtml','xml','txt','cvs','pdf','doc','docx','ppt','pptx','xls','xlsx','jpg','jpeg','jpe','jp2','gif','png','ico','svg','bmp','mp3','mp4','mov','mpe','mpeg','wma','zip','swf','ttf','eot','otf','fon','font','ttc','woff','woff2','JPG','PNG','JPEG','GIF','BMP');
    if(in_array($mimetype,$typearr)){
        return true;
    }else{
        return false;
    }
}
/**
 * 上传网络文件
 * 拉取网络文件到本地，然后上传到k3存储
*/
function putFetch($url, $iswater = false) {
    // 判断网络文件大小
    $f_len = get_file_size($url);
    if ($f_len > 1024 * 1024 * 10) {
        return array("success" => false, "msg" => "文件超过10M");
    } else {
        if(empty($url)){
            return array("success" => false, "msg" => "Url为空");
        }
        // 判断地址是否可以访问
        $getHeader = get_headers($url);
        if ($getHeader[0] == "HTTP/1.1 200 OK" || $getHeader[0] == "HTTP/1.0 200 OK") {
            // 重命名并且下载
            $filepath = download_file($url);
            if (!file_exists($filepath)) {
                return array("success" => false, "msg" => "文件下载失败");
            }

            // 获取文件名和扩展名
            $arr = parse_url($url);
            $basename = isset($arr['path']) ? basename($arr['path']) : '';
            $extension = isset(pathinfo($basename)["extension"]) ? pathinfo($basename)["extension"] : '';

            if (empty($extension) || strpos($extension, '@') !== false) {
                // 如果没有扩展名或者扩展名不正确，尝试从 Content-Type 中获取
                $content_type = get_headers($url, 1)['Content-Type'];
                if ($content_type) {
                    $extension = strtolower(substr(strrchr($content_type, '/'), 1));
                }
            }

            if (empty($extension)) {
                // 如果仍然没有扩展名，使用默认扩展名
                $extension = 'bin';
            }

            // 清理文件名
            $path = generateUUID().'.' . $extension;
            // 判断文件类型
            $chktype = chkFType($extension);
            if ($chktype) {
                // 上传文件
                $result = putObjectByFile($filepath, $path);
                if ($iswater) {
                    $result["outurl"] = "http://p1.renbenzhihui.com/" . $path . "?iswater";
                } else {
                    $result["outurl"] = "http://p1.renbenzhihui.com/" . $path;
                }
                //unlink($filepath);
                return array("success" => true, "msg" => "上传成功", "data" => $result);
            } else {
                // 删除文件
                //unlink($filepath);
                print_r($filepath);
                print_r('<br />');
                return array("success" => false, "msg" => "文件类型不允许上传");
            }
        } else {
            return array("success" => false, "msg" => "资源无法访问：" . $getHeader[0]);
        }
    }
}
/**
 * 单文件上传
*/
function putObjectByFile($file,$key,$Bucket="bucket1imgs"){
	//$file = "D://550_325569_1535952502.jpg";
	if(Utils::chk_chinese($file)){
		$file = iconv('utf-8','gbk',$file);
	}
	$content = $file;
	$total = Utils::getFileSize($file);
	$args = array(
		"Bucket"=>$Bucket,
		"Key"=>$key,
		"ACL"=>"public-read",
		"ObjectMeta"=>array(
			"Content-Length"=>$total		
			),
		"Content"=>array(
			"content"=>$content
		),
	);
	
	$client = new Ks3Client("AKLTRy8w6Sg5TsiKlqptxF4Few","OFtAroQ8SOaSgtlHM6DlVaKNcZ9Psa2O0l0Rpr8Oj6XqTOww9XStw+PhXOjihLi5Kw==","ks3-cn-beijing.ksyun.com");
	return $client->putObjectByFile($args);
} 
/**
 * 获取设备类型
 */
function getDeviceType($userAgent = null) {
    // 如果没有提供用户代理字符串，则使用当前请求的HTTP_USER_AGENT
    if (is_null($userAgent)) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
    }

    // 定义一些设备和浏览器的关键字
    $mobileKeywords = ['Mobile', 'iPhone', 'Android'];
    $tabletKeywords = ['iPad', 'Tablet'];

    // 检查是否为移动设备
    foreach ($mobileKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return 'mobile';
        }
    }

    // 检查是否为平板设备
    foreach ($tabletKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return 'tablet';
        }
    }

    // 默认为桌面设备
    return 'pc';
}
/**
     * 下载网络文件
    */
    function download_file($url) {
        $time = time();
        $arr = parse_url($url);
        $arr2 = pathinfo($arr['path']);
        $local_path = dirname(__FILE__) . '/cacheLittleFile';
        $extension = isset($arr2["extension"]) ? $arr2["extension"] : '';
    
        if (empty($extension) || strpos($extension, '@') !== false) {
            // 如果没有扩展名或者扩展名不正确，尝试从 Content-Type 中获取
            $content_type = get_headers($url, 1)['Content-Type'];
            if ($content_type) {
                $extension = strtolower(substr(strrchr($content_type, '/'), 1));
            }
        }
    
        if (empty($extension)) {
            // 如果仍然没有扩展名，使用默认扩展名
            $extension = 'bin';
        }
    
        $filename = 'lf-' . $time . '.' . $extension;
        $local = $local_path . '/' . $filename;
    
        // 确保本地路径存在
        if (!file_exists($local_path)) {
            mkdir($local_path, 0777, true);
            chmod($local_path, 0777);
        }
    
        // 下载文件
        $img = file_get_contents($url);
        if ($img === false) {
            return false; // 下载失败
        }
    
        // 保存文件
        file_put_contents($local, $img);
        return $local;
    }

/**
 * 发送验证码
*/
function sendMail($email, $subject, $htmlResult){
    // 创建PHPMailer实例
    $mail = new PHPMailer(true);

    try {
        // 设置邮件的字符编码和语言
        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('zh_cn');

        // 设置邮件头部
        $mail->isSMTP(); // 使用SMTP
        $mail->Host = 'smtp.exmail.qq.com'; // SMTP服务器地址
        $mail->SMTPAuth = true; // 启用SMTP验证
        $mail->Username = 'lichangxue@renbenai.com'; // SMTP用户名
        $mail->Password = '85927196369Lyy'; // SMTP密码
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // 强制使用SMTPS协议
        $mail->Port = 465; // SMTP端口号，如果是587可以用PHPMailer::ENCRYPTION_STARTTLS来进行配置

        // 设置发件人地址和名称
        $mail->setFrom('lichangxue@renbenai.com', $subject);
        
        // 收件人
        $mail->addAddress($email);

        // 邮件主题
        $mail->Subject = $subject;

        // 邮件正文
        $mail->isHTML(true); // 设置为HTML邮件
        $mail->Body = $htmlResult;

        // 发送邮件
        $mail->send();
        return true;
    } catch (Exception $e) {
        // 邮件发送出错
        //echo "邮件发送失败: {$mail->ErrorInfo}";
        return false;
    }
}
/**
 * 验证图片是否符合指定尺寸
*/
function validateImgSize($imgurl,$req_width,$req_height){
    $ch = curl_init();
            
    // 设置cURL选项
    curl_setopt($ch, CURLOPT_URL, $imgurl);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    
    // 执行cURL会话并获取图片内容
    $imageData = curl_exec($ch);
    
    // 关闭cURL会话
    curl_close($ch);
    
    // 临时保存图片内容到字符串
    $tempFile = tempnam(sys_get_temp_dir(), 'img');
    file_put_contents($tempFile, $imageData);
    
    // 使用getimagesize()函数获取图片尺寸
    $imageSize = getimagesize($tempFile);
    
    if ($imageSize) {
        $width = $imageSize[0];
        $height = $imageSize[1];
        if($width != $req_width || $height != $req_height){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}
/**
 * 验证Url是否能正常访问
*/
function isUrlAccessible($url) {
    // 初始化cURL会话
    $ch = curl_init($url);

    // 设置cURL选项
    curl_setopt($ch, CURLOPT_NOBODY, true); // 仅检查HTTP头
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // 允许重定向
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 返回结果而不是直接输出
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置超时时间

    // 执行cURL会话
    $data = curl_exec($ch);

    // 获取HTTP状态码
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // 关闭cURL会话
    curl_close($ch);

    // 检查HTTP状态码是否为200（成功）
    return $httpcode == 200;
}
/**
 * 验证Url地址
*/
function validateUrl($url) {
    // 正则表达式匹配URL，支持http, https, ftp, ftps协议，以及查询参数
    $pattern = "/^(https?|ftp|ftps):\/\/[a-zA-Z0-9-.]+\.[a-zA-Z]{2,3}(\/\S*)?$/";

    // 使用filter_var进行验证，FILTER_VALIDATE_URL检查URL是否有效
    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
        // 进一步使用正则表达式检查URL是否符合特定格式
        return preg_match($pattern, $url);
    }

    return false;
}
/**
 * 验证字符串：最多16个字符或者8个汉字
*/
function isValidString($str) {
    return isValidStringForLen($str,8);
}
/**
 * 验证字符串：特定长度
*/
function isValidStringForLen($str,$len) {
    // 计算字符串的长度（字符数）
    $strlen = mb_strlen($str, 'UTF-8');
    
    // 计算汉字的数量，假设汉字为3个字节
    $chineseCharCount = mb_strlen($str, 'UTF-8') - mb_strlen($str, 'ASCII');
    
    // 如果字符串长度不超过16且汉字数量不超过8，则验证通过
    if ($strlen <= 2*$len && $chineseCharCount <= $len) {
        return true;
    }
    
    return false;
}
/**
 * 返回正确结果
 */
function success($data=array(), $msg="success"){
    $res = array(
        "status" => 0,
        "data" => $data,
        "msg"  => $msg
    );
    header("Content-Type:application/json;charset=utf-8");
    echo json_encode($res,JSON_UNESCAPED_UNICODE);
    exit;
}
/**
 * 返回错误结果
 */
function error($msg="err", $code=400){
    $res = array(
        "status" => $code,
        "msg"  => $msg,
        "data"=>array()
    );
    header("Content-Type:application/json;charset=utf-8");
    echo json_encode($res,JSON_UNESCAPED_UNICODE);
    exit;
}
/**
 * 获取IP地址
 */
function getIp(){
    $ip = '';
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // 如果IP地址可能被伪造，进一步处理
    $ip = filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '';
      return $ip;
}
 /**
 * 判断是否为空或者为0
 */
function isNullOrEmpty($paramName,$defaultValue=""){
    if(isset($paramName) && !empty($paramName)){
        if($paramName/1 == -9999){
            return 0;
        }
        return $paramName;
    }else{
        return $defaultValue;
    }
}
/**
 * 生成6位随机的验证码
*/
function generateSMSCode() {
    $code = '';
    for ($i = 0; $i < 6; $i++) {
      $code .= rand(0, 9); // 将每个随机数字拼接到验证码字符串中
    }
    return $code; // 返回生成的6位随机数字验证码
}
/**
 * 生成UUID
*/
function generateUUID($length = 36) {
    if (function_exists('com_create_guid')) {
        $uuid = com_create_guid();
    } else {
        mt_srand((double)microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
    }
    return substr($uuid, 0, $length);
}
/**
 * 生成订单号
 */
function generateOrderId($prefix = '20') {
    // 获取当前的时间戳的整数部分，即秒数
    $timestamp = (int) time();
    
    // 将时间戳转换为字符串，并确保是14位长，不足前面补0
    $timestampStr = str_pad((string)$timestamp, 14, '0', STR_PAD_LEFT);
    
    // 生成一个随机数，这里使用14位，可以根据需要调整长度
    // 使用 str_pad 确保随机数是14位的字符串
    $randomPart = str_pad((string)rand(1, 999999999999), 14, '0', STR_PAD_LEFT);
    
    // 组合订单编号，前面添加前缀
    $orderId = $prefix . $timestampStr . $randomPart;
    
    // 返回生成的订单编号
    return mb_substr($orderId, 0, $prefix);
}
/**
 * 读取json文件
 * @param string $filePath 文件路径
 * @return array
 */
function readJsonFileToArray($filePath) {
    // 确保文件存在
    if (!file_exists($filePath)) {
        throw new Exception("文件不存在: " . $filePath);
    }

    // 读取文件内容
    $fileContent = file_get_contents($filePath);

    // 将JSON字符串解码为PHP数组
    $data = json_decode($fileContent, true);

    // 检查JSON解码是否成功
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("JSON解码错误: " . json_last_error_msg());
    }

    // 返回解码后的数组
    return $data;
}
/**
 * 发送GET请求
 * @param string $url
 * @return mixed
 */
function sendGet($url){
    $ch = curl_init();
    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    //执行并获取HTML文档内容
    $output = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    return $output;
} 
/**
 * 发送post请求
 * @param string $url
 * @param array $post_data
 * @return mixed
 */
function sendGetWithHead($url,$header){
    $ch = curl_init();
    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 

    //执行并获取HTML文档内容
    $output = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    return $output;
} 
/**
 * 发送https请求
 * @param string $url
 * @param string $header
 * @return mixed
 */
function sendHttps($url,$header=''){

    //$url ="https://ccdcapi.alipay.com/validateAndCacheCardInfo.json?_input_charset=utf-8&cardNo=".$bank_card."&cardBinCheck=true";

    $ch = curl_init();

    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if(!empty($header)){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
    }
    //执行并获取HTML文档内容
    $output = curl_exec($ch);

    //释放curl句柄
    curl_close($ch);
    return $output;
}
/**
 * PHP发送Json对象数据
 * @param $url 请求url
 * @param $jsonStr 发送的json字符串
 * @return array
 */
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($httpCode, $response);
}
/**
 * PHP发送Json对象数据
 * @param $url 请求url
 * @param $jsonStr 发送的json字符串
 * @return array
 */
function http_post_json_authorization($url, $jsonStr,$key)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Bearer '.$key,
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($httpCode, $response);
}
/**
 * 模拟post进行url请求
 * @param string $url
 * @param string $data_string
 * @param string $header
 * @return array
 */
function http_post_data($url, $data_string,$header='') {   
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    if(!empty($header)){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
    }
    ob_start(); 
    curl_exec($ch); 
    $return_content = ob_get_contents(); 
    ob_end_clean(); 
    $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    // return array($return_code, $return_content); 
    return $return_content; 
} 
/**
* 综合方法
* 
* @param mixed $url             访问的URL，暂时不支持https
* @param mixed $post            要传递的数据  (不填则为GET)
* @param mixed $header          Header头
* @param mixed $cookie          提交的$cookies                         
* @param mixed $returnCookie    是否返回$cookies
*/
 function sendPost($url,$post='',$header='',$cookie='', $returnCookie=0){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if(!empty($header)){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        //curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3000);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if($returnCookie){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        }else{
            return $data;
        }
}
/**
 * 格式化数目
 */
function format_number($number) {
    // 定义单位数组
    $units = array("", "万", "亿");
    $unitIndex = 0; // 单位索引

    // 将数字转换为浮点数
    $num = (float)$number;

    // 根据数字大小选择单位
    while ($num >= 10000) {
        $num /= 10000;
        ++$unitIndex;
    }

    // 格式化数字为字符串，并保留一位小数（如果不是整数则保留）
    $formattedNum = ($unitIndex > 0) ? round($num, 1) : intval($num);
    $formattedNumStr = strval($formattedNum);
    $formattedNumStr = ($formattedNumStr[strlen($formattedNumStr) - 1] === '0') ? rtrim($formattedNumStr, '0') : $formattedNumStr;

    // 添加单位
    $formattedNumStr .= $units[$unitIndex];

    return $formattedNumStr;
}
/**
 * 字符串超长用省略号
 */
function truncateStringWithEllipsis($string, $length, $appendEllipsis = true) {
    // 如果字符串长度小于或等于指定长度，则返回原字符串
    if (mb_strlen($string, 'UTF-8') <= $length) {
        return $string;
    }

    // 截取指定长度的字符串
    $truncatedString = mb_substr($string, 0, $length, 'UTF-8');

    // 如果需要添加省略号
    if ($appendEllipsis) {
        $truncatedString .= '...';
    }

    return $truncatedString;
}
function GetBody($url, $xml,$method='POST'){    
    $second = 30;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    $data = curl_exec($ch);
    if($data){
      curl_close($ch);
      return $data;
    } else { 
      $error = curl_errno($ch);
      curl_close($ch);
      return false;
    }
}
/**
 * 手机号码隐藏
 */
function formatPhoneNumber($phoneNumber) {
    // 检查手机号长度是否符合标准手机号长度
    if (strlen($phoneNumber) != 11) {
        return '手机号格式不正确';
    }

    // 提取前三位和后四位
    $firstThree = substr($phoneNumber, 0, 3);
    $lastFour = substr($phoneNumber, -4);

    // 使用星号替换中间的四位数字
    $middleStars = str_repeat('*', 4);

    // 拼接最终的手机号格式
    $formattedPhoneNumber = $firstThree . $middleStars . $lastFour;

    return $formattedPhoneNumber;
}

// 输入过滤函数
function filterInput($input) {
    // 对于字符串类型的输入，使用 htmlspecialchars 转义特殊字符，防止 XSS 攻击
    if (is_string($input)) {
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    // 对于数字类型的输入，确保它确实是一个数字
    if (is_numeric($input)) {
        $input = (int) $input;
    }
    return $input;
}

//=======================================涉及表单操作的通用函数==============================================



/**
 * 递归获取评论列表
*/
function getCommentTree($pid=0,$item_id){
    $QtComments = new QtComments();
    $QtUsers = new QtUsers();
    $tree = [];
    $results = $QtComments->query("SELECT * FROM qt_comments WHERE parent_id = ".$pid." AND item_id=".$item_id." ORDER BY id DESC LIMIT 100");
    foreach ($results as $row) {
        $map = $row;
        $map["created_at"] = timeToRelativeString($map["created_at"]);
        $user = $QtUsers->find(array("id"=>$map["user_id"]));
        $map["user"] = $user;
        $chic = $QtComments->findCount(array("parent_id"=>$pid));
        
        if ($chic>0) {
            $map['children'] = getCommentTree($map['id'],$item_id);
        }else{
            $map['children'] = [];
        }
        $tree[] = $map;
    }
    return $tree;
}
/**
 * 发放优惠券
 * @params int $addid 目标用户ID
 * @params string $coupon_code 优惠券代码
 * @params bool $isMul 同一个用户是否可以发放多张？true可以；false不可以
 * 
 * @return
*/
function sendCoupons($addid,$coupon_code,$isMul){
    $qt_discount_coupons = new QtDiscountCoupons();
    if($isMul == false){
        // 同一个用户只能获得一张优惠券
        $count = $qt_discount_coupons->findCount(array("coupon_code"=>$coupon_code,"user_id"=>$addid));
        if($count>0){
            return;
        }
    }
    $qdc = $qt_discount_coupons->find(array("coupon_code"=>$coupon_code));
    if($qdc != false){
        $qt_user_redeemed_coupons->create(array(
            "user_id"=>$addid,
            "coupon_code"=>$qdc["coupon_code"],
            "coupon_type"=>$qdc["coupon_type"],
            "amount"=>$qdc["discount_value"],
            "status"=>0,
            "exchange_time"=>time(),
            "expiration_date"=>$qdc["end_date"],
            "created_at"=>time(),
            "updated_at"=>time()
        ));
    }
}
/**
 * 发送站内消息
 * @params int $receiver_id 目标用户ID
 * @params string/array $content 站内信内容
 * @params int $sender_id 发送者ID，0代表系统，缺省 0
 * @params string $title 站内信标题，缺省“系统消息”
 * @params string $msgTpl 消息模板
 * 
 * @return
*/
function sendMessage($receiver_id, $content, $msgTpl='', $sender_id = 0, $title='系统消息'){
    $array_tpls = array(
        "coupon_send"=>array(
            "title"=>"您收到了一张优惠券",
            "content"=>"群推网为您发放了优惠券，快去查看使用吧，在 个人中心》红包卡券 中查看"
        ),
        "score_send"=>array(
            "title"=>"积分奖励",
            "content"=>"由于 :s1，您已获得 :s2 积分,发放到账"
        ),
    );
    if($msgTpl!= ''){
        $tpl = $array_tpls[$msgTpl];
        $title = $tpl["title"];
        foreach ($content as $key => $value) {
            $_content = str_replace(":s$key", $value, $tpl["content"]);
        }
    } else {
        $_content = $content;
    }
    $qt_site_messages = new QtSiteMessages();
    $qt_site_messages->create(array(
        "sender_id"=>$sender_id,
        "receiver_id"=>$receiver_id,
        "title"=>$title,
        "content"=>$_content,
        "status"=>0,
        "created_at"=>time(),
        "updated_at"=>time()
    ));
}
/**
 * 积分记录
 * @params int $user_id 目标用户ID
 * @params int $_score 积分值
 * @params string $des 描述
 * @params string $type 变动类型：earn，赚积分；spend，花积分；
 * 
 * @return
*/
function scoreRecodsLog($user_id,$_score,$des='',$type='earn'){
    $_score = str_replace("+","",$_score);
    $_score = str_replace("-","",$_score);
    $qt_points_log = new QtPointsLog();
    $qt_points_log->create(array(
        "user_id"=>$user_id,
        "points"=>$_score,
        "type"=>$type,
        "description"=>$des
    ));
}

?>