<?php

namespace EasySwoole\Pay\Request\Alipay;

class TradeQuery extends BaseBean
{
    public ?string $out_trade_no;

    public ?string $trade_no;

    public ?array $query_options = null;
}