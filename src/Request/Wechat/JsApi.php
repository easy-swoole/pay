<?php

namespace EasySwoole\Pay\Request\Wechat;

use EasySwoole\Pay\Beans\Wechat\Payer;

class JsApi extends BaseRequest
{
    public Payer $payer;

    protected function initialize():void
    {
        if(empty($this->payer)){
            $this->payer = new Payer();
        }
    }
}