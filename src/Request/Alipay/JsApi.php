<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\JsApiBusinessParams;
use EasySwoole\Pay\Beans\Alipay\JsApiExtendParams;
use EasySwoole\Pay\Beans\Alipay\SignParams;

class JsApi extends BaseBean
{
    public string $out_trade_no;

    public string $total_amount;

    public string $subject;

    public string $product_code = 'JSAPI_PAY';

    public string $op_app_id;

    public string $buyer_id;

    public string $buyer_open_id;

    public ?string $op_buyer_open_id;

    public ?string $seller_id;

    public ?string $body;

    public ?string $goods_detail;

    public ?string $time_expire; //格式为yyyy-MM-dd HH:mm:ss。超时时间范围：1m~15d。

    public ?string $timeout_express; //格式为yyyy-MM-dd HH:mm:ss。超时时间范围：1m~15d。

    public ?JsApiExtendParams $extend_params;

    public ?JsApiBusinessParams $business_params;

    public ?string $passback_params;

    public ?string $discountable_amount;

    public ?string $undiscountable_amount;

    public ?string $store_id;

    public ?string $alipay_store_id;

    public ?string $enable_pay_channels;

    public ?string $disable_pay_channels;

    public ?string $query_options;

    public ?SignParams $agreement_sign_params;
}
