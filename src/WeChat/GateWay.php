<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:08
 */

namespace EasySwoole\Pay\WeChat;


use EasySwoole\Spl\SplEnum;

class GateWay extends SplEnum
{
    const NORMAL = 'https://api.mch.weixin.qq.com';
    const SANDBOX = 'https://api.mch.weixin.qq.com/sandboxnew';
    const SERVICE = 'https://api.mch.weixin.qq.com';
    const US = 'https://apius.mch.weixin.qq.com';
    const HK = 'https://apihk.mch.weixin.qq.com';

}