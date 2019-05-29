<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/12
 * Time: 16:20
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class OrderFind extends Base
{
    protected $out_trade_no;
    protected $transaction_id;

    public function getOutTradeNo(): string
    {
        return $this->out_trade_no;
    }

    public function setOutTradeNo(string $outTradeNo): void
    {
        $this->out_trade_no = $outTradeNo;
    }

    public function setTransactionId(string $transactionId): void
    {
        $this->transaction_id = $transactionId;
    }

    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }
}