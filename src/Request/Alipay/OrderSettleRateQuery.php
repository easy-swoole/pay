<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleRateQuery extends BaseBean
{
    public string $out_request_no;
}