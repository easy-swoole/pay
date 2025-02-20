<?php

namespace EasySwoole\Pay\Beans\Alipay;

class JsApiBusinessParams extends BaseBean
{
    public ?string $enterprise_pay_info;

    public ?string $enterprise_pay_amount;

    public ?string $mc_create_trade_ip;

    public ?string $tiny_app_merchant_biz_type;
}
