<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettle extends BaseBean
{
    public string $out_request_no;

    public string $trade_no;

    public array $royalty_parameters = [];

    public ?string $operator_id;

    public $extend_params;
}