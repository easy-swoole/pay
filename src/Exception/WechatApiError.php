<?php

namespace EasySwoole\Pay\Exception;

class WechatApiError extends Wechat
{
    public string $apiCode;

    public ?array $detail = null;

}