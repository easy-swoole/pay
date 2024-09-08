<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Pay\Beans\Wechat\BaseBean;

class PreQrCode extends BaseBean
{
    public string $code;

    public string $msg;

    public string $out_trade_no;

    public string $qr_code;
}