<?php
/**
 *
 * Copyright  EasySwoole
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 13:24
 *
 */

namespace EasySwoole\Pay\WeChat\ResponseBean;


use EasySwoole\Spl\SplBean;
use EasySwoole\Utility\Random;

class MiniProgram extends SplBean
{
    protected $appId;
    protected $timeStamp;
    protected $nonceStr;
    protected $package;
    protected $signType;
    protected $paySign;

    public function setPaySign(string $paySign): void
    {
        $this->paySign = $paySign;
    }

    public function initialize(): void
    {
        if (empty($this->nonceStr)) {
            $this->nonceStr = Random::character(32);
        }
        if (empty($this->timeStamp)) {
            $this->timeStamp = strval(time());
        }
    }
}