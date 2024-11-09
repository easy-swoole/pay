<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\Participant;

class Transfer extends BaseBean
{
    public string $out_biz_no;

    public string $trans_amount;

    public string $biz_scene = 'DIRECT_TRANSFER';

    public string $product_code = 'TRANS_ACCOUNT_NO_PWD';

    public string $order_title;

    public Participant $payee_info;

    public ?string $remark;

    public ?string $business_params;
}
