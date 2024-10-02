<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleQuery extends BaseBean
{
    public ?string $settle_no;

    public ?string $out_request_no;

    public ?string $trade_no;

}