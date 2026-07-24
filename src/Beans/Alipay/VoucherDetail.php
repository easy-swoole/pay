<?php

namespace EasySwoole\Pay\Beans\Alipay;

class VoucherDetail extends BaseBean
{
    public string $id;

    public string $name;

    /**
     * @var string
     * 【枚举值】
     * 全场代金券: ALIPAY_FIX_VOUCHER
     * 折扣券: ALIPAY_DISCOUNT_VOUCHER
     * 单品优惠券: ALIPAY_ITEM_VOUCHER
     * 现金抵价券: ALIPAY_CASH_VOUCHER
     * 商家全场券: ALIPAY_BIZ_VOUCHER
     */
    public string $type;

    public string $amount;


    public ?string $merchant_contribute;

    public ?string $other_contribute;

    public ?string $memo;

    public ?string $template_id;


    public ?string $purchase_buyer_contribute;

    public ?string $purchase_merchant_contribute;

    public ?string $purchase_ant_contribute;

}