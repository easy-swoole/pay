<?php


namespace EasySwoole\Pay\WeChat\RequestBean;


class BarCode extends PayBase
{
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