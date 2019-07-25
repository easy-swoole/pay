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
// $params 就是前端需要的content内容
$params = $pay->weChat( $wechatConfig )->miniProgram( $bean );

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
// $params 就是前端需要的content内容
$params             = $pay->weChat( $wechatConfig )->app( $bean );
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
$result = http_build_query( $res->toArray() );
```

