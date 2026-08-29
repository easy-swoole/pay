<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class BillTransferQuery extends BaseBean
{
    public string $start_time;//【示例值】2019-01-01 00:00:00

    public string $end_time;//【示例值】2019-01-01 00:00:00

    public string $type;//描述】转账类型：充值-DEPOSIT，提现-WITHDRAW，转账-TRANSFER。

    public string|null $page_no;

    public int|null $page_size;


}