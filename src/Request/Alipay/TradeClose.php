<?php

namespace EasySwoole\Pay\Request\Alipay;


use EasySwoole\Pay\Beans\Alipay\BaseBean;

class TradeClose extends BaseBean
{
    public ?string $out_trade_no;

    public ?string $trade_no;

    public ?string $operator_id;
}