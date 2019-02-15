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
}