<?php

namespace EasySwoole\Pay\Request\Alipay;


use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OAuthToken extends BaseBean
{
    /**
     * @var string 授权方式
     * 支持枚举值 authorization_code/refresh_token
     */
    public string $grant_type = 'authorization_code';

    public ?string $code;

    public ?string $refresh_token;
}
