<?php

namespace EasySwoole\Pay\Beans\Wechat;


class GoodsDetail extends BaseBean
{
    public string $merchant_goods_id;

    public ?string $wechatpay_goods_id;

    public ?string $goods_name;

    public int $quantity;

    public int $unit_price;
}