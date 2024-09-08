<?php

namespace EasySwoole\Pay\Response\AliPay;
use EasySwoole\Pay\Beans\Wechat\BaseBean;

class TradeRefund extends BaseBean
{
    public string $trade_no;
    public string $out_trade_no;

    public string $buyer_logon_id;

    public string $refund_fee;

    public ?array $refund_detail_item_list;

    public ?string $store_name;

    public ?string $buyer_user_id;

    public ?string $buyer_open_id;

    public ?string $send_back_fee;

    public ?string $fund_change;

    public ?string $refund_hyb_amount;

    public ?array $refund_charge_info_list;

    public ?array $refund_voucher_detail_list;


}