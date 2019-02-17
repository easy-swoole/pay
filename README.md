# 支付宝

#### 支付方法

支付宝支付目前支持 7 种支付方法，对应的支付 method 如下：

| method   | 说明         | 参数    | 返回值   |
| -------- | ------------ | ------- | -------- |
| web      | 电脑支付     | Request | Response |
| wap      | 手机网站支付 | Request | Response |
| app      | APP 支付     | Request | Response |
| pos      | 刷卡支付     | Request | Response |
| scan     | 扫码支付     | Request | Response |
| transfer | 账户转账     | Request | Response |
| mini     | 小程序支付   | Request | Response |

## 电脑支付

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::NORMAL);
$aliConfig->setAppId('2017082000295641');
$aliConfig->setPublicKey('阿里公钥');
$aliConfig->setPrivateKey('阿里私钥');

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

#### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/270/alipay.trade.page.pay)，查看「请求参数」一栏。

生成支付的跳转html示例

```php
function buildPayHtml($endpoint, $payload)
{
    $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$endpoint."' method='POST'>";
    foreach ($payload as $key => $val) {
        $val = str_replace("'", '&apos;', $val);
        $sHtml .= "<input type='hidden' name='".$key."' value='".$val."'/>";
    }
    $sHtml .= "<input type='submit' value='ok' style='display:none;'></form>";
    $sHtml .= "<script>document.forms['alipaysubmit'].submit();</script>";
    return $sHtml;
}
```



##  手机支付

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::NORMAL);
$aliConfig->setAppId('2017082000295641');
$aliConfig->setPublicKey('阿里公钥');
$aliConfig->setPrivateKey('阿里私钥');

$pay = new \EasySwoole\Pay\Pay();

$order = new \EasySwoole\Pay\AliPay\RequestBean\Wap();
$order->setSubject('测试');
$order->setOutTradeNo(time().'123456');
$order->setTotalAmount('0.01');

$res = $pay->aliPay($aliConfig)->wap($order);
var_dump($res->toArray());

$html = buildPayHtml(\EasySwoole\Pay\AliPay\GateWay::NORMAL,$res->toArray());
file_put_contents('test.html',$html);
```

#### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/203/107090/)，查看「请求参数」一栏。



## APP支付

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
$aliConfig->setAppId('2016091800538339');
$aliConfig->setPublicKey('阿里公钥');
$aliConfig->setPrivateKey('阿里私钥');

$pay = new \EasySwoole\Pay\Pay();
$order = new \EasySwoole\Pay\AliPay\RequestBean\App();
$order->setSubject('测试');
$order->setOutTradeNo(time().'123456');
$order->setTotalAmount('0.01');
$aliPay = $pay->aliPay($aliConfig);

var_dump($aliPay->app($order)->toArray());
```

#### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/204/105465/)，查看「请求参数」一栏。



## 刷卡支付

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
$aliConfig->setAppId('2016091800538339');
$aliConfig->setPublicKey('阿里公钥');
$aliConfig->setPrivateKey('阿里私钥');
$pay = new \EasySwoole\Pay\Pay();
$order = new \EasySwoole\Pay\AliPay\RequestBean\Pos();
$order->setSubject('测试');
$order->setTotalAmount('0.01');
$order->setOutTradeNo(time());
$order->setAuthCode('289756915257123456');
$aliPay = $pay->aliPay($aliConfig);
$data = $aliPay->pos($order)->toArray();
var_dump($data);
```

#### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/api_1/alipay.trade.pay)，查看「请求参数」一栏。



## 扫码支付

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
$aliConfig->setAppId('2016091800538339');
$aliConfig->setPublicKey('阿里公钥');
$aliConfig->setPrivateKey('阿里私钥');

$pay = new \EasySwoole\Pay\Pay();

$order = new \EasySwoole\Pay\AliPay\RequestBean\Scan();
$order->setSubject('测试');
$order->setTotalAmount('0.01');
$order->setOutTradeNo(time());
$aliPay = $pay->aliPay($aliConfig);

$data = $aliPay->scan($order)->toArray();
var_dump($data);
```

#### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/api_1/alipay.trade.precreate)，查看「请求参数」一栏。



## 转账

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
$aliConfig->setAppId('2016091800538339');
$aliConfig->setPublicKey('阿里公钥');
$aliConfig->setPrivateKey('阿里私钥');

$pay = new \EasySwoole\Pay\Pay();

$order = new \EasySwoole\Pay\AliPay\RequestBean\Transfer();
$order->setSubject('测试');
$order->setTotalAmount('0.01');
$order->setPayeeType('ALIPAY_LOGONID');
$order->setPayeeAccount('hcihsn8174@sandbox.com');

$aliPay = $pay->aliPay($aliConfig);
$data = $aliPay->transfer($order)->toArray();
$aliPay->preQuest($data);
var_dump($data);
```

#### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/api_28/alipay.fund.trans.toaccount.transfer)，查看「请求参数」一栏。



## 小程序支付

```php
$aliConfig = new \EasySwoole\Pay\AliPay\Config();
$aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
$aliConfig->setAppId('2016091800538339');
$aliConfig->setPublicKey('阿里公钥');
$aliConfig->setPrivateKey('阿里私钥');

$pay = new \EasySwoole\Pay\Pay();

$order = new \EasySwoole\Pay\AliPay\RequestBean\MiniProgram();
$order->setSubject('测试');
$order->setOutTradeNo(time().'123456');
$order->setTotalAmount('0.01');
$order->setBuyerId('hcihsn8174@sandbox.com');

$aliPay = $pay->aliPay($aliConfig);
$data = $aliPay->miniProgram($order)->toArray();
var_dump($data);
```

#### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/api_1/alipay.trade.create/)，查看「请求参数」一栏。

小程序支付接入文档：<https://docs.alipay.com/mini/introduce/pay>。





## 订单查询

## 退款查询

## 转账查询



## 取消

## 关闭

## 对账单

## 验证服务器数据

## 服务器确认收到异步通知字符串获取



