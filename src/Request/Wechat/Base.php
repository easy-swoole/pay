<?php

namespace EasySwoole\Pay\Request\Wechat;

use EasySwoole\Spl\SplBean;

class Base extends SplBean
{
    protected $time_expire;
    protected $appid;

    protected $mchid;

    protected $out_trade_no;

    protected $description;

    protected $attach;

    protected $notify_url;

    protected $goods_tag;

    protected $support_fapiao;

    protected $amount;

    protected $detail;

    protected $scene_info;

    protected $settle_info;

    /**
     * @return mixed
     */
    public function getTimeExpire()
    {
        return $this->time_expire;
    }

    /**
     * @param mixed $time_expire
     */
    public function setTimeExpire($time_expire): void
    {
        $this->time_expire = $time_expire;
    }

    /**
     * @return mixed
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @param mixed $appid
     */
    public function setAppid($appid): void
    {
        $this->appid = $appid;
    }

    /**
     * @return mixed
     */
    public function getMchid()
    {
        return $this->mchid;
    }

    /**
     * @param mixed $mchid
     */
    public function setMchid($mchid): void
    {
        $this->mchid = $mchid;
    }

    /**
     * @return mixed
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * @param mixed $out_trade_no
     */
    public function setOutTradeNo($out_trade_no): void
    {
        $this->out_trade_no = $out_trade_no;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * @param mixed $attach
     */
    public function setAttach($attach): void
    {
        $this->attach = $attach;
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * @param mixed $notify_url
     */
    public function setNotifyUrl($notify_url): void
    {
        $this->notify_url = $notify_url;
    }

    /**
     * @return mixed
     */
    public function getGoodsTag()
    {
        return $this->goods_tag;
    }

    /**
     * @param mixed $goods_tag
     */
    public function setGoodsTag($goods_tag): void
    {
        $this->goods_tag = $goods_tag;
    }

    /**
     * @return mixed
     */
    public function getSupportFapiao()
    {
        return $this->support_fapiao;
    }

    /**
     * @param mixed $support_fapiao
     */
    public function setSupportFapiao($support_fapiao): void
    {
        $this->support_fapiao = $support_fapiao;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount(int $amount,string $currency = "CNY"): void
    {
        $this->amount = [
            'total'=>$amount,
            'currency'=>$currency
        ];
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getSceneInfo()
    {
        return $this->scene_info;
    }

    /**
     * @param mixed $scene_info
     */
    public function setSceneInfo($scene_info): void
    {
        $this->scene_info = $scene_info;
    }

    /**
     * @return mixed
     */
    public function getSettleInfo()
    {
        return $this->settle_info;
    }

    /**
     * @param mixed $settle_info
     */
    public function setSettleInfo($settle_info): void
    {
        $this->settle_info = $settle_info;
    }
}