<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class OfficialAccount extends PayBase
{
    protected $trade_type = 'JSAPI';
    protected $openid;
    protected $scene_info;
    protected $product_id;
    protected $notify_url;

    /**
     * @return mixed
     */
    public function getOpenid(): string
    {
        return $this->openid;
    }

    /**
     * @param mixed $openid
     */
    public function setOpenid(string $openid): void
    {
        $this->openid = $openid;
    }

    public function setSceneInfo(string $sceneInfo): void
    {
        $this->scene_info = $sceneInfo;
    }

    public function getSceneInfo(): ?string
    {
        return $this->scene_info;
    }

    public function setProductId(string $productId): void
    {
        $this->product_id = $productId;
    }

    public function getProductId(): ?string
    {
        return $this->product_id;
    }

    public function setNotifyUrl(string $notify_url): void
    {
        $this->notify_url = $notify_url;
    }

    public function getNotifyUrl(): string
    {
        return $this->notify_url;
    }

}