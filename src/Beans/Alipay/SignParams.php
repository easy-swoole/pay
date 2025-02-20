<?php

namespace EasySwoole\Pay\Beans\Alipay;

class SignParams extends BaseBean
{
    public string $product_code;

    public string $personal_product_code;

    public string $sign_scene;

    public AccessParams $access_params;

    public ?string $external_agreement_no;

    public ?string $external_logon_id;

    public ?SubMerchant $sub_merchant;

    public ?PeriodRuleParams $period_rule_params;

    public ?string $sign_notify_url;
}
