<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:38
 */

namespace EasySwoole\Pay;




use EasySwoole\Pay\Config\AlipayConfig;
use EasySwoole\Pay\Config\WechatConfig;

class Pay
{
	private ?AlipayConfig $alipayConfig;

    private ?WechatConfig $wechatConfig;

    private ?Wechat $wechat = null;

    private ?Alipay $alipay = null;


    function setWechatConfig(WechatConfig $wechat):static
    {
        $this->wechatConfig = $wechat;
        return $this;
    }

    function setAlipayConfig(AlipayConfig $alipay):static
    {
        $this->alipayConfig = $alipay;
        return $this;
    }

    function wechat():Wechat
    {
        if(!$this->wechat){
            $this->wechat = new Wechat($this->wechatConfig);
        }
        return $this->wechat;
    }

    function alipay()
    {
        if($this->alipay){
            $this->alipay = new Alipay($this->alipayConfig);
        }
        return $this->alipay;
    }
}