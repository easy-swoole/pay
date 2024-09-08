<?php

namespace EasySwoole\Pay\Request\Alipay;


use EasySwoole\Pay\Beans\Alipay\BaseBean;

class TradeQuery extends BaseBean
{
    public ?string $out_trade_no;

    public ?string $trade_no;

    public ?array $query_options = null;
}