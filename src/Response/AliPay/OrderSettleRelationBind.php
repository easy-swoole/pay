<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleRelationBind extends BaseBean
{
    public string $code;

    public string $msg;

    public string $result_code;
}