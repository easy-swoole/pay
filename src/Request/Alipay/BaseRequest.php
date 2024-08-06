<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Exception\Alipay;
use EasySwoole\Spl\SplBean;

class BaseRequest extends BaseBean
{
    public string $app_id;

    public string $method;

    public string $format;

    public string $charset;

    public string $sign_type;

    public ?string $sign;

    public string $timestamp;

    public string $version;
    
    public ?string $notify_url;

    public ?string $app_auth_token;
    public ?string $biz_content;

    public ?string $app_cert_sn;

    public ?string $alipay_root_cert_sn;
}