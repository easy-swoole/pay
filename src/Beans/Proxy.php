<?php

namespace EasySwoole\Pay\Beans;

use EasySwoole\Spl\SplBean;

class Proxy extends SplBean
{
    public string $http_proxy_host;

    public int $http_proxy_port;

    public ?string $http_proxy_user;

    public ?string $http_proxy_password;

    function toArray(int|callable $filter = null): array
    {
        return parent::toArray(self::FILTER_NOT_NULL);
    }

}