<?php

namespace EasySwoole\Pay\Beans\Alipay;

class SubMerchant extends BaseBean
{
    public ?string $sub_merchant_name;
    public string $merchant_id;

    public ?string $sub_merchant_service_description;

    public ?string $sub_merchant_service_name;
}