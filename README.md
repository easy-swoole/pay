# pay

## 安装

```bash
composer require easyswoole/pay="2.x"
```

## 支付宝(v3)

支付宝v3版本目前支持 [单笔转账](https://opendocs.alipay.com/open-v3/08e7ef12_alipay.fund.trans.uni.transfer)、[用户授权换取授权令牌](https://opendocs.alipay.com/open-v3/ba2f3ec8_alipay.system.oauth.token?scene=common&pathHash=d166c947)、[支付宝会员授权信息查询](https://opendocs.alipay.com/open-v3/b6702530_alipay.user.info.share?scene=common&pathHash=1be6d230)
3个接口。

### 配置

> 组件支持支付宝支付两种签名方式（公钥模式、证书模式）

公钥模式配置如下：

```php
<?php
//公钥模式
$alipayConfig = new AlipayConfig();
$alipayConfig->setAppPublicCert('应用公钥证书字符串');
$alipayConfig->setAppPrivateKey('应用私钥字符串(非JAVA语言)');
$alipayConfig->setAlipayPublicKey('支付宝公钥字符串');
$alipayConfig->setAppId('应用appid，如：9021000140620408');
$alipay = new \EasySwoole\Pay\Alipay($alipayConfig);
```

证书模式配置如下：

```php
<?php
//证书模式
$alipayConfig = new AlipayConfig();
$alipayConfig->setCertMode(true);
$alipayConfig->setAppPrivateKey('应用私钥字符串(非JAVA语言)');
$alipayConfig->setAppPublicCert('应用公钥证书绝对路径');
//如：$alipayConfig->setAppPublicCert(file_get_contents(__DIR__ . '/appPublicCert.crt'));
$alipayConfig->setAlipayPublicCert('支付宝公钥证书绝对路径');
//如：$alipayConfig->setAlipayPublicCert(file_get_contents(__DIR__ . '/alipayPublicCert.crt'));
$alipayConfig->setAlipayRootCert('支付宝根证书绝对路径');
//如：$alipayConfig->setAlipayRootCert(file_get_contents(__DIR__ . '/alipayRootCert.crt'));
$alipayConfig->setAppId('应用appid，如：9021000140620408');
$alipay = new \EasySwoole\Pay\Alipay($alipayConfig);
```

### 单笔转账

支付宝官方文档接口地址：https://opendocs.alipay.com/open-v3/08e7ef12_alipay.fund.trans.uni.transfer?scene=ca56bca529e64125a2786703c6192d41&pathHash=d1ccfb8d

```php
<?php
//使用公钥模式进行转账
$alipayConfig = new AlipayConfig();
$alipayConfig->setAppPublicCert('应用公钥证书字符串');
$alipayConfig->setAppPrivateKey('应用私钥字符串(非JAVA语言)');
$alipayConfig->setAlipayPublicKey('支付宝公钥字符串');
$alipayConfig->setAppId('应用appid，如：9021000140620408');
$alipay = new \EasySwoole\Pay\Alipay($alipayConfig);

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

$result         = $alipay->transfer($request);
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
$result        = $alipay->token($request);
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
//使用公钥模式查询会员授权信息
$alipayConfig = new AlipayConfig();
$alipayConfig->setAppPublicCert('应用公钥证书字符串');
$alipayConfig->setAppPrivateKey('应用私钥字符串(非JAVA语言)');
$alipayConfig->setAlipayPublicKey('支付宝公钥字符串');
$alipayConfig->setAppId('应用appid，如：9021000140620408');
$alipay = new \EasySwoole\Pay\Alipay($alipayConfig);

$accessToken = '20120823ac6ffaa4d2d84e7384bf983531473993';
$result      = $alipay->userInfo($accessToken);
```
