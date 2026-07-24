<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\GoodsDetail;
use EasySwoole\Pay\Beans\Alipay\PromoParam;

class PreFreezePay extends BaseBean
{
    public string $out_trade_no;

    public string $total_amount;

    public string $subject;

    public string $product_code = 'PREAUTH_PAY';

    public ?string $auth_no;

    /*
     * 【枚举值】
转交易完成后解冻剩余冻结金额: COMPLETE
转交易完成后不解冻剩余冻结金额: NOT_COMPLETE
     */
    public ?string $auth_confirm_mode = 'NOT_COMPLETE';

    /**
     * @var array<GoodsDetail>|null
     */
    public ?array $goods_detail;


    public ?PromoParam $promo_params;


    public ?string $store_id;

    public ?string $terminal_id;

    /**
     * @var array<string>|null
     *
     * 商户通过传递该参数来定制同步需要额外返回的信息字段，数组格式。包括但不限于：["fund_bill_list","voucher_detail_list","enterprise_pay_info","discount_goods_detail","discount_amount","mdiscount_amount"]
     * 【枚举值】
     * 资金明细信息: fund_bill_list
     * 优惠券信息: voucher_detail_list
     * 因公付金额信息: enterprise_pay_info
     * 惠营宝回票金额信息: hyb_amount
     * 商品优惠信息: discount_goods_detail
     * 平台优惠金额: discount_amount
     * 商家优惠金额: mdiscount_amount
     * 收起
     */
    public ?array $query_options;

}