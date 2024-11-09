<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class BalanceQuery extends BaseBean
{
    public ?string $bill_user_id = '';//默认空字符串，查本账户
}