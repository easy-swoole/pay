<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class RefundQuery extends BaseBean
{
    public string $code;

    public string $msg;

    public string $trade_no;

    public string $out_request_no;

    public string $total_amount;

    public string $refund_amount;

    public string|null $refund_status;

    public array|null $refund_royaltys;

    public string|null $gmt_refund_pay;

    public array|null $refund_detail_item_list;

    public string|null $send_back_fee;

    public array|null $deposit_back_info;

    public array|null $refund_voucher_detail_list;

    public string|null $pre_auth_cancel_fee;

    public string|null $refund_hyb_amount;

    public array|null $refund_charge_info_list;

    public array|null $deposit_back_info_list;
}