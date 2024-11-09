<?php

namespace EasySwoole\Pay\Beans\Alipay;

class Participant extends BaseBean
{
    public string $identity;

    public string $identity_type;//支付宝的会员ID: ALIPAY_USER_ID 支付宝登录号: ALIPAY_LOGON_ID 支付宝openid: ALIPAY_OPEN_ID

    public ?string $cert_no;//当传入cert_type时，必传 参与方的证件号，支持身份证号、护照号。

    public ?string $cert_type; //身份证: IDENTITY_CARD 护照: PASSPORT 当传入cert_no时，必传

    public ?string $name;//当 identity_type=ALIPAY_LOGON_ID 时，本字段必填

}