<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class QueryComplaint extends BaseBean
{
    public int $current_page_num = 1;

    public int $page_size = 10;

    public string|null $gmt_complaint_start = null;

    public string|null $gmt_complaint_end = null;


    public string|null $out_trade_no = null;

    /**
     * @var string|null
     * 【枚举值】
     * 用户撤诉: DROP_COMPLAIN
     * 超时后用户撤诉: DROP_OVERDUE_COMPLAIN
     * 超时处理完成用户撤诉: DROP_OVERDUE_PROCESSED
     * 处理完成用户撤诉: DROP_PROCESSED
     * 超时未处理: OVERDUE
     * 超时处理完成: OVERDUE_PROCESSED
     * 部分超时未处理: PART_OVERDUE
     * 处理完成: PROCESSED
     * 处理中: PROCESSING
     * 待处理: WAIT_PROCESS
     * 收起
     * 【示例值】["DROP_COMPLAIN","OVERDUE","WAIT_PROCESS"]
     */
    public string|null $status_list = null;

    public string|null $gmt_process_start = null;

    public string|null $gmt_process_end = null;

    public string|null $task_id = null;

    /**
     * @var string|null
     * 【示例值】["10243351927","10243351912","10243351234"]
     */
    public string|null $task_id_list = null;

    public bool|null $upgrade = null;

    public bool|null $high_risk_tag = null;
}