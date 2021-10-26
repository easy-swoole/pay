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
 * Class Micro
 * @package EasySwoole\Pay\WeChat\RequestBean
 */
class Micro extends PayBase
{
    protected $sub_appid;           // 微信分配的公众账号ID
    protected $sub_mch_id;          // 微信支付分配的商户号
    protected $device_info;         // 终端设备号(商户自定义，如门店编号)  选填
    protected $nonce_str;           // 随机字符串	不长于32位
    protected $sign;                // 签名
    protected $sign_type;           // 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5  选填
    protected $body;                // 商品简单描述
    protected $detail;              // 商品详情  选填
    protected $attach;              // 附加数据  选填
    protected $out_trade_no;        // 商户订单号
    protected $total_fee;           // 支付金额单位为分
    protected $fee_type;            // 货币类型  默认人民币  选填
    protected $spbill_create_ip;    // 支持IPV4和IPV6两种格式的IP地址。调用微信支付API的机器IP
    protected $goods_tag;           // 订单优惠标记 选填
    protected $limit_pay;           // 指定支付方式no_credit--指定不能使用信用卡支付 选填
    protected $time_start;          // 交易起始时间	 选填
    protected $time_expire;         // 交易结束时间		 选填
    protected $receipt;             // 电子发票入口开放标识 Y，传入Y时，支付成功消息和支付详情页将出现开票入口		 选填
    protected $auth_code;           // 付款码	扫码支付付款码，设备读取用户微信中的条码或者二维码信息
    protected $profit_sharing;      // 是否需要分账	Y-是，需要分账 N-否，不分账 字母要求大写，不传默认不分账  选填


    /**
     * @return mixed
     */
    public function getSubAppid()
    {
        return $this->sub_appid;
    }

    /**
     * @param mixed $sub_appid
     */
    public function setSubAppId($sub_appid): void
    {
        $this->sub_appid = $sub_appid;
    }

    /**
     * @return mixed
     */
    public function getSubMchId()
    {
        return $this->sub_mch_id;
    }

    /**
     * @param mixed $sub_mch_id
     */
    public function setSubMchId($sub_mch_id): void
    {
        $this->sub_mch_id = $sub_mch_id;
    }

    /**
     * @return mixed
     */
    public function getNonceStr()
    {
        return $this->nonce_str;
    }

    /**
     * @param mixed $nonce_str
     */
    public function setNonceStr($nonce_str): void
    {
        $this->nonce_str = $nonce_str;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * @param mixed $out_trade_no
     */
    public function setOutTradeNo($out_trade_no): void
    {
        $this->out_trade_no = $out_trade_no;
    }

    /**
     * @return mixed
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * @param mixed $total_fee
     */
    public function setTotalFee($total_fee): void
    {
        $this->total_fee = $total_fee;
    }

    /**
     * @return mixed
     */
    public function getSpbillCreateIp()
    {
        return $this->spbill_create_ip;
    }

    /**
     * @param mixed $spbill_create_ip
     */
    public function setSpbillCreateIp($spbill_create_ip): void
    {
        $this->spbill_create_ip = $spbill_create_ip;
    }

    /**
     * @return mixed
     */
    public function getAuthCode() {
        return $this->auth_code;
    }

    /**
     * @param $auth_code
     */
    public function setAuthCode($auth_code) {
        $this->auth_code = $auth_code;
    }
}