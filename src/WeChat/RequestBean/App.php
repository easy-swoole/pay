<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\WeChat\RequestBean;

/**
 * APP支付
 * Class App
 * @package EasySwoole\Pay\WeChat\RequestBean
 */
class App extends PayBase
{
    protected $trade_type = 'APP'; // 交易类型

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

}