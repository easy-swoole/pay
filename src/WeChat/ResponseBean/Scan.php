<?php
/**
 *
 * Copyright  EasySwoole
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 13:24
 *
 */

namespace EasySwoole\Pay\WeChat\ResponseBean;

class Scan extends Base
{

    protected $prepay_id;
    protected $code_url;
//    protected $result_code;
//    protected $return_code;
//    protected $return_msg;
//    protected $err_code_des;

//    public function setSign(string $sign): void
//    {
//        $this->sign = $sign;
//    }

    public function getPrepayId(): string
    {
        return $this->prepay_id;
    }

    public function getNonceStr(): string
    {
        return $this->nonce_str;
    }

    public function getCodeUrl(): string
    {
        return $this->code_url;
    }
}