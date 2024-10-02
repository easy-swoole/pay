<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleRelationQuery extends BaseBean
{
    public string $out_request_no;

    public ?int $page_num;

    public ?int $page_size;


}