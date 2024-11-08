<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\ExtendParams;
use EasySwoole\Pay\Beans\Alipay\ExtUserInfo;

class App extends BaseBean
{
    public string $out_trade_no;

    public string $total_amount;

    public string $subject;


    public ?string $notify_url;

    public ?string $product_code;


    public ?string $goods_detail;

    public ?string $time_expire; //格式为yyyy-MM-dd HH:mm:ss。超时时间范围：1m~15d。

    public ?ExtendParams $extend_params;

    public ?string $passback_params;

    public ?string $merchant_order_no;


    public ?ExtUserInfo $ext_user_info;

    public ?string $query_options;

    public ?string $seller_id;//支付宝子账号ID
}