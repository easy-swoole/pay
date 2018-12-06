<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午12:00
 */

namespace EasySwoole\EasyPay;

use EasySwoole\EasyPay\Beans\Options\WechatPayOptions;
use EasySwoole\EasyPay\Gateway\Wechat;

class Factory
{
    static function Wechat(WechatPayOptions $wechatOptions, $isSandBox = false)
    {
        return new Wechat($wechatOptions, $isSandBox);
    }
}