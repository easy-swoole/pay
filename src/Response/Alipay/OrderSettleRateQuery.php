<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleRateQuery extends BaseBean
{
    public string $code;

    public string $msg;

    public int $max_ratio;

    public string $user_id;
}