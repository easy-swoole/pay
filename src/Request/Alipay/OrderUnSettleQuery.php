<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderUnSettleQuery extends BaseBean
{
    public string $trade_no;
}