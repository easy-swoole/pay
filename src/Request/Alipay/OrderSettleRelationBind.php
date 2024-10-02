<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleRelationBind extends BaseBean
{
    /** @var array RoyaltyEntity[] */
    public array $receiver_list;

    public string $out_request_no;
}