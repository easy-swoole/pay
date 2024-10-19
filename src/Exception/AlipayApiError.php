<?php

namespace EasySwoole\Pay\Exception;

class AlipayApiError extends Alipay
{
    public string $apiCode;

    public ?string $apiMsg;

    public ?string $apiSubCode;

}