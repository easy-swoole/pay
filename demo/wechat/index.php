<?php

namespace App\HttpController;

require_once dirname(__DIR__) . '/vendor/autoload.php';

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Pay\Pay;
use EasySwoole\Pay\WeChat\Config;
use EasySwoole\Pay\WeChat\RequestBean\OfficialAccount;


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
        $wechatConfig->setCertClient('');
        $wechatConfig->setCertKey('');
        $this->wechatConfig = $wechatConfig;
        return true;
    }

    /**
     * 公众号测试
     */
    function index()
    {
        $officialAccount = new OfficialAccount();
        $officialAccount->setOpenid('xxxxx');
        $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
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
        file_put_contents(dirname(__DIR__) . '/Temp/notify-' . date('Y-m-d') . '.log', $msg, FILE_APPEND);
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
        file_put_contents(dirname(__DIR__) . '/Temp/refund_notify-' . date('Y-m-d') . '.log', $msg, FILE_APPEND);
        $this->response()->write($pay->weChat($this->wechatConfig)->success());
    }

    /**
     * 网页支付
     */
    function wap()
    {
        $wap = new \EasySwoole\Pay\WeChat\RequestBean\Wap();
        $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
        $wap->setOutTradeNo($outTradeNo);
        $wap->setBody('xxxxx-WAP测试' . $outTradeNo);
        $wap->setTotalFee(1);
        $wap->setSpbillCreateIp($this->request()->getHeader('x-real-ip')[0]);
        $pay = new \EasySwoole\Pay\Pay();
        try {
            $params = $pay->weChat($this->wechatConfig)->Wap($wap);
            $params=$params->toArray();
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
