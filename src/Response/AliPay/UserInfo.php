<?php

namespace EasySwoole\Pay\Response\AliPay;
use EasySwoole\Pay\Beans\Alipay\BaseBean;

class UserInfo extends BaseBean
{
    public string $avatar;

    public string $city;

    public string $nick_name;

    public string $province;

    public string $user_id;

    public string $open_id;

    public string $gender;
}