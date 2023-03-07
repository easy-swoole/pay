<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Spl\SplBean;

class Query extends SplBean
{
    public $amount;

    public string $appid;

    public string $attach;

    public string $bank_type;

    public string $mchid;

    public string $out_trade_no;

    public $payer;


    public $promotion_detail;

    public string $success_time;

    public string $trade_state;

    public string $trade_state_desc;

    public string $trade_type;

    public string $transaction_id;

}