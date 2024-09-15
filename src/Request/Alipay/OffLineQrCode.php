<?php

namespace EasySwoole\Pay\Request\Alipay;

class OffLineQrCode extends PreQrCode
{
    public ?string $product_code = 'QR_CODE_OFFLINE';
}