<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderUnSettleQuery extends BaseBean
{
    public string $code;

    public string $msg;

    public string $unsettled_amount;
}