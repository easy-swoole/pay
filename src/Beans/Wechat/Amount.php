<?php

namespace EasySwoole\Pay\Beans\Wechat;


class Amount extends BaseBean
{
    public int $total;

    public string $currency = 'CNY';
}