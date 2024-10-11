<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class RedPacketPay extends BaseBean
{
    public string $out_biz_no;

    public float $trans_amount;

    public string $product_code = 'STD_RED_PACKET';

    public string $biz_scene = 'PERSONAL_PAY';

    public ?string $order_id;

    public ?string $remark;

    public ?string $order_title;

    public ?string $time_expire;

    public ?string $refund_time_expire;

    public ?string $business_params;

}