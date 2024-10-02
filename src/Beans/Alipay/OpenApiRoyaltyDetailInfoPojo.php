<?php

namespace EasySwoole\Pay\Beans\Alipay;

class OpenApiRoyaltyDetailInfoPojo extends BaseBean
{
    public string $trans_in;

    public ?string $royalty_type;

    public ?string $trans_out;

    public ?string $trans_out_type;

    public ?string $trans_in_type;

    public ?float $amount;

    public ?string $desc;

    public ?string $royalty_scene;


    public ?string $trans_in_name;


}