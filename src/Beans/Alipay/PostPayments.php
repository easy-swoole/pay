<?php

namespace EasySwoole\Pay\Beans\Alipay;

class PostPayments extends BaseBean
{
    public ?string $name;

    public ?string $amount;

    public ?string $description;
}