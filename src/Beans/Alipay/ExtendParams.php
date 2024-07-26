<?php

namespace EasySwoole\Pay\Beans\Alipay;

use EasySwoole\Spl\SplBean;

class ExtendParams extends SplBean
{
    public string $sys_service_provider_id;


    public string $specified_seller_name;

    public string $card_type;


}