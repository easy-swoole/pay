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
}