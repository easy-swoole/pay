<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\WeChat\RequestBean;

/**
 * JSAPI公众号支付
 * Class OfficialAccount
 * @package EasySwoole\Pay\WeChat\RequestBean
 */
class OfficialAccount extends PayBase
{
    protected $trade_type = 'JSAPI';   // 交易类型

    protected $product_id;   // 商品ID
    protected $openid;       // 用户标识
    protected $scene_info;   // + 场景信息
    // protected $id;              // - 门店id
    // protected $name;            // - 门店名称
    // protected $area_code;       // - 门店行政区划码
    // protected $address;         // - 门店详细地址


    /**
     * @return string
     */
    public function getTradeType(): string
    {
        return $this->trade_type;
    }

    /**
     * @param string $trade_type
     */
    public function setTradeType(string $trade_type): void
    {
        $this->trade_type = $trade_type;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * @param mixed $openid
     */
    public function setOpenid($openid): void
    {
        $this->openid = $openid;
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

}