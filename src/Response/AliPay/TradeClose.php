<?php

namespace EasySwoole\Pay\Response\AliPay;
use EasySwoole\Pay\Beans\Wechat\BaseBean;

class TradeClose extends BaseBean
{
    public string $code;

    public string $msg;

    public string $out_trade_no;

    public string $trade_no;
}