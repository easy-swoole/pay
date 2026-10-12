# EasySwoole Pay

EasySwoole 支付组件，支持微信支付 API v3 和支付宝开放平台接口。

## 环境要求

- PHP 8.1+
- Swoole
- OpenSSL、JSON、BCMath、Mbstring 扩展
- 微信支付请求需要在 Swoole 协程中执行

## 安装

```bash
composer require easyswoole/pay="2.x"
```

## 微信支付 API v3

### 公钥模式配置

组件使用商户 API 私钥为请求签名，并使用微信支付公钥验证接口响应和支付回调。商户号和商户证书序列号会自动从 `apiclient_cert.pem` 中解析。

```php
<?php

use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Pay\Wechat;

$config = new WechatConfig();

// 商户 API 证书，可传文件路径或 PEM 内容。
$config->setMchApiClientCert('/path/to/apiclient_cert.pem');

// 商户 API 私钥，可传文件路径或 PEM 内容；请勿提交到代码仓库。
$config->setMchApiClientKey('/path/to/apiclient_key.pem');

// 微信支付公钥，可传文件路径或 PEM 内容。
$config->setWechatPayPublicKey('/path/to/pub_key.pem');

// 微信支付公钥 ID，可在微信支付商户平台的 API 安全页面获取。
$config->setWechatPayPublicKeyId('PUB_KEY_ID_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

// 公众号、小程序或移动应用的 AppID，必须与商户号完成绑定。
$config->setAppId('wx0000000000000000');

// APIv3 密钥，仅在解密支付通知等加密数据时需要。
$config->setEncryptKey('32位APIv3密钥');

$wechat = new Wechat($config);
```

> 安全提示：不要把 `apiclient_key.pem`、APIv3 密钥或其他生产凭据提交到 Git 仓库。推荐通过密钥管理服务或部署环境挂载文件。

### 公共下单参数

APP、JSAPI、H5 和 Native 下单请求都继承自同一个基础请求。金额单位为“分”，商户订单号在同一个商户号下必须唯一。

```php
$request->description = '商品描述';
$request->out_trade_no = 'ORDER_' . date('YmdHis');
$request->notify_url = 'https://pay.example.com/wechat/notify';
$request->amount->total = 1;
```

### APP 支付

```php
use EasySwoole\Pay\Request\Wechat\App;

$request = new App();
$request->description = 'APP 支付测试';
$request->out_trade_no = 'APP_' . date('YmdHis');
$request->notify_url = 'https://pay.example.com/wechat/notify';
$request->amount->total = 1;

$result = $wechat->app($request);

// 可直接用于微信 OpenSDK PayReq。
$result->appId;
$result->partnerId;
$result->prepayId;
$result->packageValue; // Android 固定值 Sign=WXPay
$result->package;      // iOS 固定值 Sign=WXPay
$result->nonceStr;
$result->timeStamp;
$result->sign;
```

APP 支付需要在微信开放平台申请移动应用 AppID、开通 APP 支付，并将 AppID 与商户号绑定。

### JSAPI／小程序支付

`openid` 必须属于配置的 AppID。

```php
use EasySwoole\Pay\Request\Wechat\JsApi;

$request = new JsApi();
$request->description = 'JSAPI 支付测试';
$request->out_trade_no = 'JSAPI_' . date('YmdHis');
$request->notify_url = 'https://pay.example.com/wechat/notify';
$request->amount->total = 1;
$request->payer->openid = '用户在当前 AppID 下的 openid';

$result = $wechat->jsApi($request);

// 可直接交给公众号或小程序前端调起支付。
$result->appId;
$result->timeStamp;
$result->nonceStr;
$result->package;
$result->signType;
$result->paySign;
```

### H5 支付

```php
use EasySwoole\Pay\Request\Wechat\H5;

$request = new H5();
$request->description = 'H5 支付测试';
$request->out_trade_no = 'H5_' . date('YmdHis');
$request->notify_url = 'https://pay.example.com/wechat/notify';
$request->amount->total = 1;
$request->scene_info->payer_client_ip = '用户真实公网 IP';
$request->scene_info->h5_info->type = 'Wap';
$request->scene_info->h5_info->app_url = 'https://pay.example.com/checkout';

$result = $wechat->h5($request);
$h5Url = $result->h5_url;
```

H5 支付必须从商户平台已配置的 H5 支付域名页面跳转到 `$h5Url`，不能直接复制链接访问，否则 Referer 为空会导致“商家参数格式有误”。`payer_client_ip` 必须是实际付款用户的公网 IP，且 H5 支付应在微信外部浏览器中调起。

### Native 支付

```php
use EasySwoole\Pay\Request\Wechat\Native;

$request = new Native();
$request->description = 'Native 支付测试';
$request->out_trade_no = 'NATIVE_' . date('YmdHis');
$request->notify_url = 'https://pay.example.com/wechat/notify';
$request->amount->total = 1;

$result = $wechat->native($request);
$codeUrl = $result->getCodeUrl(); // 将 code_url 生成二维码供用户扫码。
```

### 查询和关闭订单

```php
// 未支付订单只能通过商户订单号查询。
$order = $wechat->queryByOutTradeNo('商户订单号');
$tradeState = $order->trade_state; // NOTPAY、SUCCESS、CLOSED 等。

// 支付成功并获得微信支付订单号后，也可以这样查询。
$order = $wechat->query('微信支付订单号');

// 关闭未支付订单。
$closed = $wechat->close('商户订单号');
```

查询响应中的 `transaction_id`、`payer`、`amount`、`bank_type`、`success_time` 等字段可能因订单状态而不存在，使用前应判断是否为 `null`。

### 查询商户余额

```php
$balance = $wechat->balance('BASIC'); // BASIC、OPERATION 或 FEES。

$availableAmount = $balance->available_amount; // 可用余额，单位：分。
$pendingAmount = $balance->pending_amount;     // 不可用余额，单位：分。
```

余额查询接口仅对已开通对应产品权限的服务商或平台商户开放；普通直连商户调用可能返回 `NO_AUTH`。

### 支付回调验签与解密

```php
use EasySwoole\Pay\Request\Wechat\Callback;

// Header 名称是否区分大小写取决于所使用的 Web 框架，请按实际情况读取。
$callback = new Callback([
    'signature' => $headers['wechatpay-signature'],
    'timestamp' => (int)$headers['wechatpay-timestamp'],
    'nonce' => $headers['wechatpay-nonce'],
    'certSerial' => $headers['wechatpay-serial'],
    'body' => $rawBody,
]);

if (!$wechat->verify($callback)) {
    throw new RuntimeException('微信支付回调验签失败');
}

$payload = json_decode($rawBody, true);
$resource = $payload['resource'];
$plainText = $wechat->decrypt(
    $resource['ciphertext'],
    $resource['nonce'],
    $resource['associated_data'] ?? ''
);
```

普通 API 响应和回调中的 `Wechatpay-Serial` 都会与配置的微信支付公钥 ID 匹配，并使用微信支付公钥执行 RSA-SHA256 验签。

### 异常处理

```php
use EasySwoole\Pay\Exception\WechatApiError;

try {
    $result = $wechat->native($request);
} catch (WechatApiError $exception) {
    $apiCode = $exception->apiCode;
    $message = $exception->getMessage();
    $detail = $exception->detail;
}
```

### 协程中调用

```php
Swoole\Coroutine\run(function () use ($wechat, $request) {
    $result = $wechat->native($request);
});
```

## 支付宝

组件支持支付宝公钥模式和证书模式，包含 WAP、电脑网站、APP、当面付等支付能力，以及订单查询、关闭、退款、转账、资金查询、授权和直付通相关接口。具体可用方法请以 `EasySwoole\Pay\Alipay` 类为准。

### 配置

> 公钥模式和证书模式二选一。应用私钥、支付宝公钥均传入去掉 PEM 头尾和换行后的密钥正文；证书模式下的三个证书配置项传入证书文件内容。

公钥模式配置如下：

```php
<?php
use EasySwoole\Pay\Alipay;
use EasySwoole\Pay\Config\AlipayConfig;

$alipayConfig = new AlipayConfig();
$alipayConfig->setAppId('支付宝应用 APPID');
$alipayConfig->setAppPrivateKey('应用私钥正文');
$alipayConfig->setAlipayPublicKey('支付宝公钥字符串');
$alipayConfig->setNotifyUrl('https://example.com/alipay/notify');
$alipayConfig->setReturnUrl('https://example.com/pay/result');

$alipay = new Alipay($alipayConfig);
```

证书模式配置如下：

```php
<?php
use EasySwoole\Pay\Alipay;
use EasySwoole\Pay\Config\AlipayConfig;

$alipayConfig = new AlipayConfig();
$alipayConfig->setCertMode(true);
$alipayConfig->setAppId('支付宝应用 APPID');
$alipayConfig->setAppPrivateKey('应用私钥正文');
$alipayConfig->setAppPublicCert(file_get_contents(__DIR__ . '/appCertPublicKey.crt'));
$alipayConfig->setAlipayPublicCert(file_get_contents(__DIR__ . '/alipayCertPublicKey_RSA2.crt'));
$alipayConfig->setAlipayRootCert(file_get_contents(__DIR__ . '/alipayRootCert.crt'));
$alipayConfig->setNotifyUrl('https://example.com/alipay/notify');
$alipayConfig->setReturnUrl('https://example.com/pay/result');

$alipay = new Alipay($alipayConfig);
```

沙箱环境可额外设置：

```php
use EasySwoole\Pay\Beans\Alipay\Gateway;

$alipayConfig->setGateWay(Gateway::SANDBOX);
```

生产环境默认使用 `Gateway::PRODUCE`。密钥和证书不要提交到代码仓库，建议通过安全配置中心或仅服务进程可读的文件注入。

### WAP、电脑网站和 APP 支付

```php
<?php
use EasySwoole\Pay\Request\Alipay\App;
use EasySwoole\Pay\Request\Alipay\Wap;
use EasySwoole\Pay\Request\Alipay\Web;

$outTradeNo = 'PAY' . date('YmdHis');

$wap = new Wap();
$wap->out_trade_no = $outTradeNo;
$wap->total_amount = '0.01';
$wap->subject = '测试商品';
$wapUrl = $alipay->wap($wap); // 浏览器跳转地址

$web = new Web();
$web->out_trade_no = $outTradeNo;
$web->total_amount = '0.01';
$web->subject = '测试商品';
$webUrl = $alipay->web($web); // 电脑网站支付地址

$app = new App();
$app->out_trade_no = $outTradeNo;
$app->total_amount = '0.01';
$app->subject = '测试商品';
$appParams = $alipay->appPay($app); // 交给客户端 SDK 唤起支付宝
```

同一个商户订单号只能创建一笔订单。实际接入时请使用持久化且全局唯一的订单号，金额统一使用两位小数字符串。

### 单笔转账

支付宝官方文档接口地址：https://opendocs.alipay.com/open-v3/08e7ef12_alipay.fund.trans.uni.transfer?scene=ca56bca529e64125a2786703c6192d41&pathHash=d1ccfb8d

```php
<?php
$request                  = new \EasySwoole\Pay\Request\Alipay\TransferV3();
$request->out_biz_no      = '201806300001';
$request->trans_amount    = '23.00';
$request->order_title     = '201905代发';
$request->payee_info      = [
    'cert_type'     => 'IDENTITY_CARD',
    'cert_no'       => '1201152******72917',
    'identity'      => '2088123412341234',
    'name'          => '黄龙国际有限公司',
    'identity_type' => 'ALIPAY_USER_ID',
];
$request->remark          = '201905代发';
$request->business_params = '{"payer_show_name_use_alias":"true"}';

$result         = $alipay->transferV3($request);
$outBizNo       = $result->out_biz_no;       //商户订单号
$orderId        = $result->order_id;         //支付宝转账订单号
$payFundOrderId = $result->pay_fund_order_id;//支付宝支付资金流水号
$transDate      = $result->trans_date;       //订单支付时间
$status         = $result->status;//转账单据状态
```

### 用户授权换取授权令牌

支付宝官方文档接口地址：https://opendocs.alipay.com/open-v3/ba2f3ec8_alipay.system.oauth.token?scene=common&pathHash=d166c947

```php
<?php
//使用证书模式换取授权令牌
$alipayConfig = new AlipayConfig();
$alipayConfig->setCertMode(true);
$alipayConfig->setAppPrivateKey('应用私钥字符串(非JAVA语言)');
$alipayConfig->setAppPublicCert(file_get_contents(__DIR__ . '/appPublicCert.crt'));
$alipayConfig->setAlipayPublicCert(file_get_contents(__DIR__ . '/alipayPublicCert.crt'));
$alipayConfig->setAlipayRootCert(file_get_contents(__DIR__ . '/alipayRootCert.crt'));
$alipayConfig->setAppId('应用appid，如：9021000140620408');
$alipay = new \EasySwoole\Pay\Alipay($alipayConfig);

$request = new \EasySwoole\Pay\Request\Alipay\OAuthToken();
//$request->grant_type = 'authorization_code';
$request->code = '4b203fe6c11548bcabd8da5bb087a83b';
$result        = $alipay->authCode2token($request);
$accessToken   = $result->access_token;        //访问令牌
$expiresIn     = $result->expires_in;          //访问令牌的有效时间
$refreshToken  = $result->refresh_token;       //刷新令牌
$reExpiresIn   = $result->re_expires_in;       //刷新令牌的有效时间
$userId        = $result->user_id;             //支付宝用户的唯一标识
$openId        = $result->open_id;             //支付宝用户唯一标识
$oauthStart    = $result->auth_start;//授权token开始时间
```

### 支付宝会员授权信息查询

支付宝官方文档接口地址：https://opendocs.alipay.com/open-v3/b6702530_alipay.user.info.share?scene=common&pathHash=1be6d230

```php
<?php
$accessToken = '20120823ac6ffaa4d2d84e7384bf983531473993';
$result      = $alipay->authToken2UserInfo($accessToken);
```

### 订单查询、关闭和退款

查询、关闭时 `out_trade_no` 和 `trade_no` 二选一；退款时还需要传退款金额。

```php
<?php
use EasySwoole\Pay\Request\Alipay\TradeClose;
use EasySwoole\Pay\Request\Alipay\TradeQuery;
use EasySwoole\Pay\Request\Alipay\TradeRefund;

$query = new TradeQuery();
$query->out_trade_no = '商户订单号';
$trade = $alipay->tradeQuery($query);

$close = new TradeClose();
$close->out_trade_no = '商户订单号';
$closed = $alipay->tradeClose($close);

$refund = new TradeRefund();
$refund->out_trade_no = '商户订单号';
$refund->refund_amount = '0.01';
$refund->out_request_no = 'REFUND' . date('YmdHis');
$refunded = $alipay->tradeRefund($refund);
```

### 异步通知验签

必须先验签再更新订单状态，并校验通知中的 `app_id`、`out_trade_no`、`total_amount` 和业务状态。业务处理成功后向支付宝原样输出 `success`，失败输出 `failure`。

```php
<?php
use EasySwoole\Pay\Alipay;

if ($alipay->verifyResponse($_POST)) {
    // 根据 out_trade_no 幂等更新本地订单
    echo Alipay::success();
} else {
    echo Alipay::fail();
}
```

### 异常处理

```php
<?php
use EasySwoole\Pay\Exception\AlipayApiError;
use Throwable;

try {
    $result = $alipay->tradeQuery($query);
} catch (AlipayApiError $e) {
    // 支付宝返回的业务错误，可读取 apiCode、apiMsg、apiSubCode
    throw $e;
} catch (Throwable $e) {
    // 网络、配置、签名或其他运行时错误
    throw $e;
}
```

除生成支付参数或跳转地址外，发起远程请求的接口需要在 Swoole 协程环境中调用。

### 直付通发起支付

以下示例默认已引入对应请求类，并已按前文创建 `$alipay` 实例。

```php
$req = new Wap();
$req->subject = '测试商品';
$req->total_amount = '1.00';
$req->out_trade_no = 'xxxxxxxxx';
$req->settle_info = new SubMerchantSettleInfo();
$req->settle_info->settle_period_time = '1d';

$req->sub_merchant = new SubMerchant();
$req->sub_merchant->merchant_id = 'SMID';

$settleDetailInfo = new SubMerchantSettleDetailInfo();
$settleDetailInfo->trans_in_type =  'defaultSettle';

//    $settleDetailInfo->trans_in_type =  'userId';
//    $settleDetailInfo->trans_in = 'USERID';
//OR
//    $settleDetailInfo->trans_in_type =  'loginName';
//    $settleDetailInfo->trans_in = 'xxxxx@qq.com';

$settleDetailInfo->amount = 1.00;

$req->settle_info->settle_detail_infos = [$settleDetailInfo->toArray()];

$url = $alipay->wap($req);
```

### 直付通确认结算

```php
$req = new OrderSettle();
$req->out_request_no = time();
$req->trade_no = 'xxxxxx';

$settleDetailInfo = new SubMerchantSettleDetailInfo();

$settleDetailInfo->trans_in_type =  'defaultSettle';
//    $settleDetailInfo->trans_in = 'xxxxx@qq.com';

$settleDetailInfo->amount = 1;
$req->settle_info = new SubMerchantSettleInfo();
$req->settle_info->settle_period_time =  '1d';
$req->settle_info->settle_detail_infos = [$settleDetailInfo->toArray()];

$ret = $alipay->subMerchantSettleConfirm($req);
//    var_dump($ret);
```

### 直付通分账(服务商抽佣)

```php
$req = new OrderSettle();
$req->out_request_no = time();
$req->trade_no = 'xxxxxxx';

$s = new OpenApiRoyaltyDetailInfoPojo();
$s->royalty_type = 'transfer';
$s->trans_in_type = 'loginName';
$s->trans_in = 'xxxxxxx@qq.com';
$s->amount = 0.2;

$req->royalty_parameters = [$s->toArray()];
$ret = $alipay->orderSettle($req);
var_dump($ret);
```
