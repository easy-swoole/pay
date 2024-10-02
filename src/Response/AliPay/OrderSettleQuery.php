<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleQuery extends BaseBean
{
    public string $code;

    public string $msg;

    public string $operation_dt;

    public string $out_request_no;

    public array $royalty_detail_list = [];
}