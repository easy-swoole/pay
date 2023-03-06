<?php

namespace EasySwoole\Pay;

use EasySwoole\Pay\Config\WechatConfig;

class Wechat
{
    function __construct(
        protected WechatConfig $config
    )
    {
    }

}