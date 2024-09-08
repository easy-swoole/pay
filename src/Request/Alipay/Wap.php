<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\ExtendParams;
use EasySwoole\Pay\Beans\Alipay\ExtUserInfo;

class Wap extends BaseBean
{
    public string $out_trade_no;

    public string $total_amount;

    public string $subject;

    public string $product_code = 'QUICK_WAP_WAY';

    public ?string $body;

    public ?string $goods_detail;


    public ?ExtendParams $extend_params;

    public ?string $business_params;

    public ?float $discountable_amount;

    public ?string $merchant_order_no;

    public ?string $notify_url;

    public ?string $return_url;

    public ?string $quit_url;

    public ?string $time_expire; //格式为yyyy-MM-dd HH:mm:ss。超时时间范围：1m~15d。

    public ?string $passback_params;

    public ?ExtUserInfo $ext_user_info;
}