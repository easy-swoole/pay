<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class TradeRefund extends BaseBean
{
    public string $refund_amount;

    public ?string $out_trade_no;

    public ?string $trade_no;

    public ?string $refund_reason;

    public ?string $out_request_no;

    public ?array $refund_goods_detail;

    public ?array $refund_royalty_parameters;

    public ?string $query_options;


    public ?string $related_settle_confirm_no;


}