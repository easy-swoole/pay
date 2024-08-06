<?php

namespace EasySwoole\Pay\Request\Alipay;


use EasySwoole\Pay\Beans\Alipay\ExtendParams;

class PreQrCode extends BaseBean
{
    public string $out_trade_no;

    public string $total_amount;

    public string $subject;

    public ?string $product_code;

    public ?string $seller_id;


    public ?string $body;

    public ?string $goods_detail;


    public ?ExtendParams $extend_params;

    public ?string $business_params;

    public ?float $discountable_amount;

    public ?string $store_id;

    public ?string $operator_id;

    public ?string $terminal_id;

    public ?string $merchant_order_no;

}