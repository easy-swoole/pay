<?php

namespace EasySwoole\Pay\Request\Wechat;

use EasySwoole\Pay\Beans\Wechat\Amount;
use EasySwoole\Pay\Beans\Wechat\BaseBean;
use EasySwoole\Pay\Beans\Wechat\OrderDetail;
use EasySwoole\Pay\Beans\Wechat\SettleInfo;

class BaseRequest extends BaseBean
{

    public string $appid;

    public string $mchid;

    public string $description;

    public string $out_trade_no;

    public ?string $time_expire;

    public ?string $attach;

    public string $notify_url;

    public ?string $goods_tag;

    public ?bool $support_fapiao;

    public Amount $amount;

    public ?OrderDetail $detail;

    public ?SettleInfo $settle_info;

    protected function initialize():void
    {
        if(empty($this->amount)){
            $this->amount = new Amount();
        }
    }
}