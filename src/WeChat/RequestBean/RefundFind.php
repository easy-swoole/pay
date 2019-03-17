<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/12
 * Time: 16:20
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class RefundFind extends Base
{
    protected $out_trade_no;
    protected $transaction_id;
    protected $out_refund_no;
    protected $refund_id;
    protected $offset;

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

    public function setOutRefundNo(string $outRefundNo): void
    {
        $this->out_refund_no = $outRefundNo;
    }

    public function getOutRefundNo(): string
    {
        return $this->out_refund_no;
    }

    public function setRefundId(string $refundId): void
    {
        $this->refund_id = $refundId;
    }

    public function getRefundId(): string
    {
        return $this->refund_id;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}