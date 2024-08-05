<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Spl\SplBean;

class BaseRequest extends SplBean
{
    protected string $app_id;

    protected string $method;

    protected string $format;

    protected string $charset;

    protected string $sign_type;

    protected string $sign;

    protected string $timestamp;

    protected string $version;
    
    protected ?string $notify_url;

    protected ?string $app_auth_token;
    protected string $biz_content;

}