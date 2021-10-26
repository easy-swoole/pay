<?php
/**
 *
 * Copyright  EasySwoole
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 13:24
 *
 */

namespace EasySwoole\Pay\WeChat\ResponseBean;

class Micro extends Base
{

    protected $appId;
    protected $nonce_str;
    protected $sign;
    protected $transaction_id;
    protected $time_end;
    protected $out_trade_no;
    protected $return_code;
    protected $return_msg;
    protected $appid;
    protected $mch_id;
    protected $sub_mch_id;
    protected $result_code;
    protected $openid;
    protected $is_subscribe;
    protected $trade_type;
    protected $total_fee;、
    protected $err_code_des;
    protected $err_code;

    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }

    public function getTimeEnd(): string
    {
        return $this->time_end;
    }

    public function getNonceStr(): string
    {
        return $this->nonce_str;
    }

    public function setPaySign($sign): string
    {
        $this->sign = $sign;
    }
}