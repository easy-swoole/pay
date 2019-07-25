### 微信小程序

```php
$config = [ 这个是你本地自己喜欢的命名方式 ];
$wechatConfig = new \EasySwoole\Pay\WeChat\Config();
$wechatConfig->setMiniAppId( $config['miniapp_id'] );
$wechatConfig->setMchId( $config['mch_id'] );
$wechatConfig->setKey( $config['key'] );
$wechatConfig->setNotifyUrl( $config['notify_url'] );

$bean = new \EasySwoole\Pay\WeChat\RequestBean\MiniProgram();
$bean->setOutTradeNo( "xxxxxxxxxxxxx" );
$bean->setBody( "xxxxxxxxxxxxxxxxxxx" );
$bean->setTotalFee( 100000 );
$bean->setAttach( "回调给的参数值" );

$pay    = new \EasySwoole\Pay\Pay();
// $params 就是前端需要的payResult内容
$params = $pay->weChat( $wechatConfig )->miniProgram( $bean );

```

#### 客户端

```js
 wx.requestPayment({
     'timeStamp': payResult.timeStamp,
     'nonceStr': payResult.nonceStr,
     'package': payResult.package,
     'signType': payResult.signType,
     'paySign': payResult.paySign,
     'success': function () {
         // 支付成功，一般是跳转到支付成功页面
     },
     'fail': function (res) {
         // 支付失败，一般是跳转到订单详情
     }
 })
```



### 微信App

```php
$config       = [ 这个是你本地自己喜欢的命名方式 ];
$wechatConfig = new \EasySwoole\Pay\WeChat\Config();
$wechatConfig->setAppId( $config['appid'] );
$wechatConfig->setMchId( $config['mch_id'] );
$wechatConfig->setKey( $config['key'] );
$wechatConfig->setNotifyUrl( $config['notify_url'] );

$bean = new \EasySwoole\Pay\WeChat\RequestBean\App();
$bean->setOutTradeNo( "xxxxxxxxxxxxx" );
$bean->setBody( "xxxxxxxxxxxxxxx" );
$bean->setTotalFee( 1000 );
$bean->setAttach( "回调给的参数值" );

$pay                = new \EasySwoole\Pay\Pay();
// $params 就是前端需要的payResult内容
$params             = $pay->weChat( $wechatConfig )->app( $bean );
```

#### 客户端

```js
// 安卓和IOS参数示例
const payOptions = {
    partnerId: payResult.partnerid,    // 商家向财付通申请的商家id
    prepayId: payResult.prepayid,    // 预支付订单
    nonceStr: payResult.noncestr,    // 随机串，防重发
    timeStamp: payResult.timestamp,    // 时间戳，防重发
    package: payResult.package,    // 商家根据财付通文档填写的数据和签名
    sign: payResult.sign,    // 商家根据微信开放平台文档对数据做的签名
}
// WeChat是你的SDK类，pay是支付方法
WeChat.pay(payOptions)
```



### 支付宝App

```php
$config       = [ 这个是你本地自己喜欢的命名方式 ];
$amount    = $pay_amount;
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay( \EasySwoole\Pay\AliPay\GateWay::NORMAL );
$aliConfig->setAppId( $config['app_id'] );
$aliConfig->setPublicKey( $config['alipay_public_key'] );
$aliConfig->setPrivateKey( $config['merchant_private_key'] );
$aliConfig->setNotifyUrl( $config['notify_url'] );

$order = new \EasySwoole\Pay\AliPay\RequestBean\App();
$order->setOutTradeNo( "xxxxxxxxxxxxx" );
$order->setTotalAmount( 10000 );
$order->setSubject( "xxxxxxxxxxxxx" );
$order->setPassbackParams("回调给的参数值" );
$pay                = new \EasySwoole\Pay\Pay();
$res                = $pay->aliPay( $aliConfig )->app( $order );
// 前端需要的支付信息
$payResult = http_build_query( $res->toArray() );
```

#### 客户端

```js
// 此处$payResult 是 http query格式的字符串数据
// Alipay是你的SDK类，pay是支付方法
Alipay.pay($payResult)
```

