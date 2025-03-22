<?php

namespace EasySwoole\Pay\Beans\Alipay;

/**
 * 直付通用
 */
class SubMerchantSettleInfo extends BaseBean
{

    /**
     * @var array<SubMerchantSettleDetailInfo>
     */
    public array $settle_detail_infos;

    public ?string $settle_period_time; //1d 2d 3d
}