<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettle extends BaseBean
{
    public string $code;

    public string $msg;

    public string $settle_no;

    public string $trade_no;
}