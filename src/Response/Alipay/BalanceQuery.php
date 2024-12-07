<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class BalanceQuery extends BaseBean
{
    public string $code;

    public string $msg;

    public string $freeze_amount;

    public string $total_amount;

    public string $available_amount;
}