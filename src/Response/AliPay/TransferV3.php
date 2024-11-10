<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class TransferV3 extends BaseBean
{
    public string $out_biz_no;

    public string $order_id;

    public string $pay_fund_order_id;

    public string $trans_date;

    public ?string $status;
}
