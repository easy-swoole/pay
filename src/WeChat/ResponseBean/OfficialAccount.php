<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\WeChat\ResponseBean;


use EasySwoole\Utility\Random;

class OfficialAccount extends Base
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