<?php

declare(strict_types=1);

namespace EasySwoole\Pay\WeChat\RequestBean;


class Reverse extends Base
{
    /**
     * 商户订单号
     * @var string
     */
    protected $out_trade_no;

    /**
     * 微信订单号
     * @var string
     */
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