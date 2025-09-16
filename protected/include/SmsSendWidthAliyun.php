<?php

$path = __DIR__ . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php';
if (file_exists($path)) {
    require_once $path;
}

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
//use \Exception;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Utils\Utils;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;

class SmsSendWidthAliyun {

    /**
     * 使用AK&SK初始化账号Client
     * @return Dysmsapi Client
     */
    public static function createClient(){
        // 工程代码泄露可能会导致 AccessKey 泄露，并威胁账号下所有资源的安全性。以下代码示例仅供参考。
        // 建议使用更安全的 STS 方式，更多鉴权访问方式请参见：https://help.aliyun.com/document_detail/311677.html。
        $config = new Config([
            // 必填，请确保代码运行环境设置了环境变量 ALIBABA_CLOUD_ACCESS_KEY_ID。
            "accessKeyId" => "LTAI5tPspdqpjjUZJ96qkiBk",
            // 必填，请确保代码运行环境设置了环境变量 ALIBABA_CLOUD_ACCESS_KEY_SECRET。
            "accessKeySecret" => "2z8ejW7N62cRfGuTY4cKZSPS34Rnhr"
        ]);
        // Endpoint 请参考 https://api.aliyun.com/product/Dysmsapi
        $config->endpoint = "dysmsapi.aliyuncs.com";
        return new Dysmsapi($config);
    }

    /**
     * @param string[] $args
     * @return void
     */
    public static function send($phone,$code){        
        $client = self::createClient();
        $sendSmsRequest = new SendSmsRequest([
            "phoneNumbers" => $phone,
            "signName" => "不死鸟空间",
            "templateCode" => "SMS_302135543",
            "templateParam" => "{\"code\":\"".$code."\"}"
        ]);
        $runtime = new RuntimeOptions([]);
        try {
            // 复制代码运行请自行打印 API 的返回值
            $client->sendSmsWithOptions($sendSmsRequest, $runtime);
        }
        catch (Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }
            // 此处仅做打印展示，请谨慎对待异常处理，在工程项目中切勿直接忽略异常。
            // 错误 message
            var_dump($error->message);
            // 诊断地址
            var_dump($error->data["Recommend"]);
            Utils::assertAsString($error->message);
        }
    }
}