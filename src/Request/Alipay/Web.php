<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\ExtendParams;
use EasySwoole\Pay\Beans\Alipay\SubMerchant;
use EasySwoole\Pay\Beans\Alipay\SubMerchantSettleInfo;

class Web extends BaseBean
{
    public string $out_trade_no;

    public string $total_amount;

    public string $subject;

    public string $product_code = 'FAST_INSTANT_TRADE_PAY';

    public ?string $qr_pay_mode;

    public ?int $qrcode_width;

    public ?array $goods_detail = null;

    public ?string $time_expire;

    public ?ExtendParams $extend_params;

    public ?string $seller_id;//支付宝子账号ID

    public ?string $return_url;

    public ?string $notify_url;

    public ?SubMerchant $sub_merchant;

    public ?SubMerchantSettleInfo $settle_info;
}