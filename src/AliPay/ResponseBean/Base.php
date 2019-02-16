<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:23
 */

namespace EasySwoole\Pay\AliPay\ResponseBean;


use EasySwoole\Spl\SplBean;

class Base extends SplBean
{
    protected $app_id;
    protected $version;
    protected $format;
    protected $sign_type;
    protected $timestamp;
    protected $return_url;
    protected $notify_url;
    protected $charset;
    protected $app_auth_token;
    protected $biz_content;
    protected $sign;
    protected $out_trade_no;
    protected $total_amount;
    protected $subject;
    protected $timeout_express;
    protected $product_code;
    protected $method;
    protected $body;

    public function toArray(array $columns = null, $filter = null): array
    {
        return parent::toArray(null, self::FILTER_NOT_NULL);
    }
}