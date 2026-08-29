<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class RefundQuery extends BaseBean
{
    /**
     * @var string
     * 【描述】退款请求号。请求退款接口时，传入的退款请求号，如果在退款请求时未传入，则该值为创建交易时的商户订单号。
     */
    public string $out_request_no;

    public string|null $trade_no;

    public string|null $out_trade_no;

    /**
     * @var array|null
     * 【描述】查询选项，商户通过上送该参数来定制同步需要额外返回的信息字段，数组格式。枚举支持： refund_detail_item_list：本次退款使用的资金渠道； gmt_refund_pay：退款执行成功的时间； deposit_back_info：银行卡冲退信息；
     * 【枚举值】
     * 本次退款使用的资金渠道: refund_detail_item_list
     * 退款执行成功的时间: gmt_refund_pay
     * 银行卡冲退信息: deposit_back_info
     * 本次交易使用的券信息: refund_voucher_detail_list
     * 收起
     * 【示例值】["refund_detail_item_list"]
     */
    public array|null $query_options = [];
}