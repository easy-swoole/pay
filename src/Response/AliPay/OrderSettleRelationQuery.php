<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class OrderSettleRelationQuery extends BaseBean
{
    public string $code;

    public string $msg;

    public int $current_page_num;

    public int $current_page_size;

    public array $receiver_list = [];

    public string $result_code;

    public int $total_page_num;

    public int $total_record_num;
}