<?php

namespace EasySwoole\Pay\Beans\Alipay;

class RoyaltyDetail extends BaseBean
{
    public string $operation_type;

    public string $amount;

    public string $state;

    public ?string $execute_dt;

    public ?string $trans_out;

    public ?string $trans_out_type;

    public ?string $trans_in;

    public ?string $trans_in_type;

    public ?string $detail_id;

    public ?string $error_code;

    public ?string $error_desc;

}