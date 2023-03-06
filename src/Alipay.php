<?php

namespace EasySwoole\Pay;

use EasySwoole\Pay\Config\AlipayConfig;

class Alipay
{
    function __construct(
        protected AlipayConfig $config
    )
    {

    }
}