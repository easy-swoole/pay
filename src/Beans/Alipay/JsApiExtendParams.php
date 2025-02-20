<?php

namespace EasySwoole\Pay\Beans\Alipay;

class JsApiExtendParams extends BaseBean
{
    public ?string $sys_service_provider_id;

    public ?string $hb_fq_num;

    public ?string $hb_fq_seller_percent;

    public ?string $trade_component_order_id;
}
