<?php

namespace EasySwoole\Pay\Request\Alipay;


class TradeClose extends BaseRequest
{
    public ?string $out_trade_no;

    public ?string $trade_no;

    public ?string $operator_id;
}