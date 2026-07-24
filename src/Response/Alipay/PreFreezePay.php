<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\VoucherDetail;

class PreFreezePay extends BaseBean
{
    public string $trade_no;

    public string $out_trade_no;

    public ?string $buyer_logon_id;

    public string $total_amount;

    public string $receipt_amount;

    public string $gmt_payment;


    public ?string $buyer_user_id;

    public ?string $buyer_open_id;

    public ?string $buyer_pay_amount;

    public ?string $point_amount;

    public ?string $invoice_amount;


    public ?string $store_name;


    public ?string $discount_goods_detail;

    /**
     * @var string|null
     * 【描述】异步支付模式，目前有五种值：
     * ASYNC_DELAY_PAY(异步延时付款);
     * ASYNC_REALTIME_PAY(异步准实时付款);
     * SYNC_DIRECT_PAY(同步直接扣款);
     * NORMAL_ASYNC_PAY(纯异步付款);
     * QUOTA_OCCUPYIED_ASYNC_PAY(异步支付并且预占了先享后付额度);
     */
    public ?string $async_payment_mode;


    /**
     * @var array<VoucherDetail>|null
     */
    public ?array $voucher_detail_list;


    /**
     * @var string|null
     * 【枚举值】
     * 信用预授权支付: CREDIT_PREAUTH_PAY
     */
    public ?string $auth_trade_pay_mode;


    public ?string $mdiscount_amount;

    public ?string $discount_amount;


}