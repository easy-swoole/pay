<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class AccountBillLogQuery extends BaseBean
{

    public string|null $bill_user_id;

    public string|null $open_id;

    public string|null $start_time;//2019-01-01 00:00:00

    public string|null $end_time;//2019-01-01 00:00:00

    public string|null $alipay_order_no;


    public string|null $merchant_order_no;

    public int|null $page_no;

    public int $page_size = 100;

    public string|null $trans_code;


    public string|null $agreement_no;

    public string|null $agreement_product_code;


    function setStartTime(int $timestamp):void
    {
        $this->start_time = date('Y-m-d H:i:s', $timestamp);
    }

    function setEndTime(int $timestamp):void
    {
        $this->end_time = date('Y-m-d H:i:s', $timestamp);
    }

}