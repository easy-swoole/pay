<?php

namespace EasySwoole\Pay\Tests;

use EasySwoole\Spl\SplArray;
use PHPUnit\Framework\TestCase;

class AliPayTest extends TestCase
{
    public function testWeb()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Web();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->web($order);
        $html = $this->buildPayHtml(\EasySwoole\Pay\AliPay\GateWay::SANDBOX, $res->toArray());
        $this->assertTrue(true);
        file_put_contents('test.html', $html);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Web();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->web($order);
        $html = $this->buildPayHtml(\EasySwoole\Pay\AliPay\GateWay::SANDBOX, $res->toArray());
        $this->assertTrue(true);
        file_put_contents('test.html', $html);
    }

    public function testWap()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Wap();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->wap($order);
        $this->assertTrue(true);
        $html = $this->buildPayHtml(\EasySwoole\Pay\AliPay\GateWay::SANDBOX, $res->toArray());
        file_put_contents('test.html', $html);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Wap();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->wap($order);
        $this->assertTrue(true);
        $html = $this->buildPayHtml(\EasySwoole\Pay\AliPay\GateWay::SANDBOX, $res->toArray());
        file_put_contents('test.html', $html);
    }

    public function testApp()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\App();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->app($order);
        $this->assertTrue(true);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\App();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->app($order);
        $this->assertTrue(true);
    }

    public function testBarCode()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\BarCode();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->barCode($order);
        $this->assertTrue(true);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\BarCode();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->barCode($order);
        $this->assertTrue(true);
    }

    public function testClose()
    {
        // 需要创建订单后,用户主动登录下,才可以.
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $close = new \EasySwoole\Pay\AliPay\RequestBean\Close();
        $close->setOutTradeNo('1610092749123456');
        $data = $pay->aliPay($aliConfig)->close($close)->toArray();
        $this->assertTrue(true);
//        $this->assertInstanceOf(SplArray::class, $pay->aliPay($aliConfig)->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $close = new \EasySwoole\Pay\AliPay\RequestBean\Close();
        $close->setOutTradeNo('xxxxx');
        $data = $pay->aliPay($aliConfig)->close($close)->toArray();
        $this->assertTrue(true);
//        $this->assertInstanceOf(SplArray::class, $pay->aliPay($aliConfig)->preQuest($data));
    }

    public function testCancel()
    {
        $aliConfig = $this->buildPublicConfig();

        $pay = new \EasySwoole\Pay\Pay();

        $outTradeNo = time() . '123456';
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Web();
        $order->setSubject('测试');
        $order->setOutTradeNo($outTradeNo);
        $order->setTotalAmount('0.01');
        $pay->aliPay($aliConfig)->web($order);

        $order = new \EasySwoole\Pay\AliPay\RequestBean\Cancel();
        $order->setOutTradeNo($outTradeNo);
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->cancel($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));

        $aliConfig = $this->buildCertConfig();

        $pay = new \EasySwoole\Pay\Pay();

        $outTradeNo = time() . '123456';
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Web();
        $order->setSubject('测试');
        $order->setOutTradeNo($outTradeNo);
        $order->setTotalAmount('0.01');
        $pay->aliPay($aliConfig)->web($order);

        $order = new \EasySwoole\Pay\AliPay\RequestBean\Cancel();
        $order->setOutTradeNo($outTradeNo);
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->cancel($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));
    }

    public function testDownload()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Download();
        $order->setBillType('trade');
        $order->setBillDate('2016-04-05');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->download($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Download();
        $order->setBillType('trade');
        $order->setBillDate('2016-04-05');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->download($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));
    }

    public function testMini()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\MiniProgram();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $order->setBuyerId('2088622955313420');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->miniProgram($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\MiniProgram();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $order->setBuyerId('2088622955313420');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->miniProgram($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));
    }

    public function testOrderFind()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();

        $outTradeNo = time() . '123456';
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Web();
        $order->setSubject('测试');
        $order->setOutTradeNo($outTradeNo);
        $order->setTotalAmount('0.01');
        $pay->aliPay($aliConfig)->web($order);

        $order = new \EasySwoole\Pay\AliPay\RequestBean\OrderFind();
        $order->setOutTradeNo('1610090038123456');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->orderFind($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();

        $outTradeNo = time() . '123456';
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Web();
        $order->setSubject('测试');
        $order->setOutTradeNo($outTradeNo);
        $order->setTotalAmount('0.01');
        $pay->aliPay($aliConfig)->web($order);

        $order = new \EasySwoole\Pay\AliPay\RequestBean\OrderFind();
        $order->setOutTradeNo('1610101704123456');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->orderFind($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));
    }

    public function testPos()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Pos();
        $order->setSubject('测试');
        $order->setTotalAmount('0.01');
        $order->setOutTradeNo(time());
        $order->setAuthCode('289756915257123456');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->pos($order)->toArray();
        $this->assertTrue(true);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Pos();
        $order->setSubject('测试');
        $order->setTotalAmount('0.01');
        $order->setOutTradeNo(time());
        $order->setAuthCode('2088102176327698');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->pos($order)->toArray();
        $this->assertTrue(true);
    }

    public function testRefund()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Refund();
        $order->setSubject('测试');
        $order->setOutTradeNo('1610090038123456');
        $order->setRefundAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refund($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);


        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Refund();
        $order->setSubject('测试');
        $order->setOutTradeNo('1610101704123456');
        $order->setRefundAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refund($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);
    }

    public function testRefundFind()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\RefundFind();
        $order->setOutTradeNo('1610090038123456');
        $order->setOutRequestNo('2021010822001427690501456342');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refundFind($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\RefundFind();
        $order->setOutTradeNo('1610101704123456');
        $order->setOutRequestNo('2021010822001413421000127136');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refundFind($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);
    }

    public function testScan()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Scan();
        $order->setSubject('测试');
        $order->setTotalAmount('0.01');
        $order->setOutTradeNo(time());
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->scan($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Scan();
        $order->setSubject('测试');
        $order->setTotalAmount('0.01');
        $order->setOutTradeNo(time());
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->scan($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);
    }

    public function testTransfer()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Transfer();
        $order->setOutBizNo(time());
        $order->setSubject('测试');
        $order->setAmount('0.01');
        $order->setPayeeType('ALIPAY_USERID');
        $order->setPayeeAccount('2088622955313420');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->transfer($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Transfer();
        $order->setOutBizNo(time());
        $order->setSubject('测试');
        $order->setAmount('0.01');
        $order->setPayeeType('ALIPAY_USERID');
        $order->setPayeeAccount('2088102176327698');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->transfer($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);
    }

    public function testTransferFind()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\TransferFind();
        $order->setOutBizNo(1610090960);
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->transferFind($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);

        $aliConfig = $this->buildCertConfig();
        $pay = new \EasySwoole\Pay\Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\TransferFind();
        $order->setOutBizNo(1610102051);
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->transferFind($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);
    }

    protected function buildPayHtml($endpoint, $payload)
    {
        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='" . $endpoint . "' method='POST'>";
        foreach ($payload as $key => $val) {
            $val = str_replace("'", '&apos;', $val);
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }
        $sHtml .= "<input type='submit' value='ok' style='display:none;'></form>";
        $sHtml .= "<script>document.forms['alipaysubmit'].submit();</script>";
        return $sHtml;
    }

    protected function buildPublicConfig()
    {
        $aliConfig = new \EasySwoole\Pay\AliPay\Config();
        $aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
        $aliConfig->setAppId('2021000116693476');
        $aliConfig->setPublicKey('MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0NYJRzZIBGLkes/Py1Rop8vDZtW0vDO5+MGb/KduwYYa4e3yyvCfnE/9RgWHWpyCjuACEmXEvpKpSyWy1PE8uGkz3nvrps/aoSpXn3G6q9r6MoxFMi57g+76rRBgZpJWUdENja704B0fN0Bw12SYdx0L2kOUYI3HScxUclN9uoCJkwdgcsCHdfpnx3JeMicxmklsVFAMjBPR3wibDqtpPExlvRe5PFz41oKy7hU2J32X7YVzd0ETfYj4kUwjwFvBB5wH9XjBxlTwWSwcSjtp5BY0alQvafPeZuta+sixT/N7h7xUkqmq/ruoiZkVVj2enBmrSUwGmtqKt+6KbOcITwIDAQAB');
        $aliConfig->setPrivateKey('MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCKQMP98LHWw9W6YqbNyT0xiHMrb42jEjmDD1NyqpG1rhB+Rl38YNm+AHwoVnYGzdAzsWwKdpVZD5AhgRNQ1fKhPn3kbfh/bLzrlhiyiqli3RK5u9hkobNAgEJxxjQzLoOMJCiOTZjuPeqLm/j48Ld8o+DwuRxrDXiBlxOVICMp1SNS4MX4OtoqFmlTxVTaYaLRNnc6UZHbw259HS46mYaDWOFPTM81fs4KyAKuOJCldTysHue5dUjIpB4NprtuAGHHVc+WV4AK5SYsqC+rtdbGj0NqjvBkBfouMgi2e8QlXIJJfEC91vp1It13v8WglJyule4Xhkta443vXuuo13e/AgMBAAECggEAWuGSNPcpYH1hnOFGt1YHNO12j+IH4F+VkNLdTy5TFHP1AZ0uIT5lRGI7O6UCdxyKNcD2vbYQHPh/DZc05FmP4nEa/rNPvCv10IPdflhqWsPqkE+sQxKMq+TkSLg7Dj4QWWpXgpv94PawnM+ODc7nPzbXIkb9KF41jjKKu+fhVZiABK7bESm2UkY7h9liF1rRQQLLYS4GoipE+5KO7H/Z0HhKnMHKFPOF/hxk4zPXQkHwjN1ng6w4gkgbQjCiZwm2LUGgBk8a+za6OicU2J6tKFZS/AaQU+wo4hV4+jaGoissMecdpLDkKyv1HVNrP8Ye6VJJHjma7kz6l0p06XsyMQKBgQC9ZSeElxmCIuFJkMj/ar8DyUHOn8mlbzfVuRs59uIOK0He0TeCfNu6pkxzYzCjHiyadIxBVdpmmQyjm97wl/1ZSemrfkgnjUbqC5QjTkdoKIMMzzImuoyuvXWuMqz3HBuloj7yVoxVm9EjyMIyQh1S2U2b+iF3DpiRFrlWZ/VDRwKBgQC632Q/FGMG8I7iMvHpSzcoOlD8132UQEgfAMa5b3ohwcv2yTEA7cZ9/laXvU8Q9jabGvYCQaoJCiI+2PB2vJQBjK1u6e9hXdisuv/vAwWuwif60D1bWjBWGvfvxPTF6cQsLzulJnbCp7NIwqyXNOKyf4KfuuPc3IZbmDVR6m2zyQKBgDnbELtcPRqX9SI37G65+Sf67vNjtIGo+/F53mtSk7OoWzLpzn86DRVzf58wCceKjC2StNWwmEsHLek80FnG1EnWXl9Y8EnEyojsiJBQdVfIKGBdWwChtCAdGDnimRvTpk5uxbPZ5HyyYK0BwvD/aV3Jq/+d5WMtPkX0HyHaF/45AoGAR52tMW+Cs/olCBM2Go40yTnwJ7X97n7kJN2LSy2pxJ4cqKtaGF0HoOmEDgsC7iEttCuU9DBuFaDIlwVUwmxq3F0pakRE9S+eBjR0OQkTeHH4GGsN2KCrvZQASOdWVzLLd5NybExdXyQd1VimBBzEdFvhl41sHgx1gUzHwmjxOeECgYEAl1Y+AJbKgDtpUoZXss9/cauPLfGq0i5p/RqKCpGcrggbEWrUvadM+WGBZNehxXm9N1o2eUOJxoQJr4y+I/Inf2GAXg327s7d6wjjLqrtZFbeE6av+DvU/JjV9PgINaIaRNoHe4bhHSqiAS/wnSK/UInvKhemAqQnzFKX8zGcizE=');
        return $aliConfig;
    }

    protected function buildCertConfig()
    {
        $aliConfig = new \EasySwoole\Pay\AliPay\Config();
        $aliConfig->setCertMode(true);
        $aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
        $aliConfig->setAppId('2016091800538780');
        $aliConfig->setPrivateKey('MIIEuwIBADANBgkqhkiG9w0BAQEFAASCBKUwggShAgEAAoIBAQCkrsvF56q/wNDC3brY7Sa5pIN/Pw8hUw7gpQVh2Z/V4fG/BHixqYntrFu+EnGsZJanAKCNCIwA2+zu0oMxQ1QsPHG1Jhhs1ADaIFIYamrejOzuvnUrXxjows3uKaOKesVs1dau504kuZximHnc6tQZ3p7esNCIY//2MGaqHRtieojSmFXdaPrH0PLYyQMx1zYCt65UMkNJ24QuBD48tgnMGrk3FYygRbQFtoREhH06DM83ZdgkG7yBPntvOoxzLKsK9GcT0ICQUCPM9qQzMe9A9On5YMnXJ/u1J3SQ0s5xSF7P2RoM1WRa7yoVyW/D+txJzzEXaycBjYtec3ddouXhAgMBAAECggEAR5AJzutYINGqJjPyYRfVDzD1T5NYgNO2EFrFlvrZ4Ti5M5e+1v1kiZqvl04uhYqEiPfVzNOc+zaWpEVoazzl0/9ELkLqtEgAQsluw1tjK2i0AR9UjU9a5LLaiBciESg+qIfYLdMn+v+JfLLjqeOF3eQGx6CwTcSe0x2/T0cswkLoeALFVjtKAgrwfBCOf3QBlX0o76HJW+3hVAlj8sZr6s2rJF77sb+jDu1ZM7wSMhp9MNjPxFNnjvO1wahhsu1J/I5PvGIjAmUTZCmkgPMc2WzpXjgE6Ymu6KED8KWNz5SMqZ6pHOnFOIW0X0pnRMRQTtlUcCGfOPMne86Y+CszAQKBgQDZkTDRoS+69jfmAJMfK604YVPCojJOZ2U+9oAi+EmgbPBKT37rY0KlGMAcobz5OKih78rwm8zuywNOkwHe0AQd1fP0vlwE3+yBah8JjIRbq6Wi/j5SrtOfxwmeQ/Yp02q76UvnDxZlOYu0RdpEfqd9l2DtMziHdlPSVxGc9xKC0QKBgQDBxhJw1jgK5/H3JRf/OZYFa2Us4tAif21Z1F54KLBYSA79c/8nfh3rXmarFIZT1NXVB+iQhqJik6ggIN6ojkSUj75rUOqrBU7qmitwc3YyU1dJ1FD5SZVx7HH83c5tXA2wlJhgANt7VsHh5+2ZkwNW5umHpZ2ADMpqhMCQZ5ZWEQKBgFXIWWdOFnOxAPk+4MM5hWLlfREQwqUHP3RD3OHs45rNWTDzhydoS66sw5KGcuwQ2ux+j5Wu2G6OvQ8OB37CpdzdrwKgy8dgQvAD15j8PnOmifhqJkiThf1JjRFJ2pVDNqJAqhzAZiQjPGIn6Jd5GLD8LstXlsJSdVpJ2jf5cuMBAoGBAIAhwb/rZ1OO3GlYle2m3pTm1xg/QvIM4Pote+povXMi8waV1Xr/4jjpS2qFP+3fJyae/CHVZTtZ+CqGkbVTnfW+t2OvNf2wnOZ025SYROgyQ94GDyVIixGyEA3tfbrCzCqfl8Kjzn5YeAwxmOOcWvDz8ChKU0OBMbgN4Gecl8SBAn8gDTQYvevciQzRlu5DaH5oBHi1b1u1UaknTY2Vlnd0wIhDvaHDAFq8i16RHMj12G01BvxKWbdVuI6ze0oct9hweK/9WAIPLVEqH0dXGxcg6pFz7NCeH59MBLTUVb/GMX0W6hWZiz85pmsfV3FF1VVOQaVlHvRG75Q2UHCDeVvT');
        $aliConfig->setCertPath(__DIR__ . '/cert/alipayCertPublicKey_RSA2.crt');
        $aliConfig->setRootCertPath(__DIR__ . '/cert/alipayRootCert.crt');
        $aliConfig->setMerchantCertPath(__DIR__ . '/cert/appCertPublicKey_2016091800538780.crt');
        return $aliConfig;
    }
}