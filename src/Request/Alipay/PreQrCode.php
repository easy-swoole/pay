<?php

namespace EasySwoole\Pay\Request\Alipay;

class PreQrCode
{
    public string $out_trade_no;

    public string $total_amount;

    public string $subject;

    public string $notify_url;


}