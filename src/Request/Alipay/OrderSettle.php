<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\SettleExtendParams;
use EasySwoole\Pay\Beans\Alipay\SubMerchantSettleInfo;

class OrderSettle extends BaseBean
{
    public string $out_request_no;

    public string $trade_no;

    /**
     * @var array
     * 分账用
     */
    public array $royalty_parameters = [];

    public ?string $operator_id;

    public ?SettleExtendParams $extend_params;

    /** @var
     * SubMerchantSettleInfo|null
     * 直付通确认结算用
     */
    public ?SubMerchantSettleInfo $settle_info;
}