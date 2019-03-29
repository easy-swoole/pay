<?php

namespace App\HttpController;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Pay\Pay;
use EasySwoole\Pay\WeChat\Config;
use EasySwoole\Pay\WeChat\RequestBean\Biz;
use EasySwoole\Pay\WeChat\RequestBean\OfficialAccount;
use EasySwoole\Pay\WeChat\ResponseBean\NativeResponse;
use EasySwoole\Pay\WeChat\Utility;
use EasySwoole\Pay\WeChat\WeChatPay\MiniProgram;
use EasySwoole\Pay\WeChat\WeChatPay\Scan;
use EasySwoole\Spl\SplArray;
use Swoole\Buffer;


class Index extends Controller
{

    private $wechatConfig;

    public function onRequest(?string $action): bool
    {
        $wechatConfig = new Config();
        $wechatConfig->setAppId('');
        $wechatConfig->setMchId('');
        $wechatConfig->setKey('');
        $wechatConfig->setNotifyUrl('');
        $wechatConfig->setApiClientCert('');
        $wechatConfig->setApiClientKey('');
        $this->wechatConfig = $wechatConfig;
        return true;
    }

    /**
     * 公众号支付测试
     */
    function index()
    {
        $officialAccount = new OfficialAccount();
        $officialAccount->setOpenid('xxxxxx');
        $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
        echo "MP--- " . $outTradeNo . "\r\n";
        $officialAccount->setOutTradeNo($outTradeNo);
        $officialAccount->setBody('xxxxx-测试' . $outTradeNo);
        $officialAccount->setTotalFee(1);
        $officialAccount->setSpbillCreateIp($this->request()->getHeader('x-real-ip')[0]);
        $pay = new \EasySwoole\Pay\Pay();
        $params = $pay->weChat($this->wechatConfig)->officialAccount($officialAccount);
        $jsApiParameters = $params->toArray();
        $str = <<<EOF
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>微信支付样例-支付</title>
    <script type="text/javascript" charset="UTF-8" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        //调用微信JS api 支付
        function jsApiCall() {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                {'appId':'{$jsApiParameters['appId']}',
                'nonceStr':'{$jsApiParameters['nonceStr']}',
                'package':'{$jsApiParameters['package']}',
                'signType':'{$jsApiParameters['signType']}',
                'timeStamp':'{$jsApiParameters['timeStamp']}',
                'paySign':'{$jsApiParameters['paySign']}'},
                function (res) {
                    WeixinJSBridge.log(res.err_msg);
                    alert(res.err_code + res.err_desc + res.err_msg);
                }
            );
        }

        function callpay() {
            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            } else {
                jsApiCall();
            }
        }
    </script>
</head>
<body>
<br/>
<font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
<div align="center">
    <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()">立即支付
    </button>
</div>
</body>
</html>
EOF;
        $this->response()->write($str);
    }

    /**
     * 支付成功异步通知回调
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     * @throws \EasySwoole\Pay\Exceptions\InvalidSignException
     */
    function notify()
    {
        $content = $this->request()->getBody()->__toString();
        $pay = new Pay();
        $data = $pay->weChat($this->wechatConfig)->verify($content);
        $msg = "[" . date('Y-m-d H:i:s') . "]" . $data->__toString() . "\r\n";
        file_put_contents(dirname(dirname(__DIR__)) . '/Temp/notify-' . date('Y-m-d') . '.log', $msg, FILE_APPEND);
        $this->response()->write($pay->weChat($this->wechatConfig)->success());
    }

    /**
     * 退款成功异步通知回调
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     * @throws \EasySwoole\Pay\Exceptions\InvalidSignException
     */
    function refund_notify()
    {
        $content = $this->request()->getBody()->__toString();
        $pay = new Pay();
        $data = $pay->weChat($this->wechatConfig)->verify($content, true);
        $msg = "[" . date('Y-m-d H:i:s') . "]" . $data->__toString() . "\r\n";
        file_put_contents(dirname(dirname(__DIR__)) . '/Temp/refund_notify-' . date('Y-m-d') . '.log', $msg, FILE_APPEND);
        $this->response()->write($pay->weChat($this->wechatConfig)->success());
    }

    /**
     * H5支付
     */
    function wap()
    {
        $wap = new \EasySwoole\Pay\WeChat\RequestBean\Wap();
        $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
        echo "WAP--- " . $outTradeNo . "\r\n";
        $wap->setOutTradeNo($outTradeNo);
        $wap->setBody('xxxxx-WAP测试' . $outTradeNo);
        $wap->setTotalFee(1);
        $wap->setSpbillCreateIp($this->request()->getHeader('x-real-ip')[0]);
        $pay = new \EasySwoole\Pay\Pay();
        try {
            $params = $pay->weChat($this->wechatConfig)->wap($wap);
            $params = $params->toArray();
            $str = '<html>
<head></head>
<body>
<script>
    window.location.href="' . $params['mweb_url'] . '";
</script></body></body></html>';
            $this->response()->write($str);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    function miniProgram()
    {
        $this->response()->withHeader('content-type','application/json;charset=utf-8');
        $bean = new \EasySwoole\Pay\WeChat\RequestBean\MiniProgram();
        $bean->setOpenid('xxxxxxxxx');
        $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
        echo "MP--- " . $outTradeNo . "\r\n";
        $bean->setOutTradeNo($outTradeNo);
        $bean->setBody('xxxx-测试' . $outTradeNo);
        $bean->setTotalFee(1);
        $bean->setSpbillCreateIp($this->request()->getHeader('x-real-ip')[0]);
        $pay = new \EasySwoole\Pay\Pay();
        $params = $pay->weChat($this->wechatConfig)->miniProgram($bean);
        $this->response()->write($params->__toString());
    }


    /**
     * 扫码模式一 回调地址（公众号管理后台设置）
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     * @throws \EasySwoole\Pay\Exceptions\InvalidSignException
     */
    public function scan()
    {
        $xml = $this->request()->getBody()->__toString();
        $pay = new Pay();
        $data = $pay->weChat($this->wechatConfig)->verify($xml);
        $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
        echo "NATIVE--- " . $outTradeNo . "\r\n";
        $bean = new \EasySwoole\Pay\WeChat\RequestBean\Scan();
        $bean->setOutTradeNo($outTradeNo);
        $bean->setOpenid('xxxxx');
        $bean->setProductId($data['product_id']);
        $bean->setBody('xxxxxx-SCAN1测试' . $outTradeNo);
        $bean->setTotalFee(1);
        $bean->setSpbillCreateIp($this->request()->getHeader('x-real-ip')[0]);

        $response = $pay->weChat($this->wechatConfig)->scan($bean);
        $nativeResponse = new NativeResponse(['appid' => $this->wechatConfig->getAppId(),
            'mch_id' => $this->wechatConfig->getMchId(),
            'prepay_id' => $response->getPrepayId(),
            'nonce_str' => $response->getNonceStr()]);
        $u = new Utility($this->wechatConfig);
        $nativeResponse->setSign($u->generateSign($nativeResponse->toArray()));
        $xml = (new SplArray($nativeResponse->toArray()))->toXML();
        $this->response()->write($xml);
    }

    /**
     * 扫码支付
     */
    function scanindex()
    {
        $biz = new Biz();
        $biz->setProductId('123456789');
        $biz->setTimeStamp(time());
        $biz->setAppId($this->wechatConfig->getAppId());
        $biz->setMchId($this->wechatConfig->getMchid());
        $data = $biz->toArray();
        $u = new Utility($this->wechatConfig);
        $sign = $u->generateSign($data);
        $biz->setSign($sign);
        $url1 = "weixin://wxpay/bizpayurl?" . $this->ToUrlParams($biz->toArray());


        $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
        echo "WAP--- " . $outTradeNo . "\r\n";
        $bean = new \EasySwoole\Pay\WeChat\RequestBean\Scan();
        $bean->setOutTradeNo($outTradeNo);

        $bean->setProductId('123456789');
        $bean->setBody('xxxx-SCAN2测试' . $outTradeNo);
        $bean->setTotalFee(1);
        $bean->setSpbillCreateIp($this->request()->getHeader('x-real-ip')[0]);

        $pay = new Pay();
        $data = $pay->weChat($this->wechatConfig)->scan($bean);
        $url2 = $data->getCodeUrl();
        $str = '
        <html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>微信支付样例-扫码支付</title>
</head>
<body>
	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式一</div><br/>
	<img alt="模式一扫码支付" src="/index/qrcode?data=' . urlencode($url1) . '" style="width:150px;height:150px;"/>
	<br/><br/><br/>
	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式二</div><br/>
	<img alt="模式二扫码支付" src="/index/qrcode?data=' . urlencode($url2) . '" style="width:150px;height:150px;"/>
	<div style="color:#ff0000"><b>微信支付样例程序，仅做参考</b></div>
	
</body>
</html>
        ';
        $this->response()->write($str);
    }

    /**
     * 生成二维码
     */
    function qrcode()
    {
        require_once dirname(__DIR__) . '/phpqrcode/phpqrcode.php';
        $url = urldecode($this->request()->getQueryParam("data"));
        if (substr($url, 0, 6) == "weixin") {
            ob_start();
            \QRcode::png($url);
            $content = ob_get_contents();
            ob_end_clean();
            $this->response()->write($content);
        } else {
            $this->response()->withStatus(404);
        }
    }

    /**
     * 参数数组转换为url参数
     * @param $urlObj
     * @return string
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v) {
            $buff .= $k . "=" . $v . "&";
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    protected function onException(\Throwable $throwable): void
    {
        $this->response()->write($throwable->getMessage());
    }

}


$http = new \swoole_http_server("0.0.0.0", 9531);
$http->set(['worker_num' => 1]);

$service = new \EasySwoole\Http\WebService();
$service->setExceptionHandler(function (\Throwable $throwable, \EasySwoole\Http\Request $request, \EasySwoole\Http\Response $response) {
    $response->write('error:' . $throwable->getMessage());
});

$http->on("request", function ($request, $response) use ($service) {
    $req = new \EasySwoole\Http\Request($request);
    $service->onRequest($req, new \EasySwoole\Http\Response($response));
});

$http->start();
