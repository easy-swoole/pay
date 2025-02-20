<?php

namespace EasySwoole\Pay\Beans\Alipay;

class PeriodRuleParams extends BaseBean
{
    public string $period_type;

    public string $period;

    public string $execute_time;

    public string $single_amount;

    public ?string $total_amount;

    public ?string $total_payments;
}
