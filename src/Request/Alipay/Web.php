<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\ExtendParams;

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

    public ?string $sub_merchant;

    public ?ExtendParams $extend_params;
}