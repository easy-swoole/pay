<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:42
 */

namespace EasySwoole\Pay\AliPay;


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
    public function web()
    {

    }
    /*
     * 手机网站支付
     */
    public function wap()
    {

    }

    /*
     * APP 支付
     */
    public function app()
    {

    }
    /*
     * 刷卡支付
     */
    public function pos()
    {

    }

    /*
     * 扫码支付
     */
    public function scan()
    {

    }

    /*
     * 帐户转账
     */
    public function transfer()
    {

    }

    /*
     * 小程序支付
     */
    public function miniProgram()
    {

    }
}