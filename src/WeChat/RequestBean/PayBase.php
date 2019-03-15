<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/12
 * Time: 16:26
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


abstract class PayBase extends Base
{

    protected $device_info;     //否
    protected $body;            //是
    protected $detail;          //否
    protected $attach;          //否
    protected $out_trade_no;    //是
    protected $fee_type;        //否，默认CNY
    protected $total_fee;       //是，以分计算
    protected $spbill_create_ip;//是
    protected $time_start;      //否
    protected $time_expire;     //否
    protected $goods_tag;       //否

    protected $limit_pay;       //否 no_credit
    protected $receipt;         //否 Y

//    protected $scene_info;
//    protected $product_id;
//    protected $auth_code;

    public function getDeviceInfo(): ?string
    {
        return $this->device_info;
    }

    public function setDeviceInfo(string $deviceInfo): void
    {
        $this->device_info = $deviceInfo;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): void
    {
        $this->detail = $detail;
    }

    public function getAttach(): ?string
    {
        return $this->attach;
    }

    public function setAttach(string $attach): void
    {
        $this->attach = $attach;
    }

    public function getOutTradeNo(): string
    {
        return $this->out_trade_no;
    }

    public function setOutTradeNo(string $outTradeNo): void
    {
        $this->out_trade_no = $outTradeNo;
    }

    public function getFeeType(): string
    {
        return $this->fee_type;
    }

    public function setFeeType(string $feeType): void
    {
        $this->fee_type = $feeType;
    }

    public function getTotalFee(): int
    {
        return $this->total_fee;
    }

    public function setTotalFee(int $totalFee): void
    {
        $this->total_fee = $totalFee;
    }

    public function getSpbillCreateIp(): string
    {
        return $this->spbill_create_ip;
    }

    public function setSpbillCreateIp(string $spbillCreateIp): void
    {
        $this->spbill_create_ip = $spbillCreateIp;
    }

    public function getTimeStart(): ?string
    {
        return $this->time_start;
    }

    public function setTimeStart(string $timeStart): void
    {
        $this->time_start = $timeStart;
    }

    public function getTimeExpire(): ?string
    {
        return $this->time_expire;
    }

    public function setTimeExpire(string $timeExpire): void
    {
        $this->time_expire = $timeExpire;
    }

    public function getGoodsTag(): ?string
    {
        return $this->goods_tag;
    }

    public function setGoodsTag(string $goodsTag): void
    {
        $this->goods_tag = $goodsTag;
    }

    public function getLimitPay(): ?string
    {
        return $this->limit_pay;
    }

    public function setLimitPay(string $limitPay): void
    {
        $this->limit_pay = $limitPay;
    }

    public function getReceipt(): ?string
    {
        return $this->receipt;
    }

    public function setReceipt(string $receipt): void
    {
        $this->receipt = $receipt;
    }
}