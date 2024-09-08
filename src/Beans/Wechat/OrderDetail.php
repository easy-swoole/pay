<?php

namespace EasySwoole\Pay\Beans\Wechat;

class OrderDetail extends BaseBean
{
    public ?int $cost_price;

    public ?string $invoice_id;

    public ?array $goods_detail = null;
}