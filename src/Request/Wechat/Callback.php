<?php

namespace EasySwoole\Pay\Request\Wechat;

use EasySwoole\Pay\Beans\Wechat\BaseBean;

class Callback extends BaseBean
{
    public string $signature;
    public int $timestamp;
    public string $nonce;
    public string $certSerial;
    public string $body;

}