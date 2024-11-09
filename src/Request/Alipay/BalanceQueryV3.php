<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class BalanceQueryV3 extends BaseBean
{
    public string $account_type; //ACCTRANS_ACCOUNT 余额户查询  TRUSTEESHIP_ACCOUNT  托管账户查询

    public ?string $alipay_user_id;

    public ?string $alipay_open_id;
}