## 支付宝

## 电脑支付

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::NORMAL);
$aliConfig->setAppId('2017082000295641');
$aliConfig->setPublicKey('xxxxxxx');
$pay = new \EasySwoole\Pay\Pay();
$order = new \EasySwoole\Pay\AliPay\RequestBean\Web();
$order->setSubject('测试');
$order->setOutTradeNo(time().'123456');
$order->setTotalAmount('0.01');
$res = $pay->aliPay($aliConfig)->web($order);
var_dump($res->toArray());
$html = buildPayHtml(\EasySwoole\Pay\AliPay\GateWay::NORMAL,$res->toArray());
file_put_contents('test.html',$html);
```

