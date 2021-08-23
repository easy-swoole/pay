<?php
/**
 * 发送现金红包
 * Copyright  EasySwoole
 * User: kyour-cn
 * Date: 2021-08-12
 * Time: 21:29
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class RedPack extends Base
{
    /**
     * 商户订单号
     * @var string
     */
    protected $mch_billno;
    /**
     * 商户名称
     * @var string
     */
    protected $send_name;
    /**
     * 红包金额（单位分）
     * @var int
     */
    protected $total_amount;
    /**
     * 用户openid
     * @var string
     */
    protected $re_openid;
    /**
     * 红包发放总人数
     * @var int
     */
    protected $total_num;
    /**
     * 祝福语
     * @var string
     */
    protected $wishing;
    /**
     * 活动名称
     * @var string
     */
    protected $act_name;
    /**
     * 备注
     * @var string
     */
    protected $remark;

    /**
     * 公众账号appid
     * @var string
     */
    protected $wxappid;

    /**
     * 客户端IP
     * @var string
     */
    protected $client_ip;

    /**
     * @return string
     */
    public function getWxappid(): string
    {
        return $this->mch_billno;
    }

    /**
     * @param string $wxappid
     */
    public function setWxappid(string $wxappid): void
    {
        $this->wxappid = $wxappid;
    }

    /**
     * @return string
     */
    public function getMchBillno(): string
    {
        return $this->mch_billno;
    }

    /**
     * @param string $mch_billno
     */
    public function setMchBillno(string $mch_billno): void
    {
        $this->mch_billno = $mch_billno;
    }

    /**
     * @return string
     */
    public function getSendName(): string
    {
        return $this->send_name;
    }

    /**
     * @param string $send_name
     */
    public function setSendName(string $send_name): void
    {
        $this->send_name = $send_name;
    }

    /**
     * @return string
     */
    public function getTotalAmount(): string
    {
        return $this->total_amount;
    }

    /**
     * @param int $total_amount
     */
    public function setTotalAmount(int $total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    /**
     * @return string
     */
    public function getReOpenid(): string
    {
        return $this->re_openid;
    }

    /**
     * @param string $re_openid
     */
    public function setReOpenid(string $re_openid): void
    {
        $this->re_openid = $re_openid;
    }

    /**
     * @return string
     */
    public function getTotalNum(): string
    {
        return $this->total_num;
    }

    /**
     * @param int $total_num
     */
    public function setTotalNum(int $total_num): void
    {
        $this->total_num = $total_num;
    }

    /**
     * @return string
     */
    public function getWishing(): string
    {
        return $this->wishing;
    }

    /**
     * @param string $wishing
     */
    public function setWishing(string $wishing): void
    {
        $this->wishing = $wishing;
    }

    /**
     * @return string
     */
    public function getActName(): string
    {
        return $this->act_name;
    }

    /**
     * @param string $act_name
     */
    public function setActName(string $act_name): void
    {
        $this->act_name = $act_name;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     */
    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->client_ip;
    }

    /**
     * @param string client_ip
     */
    public function setClientIp(string $client_ip): void
    {
        $this->client_ip = $client_ip;
    }
}
