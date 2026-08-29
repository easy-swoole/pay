<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class BillTransferLogQuery extends BaseBean
{
    public string $code;

    public string $msg;

    public array $detail_list = [];

    public int $page_no;

    public int $page_size;

    public int $total_size;
}