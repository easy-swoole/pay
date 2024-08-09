<?php

namespace EasySwoole\Pay\Response\AliPay;

use EasySwoole\Spl\SplBean;

class TradeQuery extends BaseBean
{
    public string $trade_no;

    public string $out_trade_no;

    public string $buyer_logon_id;

    /**
     * WAIT_BUYER_PAY（交易创建，等待买家付款）
     * TRADE_CLOSED（未付款交易超时关闭，或支付完成后全额退款）
     * TRADE_SUCCESS（交易支付成功）
     * TRADE_FINISHED（交易结束，不可退款）
     */
    public string $trade_status;

    /**
     * 支付金额，单位元
     */
    public string $total_amount;

    public array $fund_bill_list;

    /** @var string|null
     *新商户建议使用buyer_open_id替代该字段。对于新商户，buyer_user_id字段未来计划逐步回收，存量商户可继续使用。如使用buyer_open_id，请确认 应用-开发配置-openid配置管理 已启用。无该配置项，可查看openid配置申请。
     */
    public ?string $buyer_user_id;

    public ?string $send_pay_date;

    public ?string $receipt_amount;

    public ?string $store_id;

    public ?string $terminal_id;

    public ?string $store_name;

    public ?string $buyer_open_id;

    /**
     * 买家用户类型。CORPORATE:企业用户；PRIVATE:个人用户。
     */
    public ?string $buyer_user_type;


    public ?string $mdiscount_amount;

    public ?string $discount_amount;

    public ?string $ext_infos;

    public ?string $buyer_pay_amount;

    public ?string $point_amount;

    public ?string $invoice_amount;



}