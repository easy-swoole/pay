<?php

namespace EasySwoole\Pay\WeChat\ResponseBean;

class BarCode extends Base
{
    protected $return_code;

    protected $return_msg;

    protected $result_code;

    protected $total_fee;

    protected $transaction_id;

    protected $out_trade_no;

    protected $time_end;

    protected $attach;

    protected $openid;

    protected $is_subscribe;

    protected $trade_type;

    protected $bank_type;

    protected $fee_type;

    protected $settlement_total_fee;

    protected $coupon_fee;

    protected $cash_fee_type;

    protected $cash_fee;
}