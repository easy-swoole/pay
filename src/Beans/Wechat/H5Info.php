<?php

namespace EasySwoole\Pay\Beans\Wechat;

class H5Info extends BaseBean
{
    public string $type = 'Mobile';

    public ?string $app_name;

    public ?string $app_url;

    public ?string $bundle_id;

    public ?string $package_name;
}