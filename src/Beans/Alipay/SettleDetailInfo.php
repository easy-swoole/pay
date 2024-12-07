<?php

namespace EasySwoole\Pay\Beans\Alipay;

class SettleDetailInfo extends BaseBean
{

    /**
     * @var string
     * 【枚举值】
     * 支付宝账号对应的支付宝唯一用户号: userId
     * 结算收款方的银行卡编号: cardAliasNo
     * 支付宝登录号: loginName
     * 结算到商户进件时设置的默认结算账号: defaultSettle
     * 收起
     * 【注意事项】结算主体为门店时不支持传defaultSettle
     */
    public string $trans_in_type;

    /**
     * @var string|null
     * 【描述】结算收款方。当结算收款方类型是cardAliasNo时，本参数为用户在支付宝绑定的卡编号；
     *  结算收款方类型是userId时，本参数为用户的支付宝账号对应的支付宝唯一用户号，以2088开头的纯16位数字；
     *  当结算收款方类型是loginName时，本参数为用户的支付宝登录号；
     *  当结算收款方类型是defaultSettle时，本参数不能传值，保持为空。
     */
    public ?string $trans_in;

    public string $amount;

    public ?string $summary_dimension;

    public ?string $settle_entity_id;

    /**
     * @var string|null
     * 【枚举值】
     * 二级商户: SecondMerchant
     * 商户或者直连商户门店: Store
     */
    public ?string $settle_entity_type;


    /**
     * @var string|null
     * 【描述】仅在直付通账期模式下，当一笔交易需要分多次发起部分确认结算时使用，表示本次确认结算的实际结算金额。传递本字段后，原amount字段不再生效，结算金额以本字段为准。如已经发生过部分确认结算、不传递本字段则默认按剩余待结算金额一次性结算。
     */
    public ?string $actual_amount;

}