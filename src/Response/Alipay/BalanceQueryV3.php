<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class BalanceQueryV3 extends BaseBean
{
    public ?string $available_amount;

    public ?array $amount_detail;

    public ?string $freeze_amount;

    public ?string $total_amount;
}