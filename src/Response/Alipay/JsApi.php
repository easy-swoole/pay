<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class JsApi extends BaseBean
{

    public string $code;

    public string $msg;

    public string $out_trade_no;

    public string $trade_no;

}