<?php

namespace EasySwoole\Pay\Beans\Alipay;

use EasySwoole\Spl\SplBean;

class ExtUserInfo extends SplBean
{
    public ?string $cert_no;

    public ?string $min_age;

    public ?string $name;

    public ?string $mobile;

    public ?string $cert_type;

    public ?string $fix_buyer;

    public ?string $need_check_info;

    public ?string $identity_hash;

}