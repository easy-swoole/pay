<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\PostPayments;

class PreFreeze extends BaseBean
{
    public string $out_trade_no;

    public string $out_request_no;

    public string $order_title;

    public string $amount;

    public string $product_code = 'PREAUTH_PAY';

    /*
【枚举值】
后付金额已知: POSTPAY
后付金额未知: POSTPAY_UNCERTAIN
纯免押: DEPOSIT_ONLY
【必选条件】使用免押产品必传该字段
     */
    public ?string $deposit_product_mode;


    /**
     * @var array<PostPayments>|null 【描述】后付费项目，有付费项目时需要传入该字段。不同受理台模式需要传入不同参数，后付费项目名称和计费说明需要通过校验规则，同时计费说明将展示在开通受理台上。当受理台模式（deposit_product_mode）传入POSTPAY 时，后付费项目名称（name）、金额（amount）必传，计费说明（description）选传；当传入 POSTPAY_UNCERTAIN 时，后付费项目名称（name）、计费说明（description）必传，金额（amount）不传。 具体规则参考文档：https://opendocs.alipay.com/b/08tf3t?pathHash=d67d7545
     * 【必选条件】有付费项目时需要传入该字段
     */
    public ?array $post_payments ;


    public ?string $payee_user_id;


    public ?string $payee_logon_id;

    public ?string $timeout_express;


    public ?string $identity_params;


    public ?string $extra_param;



    public ?string $business_params;


}