<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/18
 * Time: 11:55
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class Biz extends Base
{
    protected $time_stamp;
    protected $product_id;

    public function setTimeStamp(string $timeStamp): void
    {
        $this->time_stamp = $timeStamp;
    }

    public function getTimeStamp(): string
    {
        return $this->time_stamp;
    }

    public function setProductId(string $productId): void
    {
        $this->product_id = $productId;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }
}