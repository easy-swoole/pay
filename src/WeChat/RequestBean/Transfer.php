<?php
/**
 *
 * Copyright  EasySwoole
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 13:24
 *
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class Transfer extends Base
{

    /**
     * @var string
     */
    protected $partner_trade_no;   //商户订单号
    /**
     * @var string
     */
    protected $openid;  //收款人的openid
    /**
     * @var string
     */
    protected $check_name;  //NO_CHECK：不校验真实姓名\FORCE_CHECK：强校验真实姓名
    /**
     * @var string
     */
    protected $re_user_name;  //check_name为 FORCE_CHECK 校验实名的时候必须提交
    /**
     * @var string
     */
    protected $amount;  //企业付款金额，单位为分
    /**
     * @var string
     */
    protected $desc; //企业付款金额，单位为分
    /**
     * @var string
     */
    protected $spbill_create_ip; //IP地址

    public function getPartnerTradeNo(): string
    {
        return $this->partner_trade_no;
    }

    public function setPartnerTradeNo(string $PartnerTradeNo): void
    {
        $this->partner_trade_no = $PartnerTradeNo;
    }

    public function getOpenid(): string
    {
        return $this->openid;
    }

    public function setOpenid(string $Openid): void
    {
        $this->openid = $Openid;
    }
    public function getCheckName(): string
    {
        return $this->check_name;
    }

    public function setCheckName(string $CheckName): void
    {
        $this->check_name = $CheckName;
    }
    public function getReUserName(): string
    {
        return $this->re_user_name;
    }

    public function setReUserName(string $ReUserName): void
    {
        $this->re_user_name = $ReUserName;
    }
    public function getAmount():int
    {
        return $this->amount;
    }

    public function setAmount(int $Amount): void
    {
        $this->amount = $Amount;
    }
    public function getDesc():string
    {
        return $this->desc;
    }

    public function setDesc(string $Desc): void
    {
        $this->desc = $Desc;
    }
    public function getSpbillCreateIp():string
    {
        return $this->desc;
    }

    public function setSpbillCreateIp(string $SpbillCreateIp): void
    {
        $this->spbill_create_ip = $SpbillCreateIp;
    }

}