<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class TransferBillQuery extends BaseBean
{
    public string $start_time;//2019-01-01 00:00:00

    public string $end_time;//2019-01-01 00:00:00

    public string $type = 'TRANSFER';//DEPOSIT  WITHDRAW TRANSFER

    public int $page_size = 100;


}