<?php

namespace EasySwoole\Pay\Response\AliPay;

class TradeClose extends BaseBean
{
    public string $code;

    public string $msg;

    public string $out_trade_no;

    public string $trade_no;
}