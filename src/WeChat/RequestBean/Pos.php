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

/**
 * 付款码支付
 * Class Pos
 * @package EasySwoole\Pay\WeChat\RequestBean
 */
class Pos extends PayBase
{
    protected $trade_type = 'MICROPAY';

    protected $auth_code;  // 授权码
    protected $scene_info; // + 场景信息
    // protected $id;            // - 门店id
    // protected $name;          // - 门店名称
    // protected $area_code;     // - 门店行政区划码
    // protected $address;       // - 门店详细地址

    /**
     * @return mixed
     */
    public function getAuthCode()
    {
        return $this->auth_code;
    }

    /**
     * @param mixed $auth_code
     */
    public function setAuthCode($auth_code): void
    {
        $this->auth_code = $auth_code;
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