<?php

namespace EasySwoole\Pay\Beans\Alipay;

class RoyaltyEntity extends BaseBean
{
    /**
     * @var string|null 分账接收方真实姓名。
     * 绑定分账关系时： 当分账方类型是userId时，本参数可以不传，若上传则进行校验不上传不会校验。
     * 当分账方类型是loginName时，本参数必传。
     * 解绑分账关系时：作为请求参数可不填，分账关系查询时不作为返回结果返回
     */
    public ?string $name;

    /** @var string|null loginName|userId|openId */
    public ?string $type;

    /** @var string|null
     *分账接收方账号。 当分账方类型是userId时，本参数为用户的支付宝账号对应的支付宝唯一用户号，以2088开头的纯16位数字；
     * 当分账方类型是loginName时，本参数为用户的支付宝登录号；当分账方类型是openId时，本参数传递支付宝openId信息。
     */
    public ?string $account;

    public ?string $account_open_id;

    public ?string $memo;

    public ?string $login_name;

    public ?string $bind_login_name;
}