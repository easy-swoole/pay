<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class QueryComplaint extends BaseBean
{
    public int $total_size;

    public int $current_page;

    public int $page_size;

    public array $complaint_list = [];
}