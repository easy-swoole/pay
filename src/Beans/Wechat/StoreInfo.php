<?php

namespace EasySwoole\Pay\Beans\Wechat;

class StoreInfo extends BaseBean
{
    public string $id;

    public ?string $name;

    public ?string $area_code;

    public ?string $address;
}