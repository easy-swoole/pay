<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\SubMerchant;
use EasySwoole\Pay\Beans\Alipay\SubMerchantSettleInfo;

class SubMerchantSettleConfirm extends BaseBean
{
    public string $out_request_no;

    public string $trade_no;

    public SubMerchantSettleInfo $settle_info;
}