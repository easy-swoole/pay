<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 11:11
 */

namespace EasySwoole\Pay\WeChat\ResponseBean;


class NativeResponse extends Base
{
    protected $prepay_id;
    protected $result_code;
    protected $return_msg;
    protected $return_code;
    protected $err_code_des;

    public function setSign(string $sign): void
    {
        $this->sign = $sign;
    }

    public function initialize(): void
    {
        if (empty($this->return_code)) {
            $this->return_code = 'SUCCESS';
        }
        if (empty($this->result_code)) {
            $this->result_code = 'SUCCESS';
        }
    }
}