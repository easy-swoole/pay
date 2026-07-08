<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class BaseRequest extends BaseBean
{
    public string $app_id;

    public string $method;

    public string $format;

    public string $charset;

    public string $sign_type;

    public ?string $sign;

    public string $timestamp;

    public string $version;

    public ?string $notify_url;

    public ?string $return_url;

    public ?string $app_auth_token;
    public ?string $biz_content;

    public ?string $app_cert_sn;

    public ?string $alipay_root_cert_sn;


    /*
        balance  余额,
        moneyFund	余额宝
        coupon	红包
        pcredit	花呗
        pcreditpayInstallment	花呗分期
        creditCard	信用卡
        creditCardExpress	信用卡快捷
        creditCardCartoon	信用卡卡通
        credit_group	信用支付类型（包含信用卡卡通、信用卡快捷、花呗、花呗分期）
        debitCardExpress	借记卡快捷
        mcard	商户预存卡
        pcard	个人预存卡
        promotion	优惠（包含实时优惠+商户优惠）
        voucher	营销券
        point	积分
        mdiscount	商户优惠
        bankPay	网银
        有多个渠道时用“,”分隔
     */
    public ?string $disable_pay_channels;

    public ?string $enable_pay_channels;
}