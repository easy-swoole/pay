<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/12
 * Time: 18:22
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class Refund extends Base
{
    protected $transaction_id;
    protected $out_trade_no;
    protected $out_refund_no;
    protected $total_fee;
    protected $refund_fee;
    protected $refund_fee_type;
    protected $refund_desc;
    protected $refund_account;
    protected $notify_url;

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

    public function setTotalFee(int $totalFee): void
    {
        $this->total_fee = $totalFee;
    }

    public function getTotalFee(): int
    {
        return $this->total_fee;
    }

    public function setRefundFee(int $refundFee): void
    {
        $this->refund_fee = $refundFee;
    }

    public function getRefundFee(): int
    {
        return $this->refund_fee;
    }

    public function setRefundFeeType(string $refundFeeType): void
    {
        $this->refund_fee_type = $refundFeeType;
    }

    public function getRefundFeeType(): string
    {
        return $this->refund_fee_type;
    }

    public function setRefundDesc(string $refundDesc): void
    {
        $this->refund_desc = $refundDesc;
    }

    public function getRefundDesc(): string
    {
        return $this->refund_desc;
    }

    public function setRefundAccount(string $refundAccount): void
    {
        $this->refund_account = $refundAccount;
    }

    public function getRefundAccount(): string
    {
        return $this->refund_account;
    }

    public function setNotifyUrl(string $notifyUrl): void
    {
        $this->notify_url = $notifyUrl;
    }

    public function getNotifyUrl(): string
    {
        return $this->notify_url;
    }
}