<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:40
 */

namespace EasySwoole\Pay\WeChat;


class WeChat
{
    private $config;

    function __construct(Config $config)
    {
        $this->config = $config;
    }

    /*
     * 公众号支付
     */
    public function officialAccount()
    {

    }

    /*
     * 小程序支付
     */
    public function miniProgram()
    {

    }

    /*
     * H5 支付
     */
    public function wap()
    {

    }
    /*
     * 扫码支付
     */
    public function scan()
    {

    }

    /*
     * 刷卡支付
     */
    public function pos()
    {

    }

    /*
     * APP 支付
     */
    public function app()
    {

    }

    /*
     * 企业付款
     */
    public function transfer()
    {

    }

    /*
     * 普通红包
     */
    public function redPack()
    {

    }

    /*
     * 分裂红包
     */
    public function groupRedPack()
    {

    }

}