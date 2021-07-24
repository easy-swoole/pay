<?php

namespace EasySwoole\Pay\Tests;

use EasySwoole\Pay\AliPay\Config;
use EasySwoole\Pay\AliPay\GateWay;
use EasySwoole\Pay\AliPay\RequestBean\App;
use EasySwoole\Pay\AliPay\RequestBean\BarCode;
use EasySwoole\Pay\AliPay\RequestBean\Web;
use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Pay;
use EasySwoole\Spl\SplArray;
use PHPUnit\Framework\TestCase;

class AliPayTest extends TestCase
{
    public function testWeb()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new Pay();
        $order = new Web();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->web($order);
        $html = $this->buildPayHtml(GateWay::SANDBOX, $res->toArray());
        $this->assertTrue(true);
        file_put_contents('test.html', $html);

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new Web();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->web($order);
        $html = $this->buildPayHtml(GateWay::SANDBOX, $res->toArray());
        $this->assertTrue(true);
        file_put_contents('test.html', $html);
    }

    public function testWap()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Wap();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->wap($order);
        $this->assertTrue(true);
        $html = $this->buildPayHtml(GateWay::SANDBOX, $res->toArray());
        file_put_contents('test.html', $html);

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Wap();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $res = $pay->aliPay($aliConfig)->wap($order);
        $this->assertTrue(true);
        $html = $this->buildPayHtml(GateWay::SANDBOX, $res->toArray());
        file_put_contents('test.html', $html);
    }

    public function testApp()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new Pay();
        $order = new App();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->app($order);
        $this->assertTrue(true);

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new App();
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
        $pay = new Pay();
        $order = new BarCode();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->barCode($order);
        $this->assertTrue(true);

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new BarCode();
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
        $pay = new Pay();
        $close = new \EasySwoole\Pay\AliPay\RequestBean\Close();
        $close->setOutTradeNo('1610092749123456');
        $data = $pay->aliPay($aliConfig)->close($close)->toArray();
        $this->assertTrue(true);
//        $this->assertInstanceOf(SplArray::class, $pay->aliPay($aliConfig)->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $close = new \EasySwoole\Pay\AliPay\RequestBean\Close();
        $close->setOutTradeNo('xxxxx');
        $data = $pay->aliPay($aliConfig)->close($close)->toArray();
        $this->assertTrue(true);
//        $this->assertInstanceOf(SplArray::class, $pay->aliPay($aliConfig)->preQuest($data));
    }

    public function testCancel()
    {
        $aliConfig = $this->buildPublicConfig();

        $pay = new Pay();

        $outTradeNo = time() . '123456';
        $order = new Web();
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

        $pay = new Pay();

        $outTradeNo = time() . '123456';
        $order = new Web();
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
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Download();
        $order->setBillType('trade');
        $order->setBillDate('2016-04-05');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->download($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
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
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\MiniProgram();
        $order->setSubject('测试');
        $order->setOutTradeNo(time() . '123456');
        $order->setTotalAmount('0.01');
        $order->setBuyerId('2088622955313420');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->miniProgram($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
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
        $pay = new Pay();

        $outTradeNo = time() . '123456';
        $order = new Web();
        $order->setSubject('测试');
        $order->setOutTradeNo($outTradeNo);
        $order->setTotalAmount('0.01');
        $pay->aliPay($aliConfig)->web($order);

        $order = new \EasySwoole\Pay\AliPay\RequestBean\OrderFind();
        $order->setOutTradeNo('1626888486123456');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->orderFind($order)->toArray();
        $this->assertInstanceOf(SplArray::class, $aliPay->preQuest($data));

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();

        $outTradeNo = time() . '123456';
        $order = new Web();
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
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Pos();
        $order->setSubject('测试');
        $order->setTotalAmount('0.01');
        $order->setOutTradeNo(time());
        $order->setAuthCode('289756915257123456');
        $aliPay = $pay->aliPay($aliConfig);
        $aliPay->pos($order)->toArray();
        $this->assertTrue(true);

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
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
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Refund();
        $order->setSubject('测试');
        $order->setOutTradeNo('1626888486123456');
        $order->setRefundAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refund($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);


        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Refund();
        $order->setSubject('测试');
        $order->setOutTradeNo('1610101704123456');
        $order->setRefundAmount('0.01');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refund($order)->toArray();

        // 测试重复退单导致的异常
        $this->expectException(GatewayException::class);
        $this->expectExceptionMessage('Get Alipay API Error:Service Currently Unavailable系统异常aop.ACQ.SYSTEM_ERROR');
        $ret = $aliPay->preQuest($data);
        // $this->assertInstanceOf(SplArray::class, $ret);
    }

    public function testRefundFind()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\RefundFind();
        $order->setOutTradeNo('1626888486123456');
        $order->setOutRequestNo('2021010822001427690501456342');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refundFind($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\RefundFind();
        $order->setOutTradeNo('1610101704123456');
        $order->setOutRequestNo('2021010822001413421000127136');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->refundFind($order)->toArray();

        // 测试重复退单导致的异常
        $this->expectException(GatewayException::class);
        $this->expectExceptionMessage('Get Alipay API Error:Service Currently Unavailable系统异常aop.ACQ.SYSTEM_ERROR');
        $ret = $aliPay->preQuest($data);
        // $this->assertInstanceOf(SplArray::class, $ret);
    }

    public function testScan()
    {
        $aliConfig = $this->buildPublicConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Scan();
        $order->setSubject('测试');
        $order->setTotalAmount('0.01');
        $order->setOutTradeNo(time());
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->scan($order)->toArray();
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);

        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
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
        // 由于单笔转账必须使用公钥证书签名，故只有公钥证书的单测
        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\Transfer();
        $outBizNo = time();
        $order->setOutBizNo($outBizNo);
        $order->setTransAmount('0.01');
        $order->setProductCode('TRANS_ACCOUNT_NO_PWD');
        $order->setBizScene('DIRECT_TRANSFER');
        $order->setOrderTitle('转账标题');
        $order->setPayeeInfo([
            'identity' => '2088621955097505',
            'identity_type' => 'ALIPAY_USER_ID',
        ]);
        $order->setRemark('单笔转账');
        $aliPay = $pay->aliPay($aliConfig);
        $data = $aliPay->transfer($order)->toArray();
        $this->assertTrue(true);
        $ret = $aliPay->preQuest($data);
        $this->assertInstanceOf(SplArray::class, $ret);
    }

    public function testTransferFind()
    {
        // 由于单笔转账必须使用公钥证书签名，故只有公钥证书的单测
        $aliConfig = $this->buildCertConfig();
        $pay = new Pay();
        $order = new \EasySwoole\Pay\AliPay\RequestBean\TransferFind();
        $order->setOutBizNo(1626887694);
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
        $aliConfig = new Config();
        $aliConfig->setGateWay(GateWay::SANDBOX);
        $aliConfig->setAppId('2021000117693382');
        $aliConfig->setPublicKey('MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqMm74qBe0dgcm7pDaOT293KzaBFyMaKovts/t6RC3rbP+WTkWDvYGJmZV51nSHDf5sVcqQJoFri0LhsZGhDZSf9uohogFcsDlqDWl6Di9n8kHzBtzlR3Q9SEbL3dClZfsvxQZyDAAtTpBjDO1gi2xxKuhCWxCnELVRziQYyFI6XjRHPeMzPqYBDjWzEjDa47XxrAWJpSOIsPCKNpMJFj3RNn7GtOD31folcJarFtw8n8v5EankxHNda12Py5+pDlSOBHZVPLVOb+JcrNcBVqg9Bm8Kz4yGyfANaytpakc03r0PBdayjp5+R3LcjM4bJU2poPdhhMltY5B9cITQMJxwIDAQAB');
        $aliConfig->setPrivateKey('MIIEowIBAAKCAQEAo6GiO187S6LcrEYMB3rDgHVP4hdWEI4jqouDnmLSg0zyfI8k0/yyX/6j0wHIYC9GHTFbD2zQmC/HV1Dbns35Oj/n1ZlP9LmVU0ikwmtvV8PPxFEndZki0aWl2yX3tcZScZIJdD2qdzyD4pgRz7uiZkF5hHCfuaG4Hg+cZ6fOySBjjS29Gu3939qvniE9DNPu3HcMLE69FYH+0WtVsRD9dxfUnJeyKWzNfamMDfa7wd0ppu7ymcZb0wYOTZ1IyVudRMKRNRyod/7a/uVw5nCmfLAenKUMkfWmcQoB4Ommh+kfJLpxH8Nk1pehVBh2VPdEozht2ywqDQ/V1ZKDI4rbSQIDAQABAoIBAQCEHpoTPk1uQM3U+6ny0BjSu+YIM7d2Ho6FwahAVqKLCbIxCJM/5yVPhRdZ5HKZ1xHRuGxCBCZY+xsFUXBCxSSa98aFHQkGHGKJoHoH0R9RyfUUGkK2HTOT+x/z1rAvwTYIJVYk2TWumNoUN50KEgKKdgtb+GO/SuiSvSAYQdIhag6raJ2wfsaQVaXq96b4uRUsXMRlwYOI2OdLqPXzNvuYVftXxptH2qxJTYxotBOTWFA1y5v0549ToZYV+c3VGyLKluc6/WlGvhNYvg0h0c0CZqcq2vvFfOp4cmVfuI2LEnCJYUOFwsi7CUAqD+AyeCm8YO6XjHpYNqS+SxuIKYDRAoGBANVRF1EDj9R1xfnWYW0KUMXrpHkZkI/yP6U65BwqTA692BFbi31cWmAmmcF9zHwTgtSg4GxtnBar7sHed8XjgDPBy580GO7hyNV3K6dBg1oSDTXjkjFuEt0L8mAxbOPdYejyf1j65M7jIcKO58QpqTaedTxnyMMxGFAMEYm2KAVDAoGBAMRfdyeZ6Qg7IiEK0E9XIsfY/dcyhyxfIV/a6jgEJIPUZDjr7kE7bHf20XO476a67ov9qLol4NSR7QHlBD9FGaCirGUT5f/3lyzMyMGxAeTirMVNczGtbreQzZCbd/l4nvUyFi/QxsCI4e6zJ40ZjtKvPFGXVBD5aju0kPgYd46DAoGAMiHOowF9Secr0d1qJCAqf3kzvCof6VR7VK+UcHIYUdaX8uxayelsa/BmbizMY9SKCMKOO60+460gfXt1FpKyzHcdDZtGyM1TT6ekILiqz/4yEJoc/3TpBf4KxkSXXK3olsB24UiFgYGrq3e+TEGmPOncj4esjQL6vcU4Ue73VNUCgYBRIS/VSJ0iLWwYQqN1ZAaWkmutMM7v4g2j0InbwrpjTKhra+3vPWG+3lYCfXFlbO2JIK9I2MVejTtiAQAUM7Q2zX5z9Bid++iVNbXrb/ncWloO2cSxzXlklYqYJ+MVSmRB4QORlavHd8YAHDxG6zw6hvNgsiilKqZdLGiIV3NtiQKBgEk5xtFVRgX7xlz9uAeoXRJgijbioru+GUsXUv4j6TXmMz5enNRk31fshOT/6ZtkyqG74VCg646BCHBYfdWT8LK3EaDRyY/v/PooGeVtZHyvyWESdWSfapfyPkv/toHF2W1GUiEa0YYs+e+Iq2LVVWrTsRSMD/Q8Gse0duIpV/Nv');
        return $aliConfig;
    }

    protected function buildCertConfig()
    {
        $aliConfig = new Config();
        $aliConfig->setCertMode(true);
        $aliConfig->setGateWay(GateWay::SANDBOX);
        $aliConfig->setAppId('2016091800538780');
        $aliConfig->setPrivateKey('MIIEuwIBADANBgkqhkiG9w0BAQEFAASCBKUwggShAgEAAoIBAQCkrsvF56q/wNDC3brY7Sa5pIN/Pw8hUw7gpQVh2Z/V4fG/BHixqYntrFu+EnGsZJanAKCNCIwA2+zu0oMxQ1QsPHG1Jhhs1ADaIFIYamrejOzuvnUrXxjows3uKaOKesVs1dau504kuZximHnc6tQZ3p7esNCIY//2MGaqHRtieojSmFXdaPrH0PLYyQMx1zYCt65UMkNJ24QuBD48tgnMGrk3FYygRbQFtoREhH06DM83ZdgkG7yBPntvOoxzLKsK9GcT0ICQUCPM9qQzMe9A9On5YMnXJ/u1J3SQ0s5xSF7P2RoM1WRa7yoVyW/D+txJzzEXaycBjYtec3ddouXhAgMBAAECggEAR5AJzutYINGqJjPyYRfVDzD1T5NYgNO2EFrFlvrZ4Ti5M5e+1v1kiZqvl04uhYqEiPfVzNOc+zaWpEVoazzl0/9ELkLqtEgAQsluw1tjK2i0AR9UjU9a5LLaiBciESg+qIfYLdMn+v+JfLLjqeOF3eQGx6CwTcSe0x2/T0cswkLoeALFVjtKAgrwfBCOf3QBlX0o76HJW+3hVAlj8sZr6s2rJF77sb+jDu1ZM7wSMhp9MNjPxFNnjvO1wahhsu1J/I5PvGIjAmUTZCmkgPMc2WzpXjgE6Ymu6KED8KWNz5SMqZ6pHOnFOIW0X0pnRMRQTtlUcCGfOPMne86Y+CszAQKBgQDZkTDRoS+69jfmAJMfK604YVPCojJOZ2U+9oAi+EmgbPBKT37rY0KlGMAcobz5OKih78rwm8zuywNOkwHe0AQd1fP0vlwE3+yBah8JjIRbq6Wi/j5SrtOfxwmeQ/Yp02q76UvnDxZlOYu0RdpEfqd9l2DtMziHdlPSVxGc9xKC0QKBgQDBxhJw1jgK5/H3JRf/OZYFa2Us4tAif21Z1F54KLBYSA79c/8nfh3rXmarFIZT1NXVB+iQhqJik6ggIN6ojkSUj75rUOqrBU7qmitwc3YyU1dJ1FD5SZVx7HH83c5tXA2wlJhgANt7VsHh5+2ZkwNW5umHpZ2ADMpqhMCQZ5ZWEQKBgFXIWWdOFnOxAPk+4MM5hWLlfREQwqUHP3RD3OHs45rNWTDzhydoS66sw5KGcuwQ2ux+j5Wu2G6OvQ8OB37CpdzdrwKgy8dgQvAD15j8PnOmifhqJkiThf1JjRFJ2pVDNqJAqhzAZiQjPGIn6Jd5GLD8LstXlsJSdVpJ2jf5cuMBAoGBAIAhwb/rZ1OO3GlYle2m3pTm1xg/QvIM4Pote+povXMi8waV1Xr/4jjpS2qFP+3fJyae/CHVZTtZ+CqGkbVTnfW+t2OvNf2wnOZ025SYROgyQ94GDyVIixGyEA3tfbrCzCqfl8Kjzn5YeAwxmOOcWvDz8ChKU0OBMbgN4Gecl8SBAn8gDTQYvevciQzRlu5DaH5oBHi1b1u1UaknTY2Vlnd0wIhDvaHDAFq8i16RHMj12G01BvxKWbdVuI6ze0oct9hweK/9WAIPLVEqH0dXGxcg6pFz7NCeH59MBLTUVb/GMX0W6hWZiz85pmsfV3FF1VVOQaVlHvRG75Q2UHCDeVvT');
        $aliConfig->setCertPath(__DIR__ . '/cert/alipayCertPublicKey_RSA2.crt');
        $aliConfig->setRootCertPath(__DIR__ . '/cert/alipayRootCert.crt');
        $aliConfig->setMerchantCertPath(__DIR__ . '/cert/appCertPublicKey_2016091800538780.crt');
        return $aliConfig;
    }
}