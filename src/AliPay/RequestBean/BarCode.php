<?php


namespace EasySwoole\Pay\AliPay\RequestBean;


class BarCode extends Base
{
    protected $method = 'alipay.trade.pay';
    protected $scene = 'bar_code';
    protected $auth_code;
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

}