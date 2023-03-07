<?php

namespace EasySwoole\Pay\Response\Wechat\QueryBean;

use EasySwoole\Spl\SplBean;

class Amount extends SplBean
{
    public string $currency;

    public string $payer_currency;

    public string $payer_total;

    public int $total;

}