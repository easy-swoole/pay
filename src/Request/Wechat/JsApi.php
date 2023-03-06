<?php

namespace EasySwoole\Pay\Request\Wechat;

class JsApi extends Base
{
    protected $payer;

    function setPayer(string $openId)
    {
        $this->payer = [
            'openid'=>$openId
        ];
    }
}