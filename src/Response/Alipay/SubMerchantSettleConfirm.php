<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class SubMerchantSettleConfirm extends BaseBean
{
    public string $code;

    public string $msg;

    public string $out_request_no;

    public string $settle_amount;

    public string $trade_no;
}