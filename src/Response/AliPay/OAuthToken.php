<?php
namespace EasySwoole\Pay\Response\AliPay;
use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OAuthToken extends BaseBean
{
    public ?string $access_token;

    public ?string $expires_in;

    public ?string $refresh_token;

    public ?string $re_expires_in;

    public ?string $user_id;

    public ?string $open_id;

    public ?string $auth_start;

    public ?string $alipay_user_id;
}
