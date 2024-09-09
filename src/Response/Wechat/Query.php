<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Pay\Beans\Wechat\Payer;
use EasySwoole\Pay\Response\Wechat\QueryBean\Amount;
use EasySwoole\Spl\Attribute\ConvertBean;
use EasySwoole\Spl\SplBean;

class Query extends SplBean
{
    #[ConvertBean(Amount::class)]
    public Amount $amount;

    public string $appid;

    public string $attach;

    public string $bank_type;

    public string $mchid;

    public string $out_trade_no;

    #[ConvertBean(Payer::class)]
    public Payer $payer;


    public array $promotion_detail;

    public string $success_time;

    public string $trade_state;

    public string $trade_state_desc;

    public string $trade_type;

    public string $transaction_id;

}