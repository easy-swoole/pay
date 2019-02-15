<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:42
 */

namespace EasySwoole\Pay\AliPay;


use EasySwoole\Pay\AliPay\RequestBean\App;
use EasySwoole\Pay\AliPay\RequestBean\MiniProgram;
use EasySwoole\Pay\AliPay\RequestBean\Pos;
use EasySwoole\Pay\AliPay\RequestBean\Scan;
use EasySwoole\Pay\AliPay\RequestBean\Transfer;
use EasySwoole\Pay\AliPay\RequestBean\Wap;
use EasySwoole\Pay\AliPay\RequestBean\Web;
use EasySwoole\Pay\AliPay\ResponseBean\Web as WebResponse;

class AliPay
{
    private $config;

    function __construct(Config $config)
    {
        $this->config = $config;
    }

    /*
     * 电脑支付
     */
    public function web(Web $web):WebResponse
    {

    }
    /*
     * 手机网站支付
     */
    public function wap(Wap $wap)
    {

    }

    /*
     * APP 支付
     */
    public function app(App $app)
    {

    }
    /*
     * 刷卡支付
     */
    public function pos(Pos $pos)
    {

    }

    /*
     * 扫码支付
     */
    public function scan(Scan $scan)
    {

    }

    /*
     * 帐户转账
     */
    public function transfer(Transfer $transfer)
    {

    }

    /*
     * 小程序支付
     */
    public function miniProgram(MiniProgram $miniProgram)
    {

    }
}