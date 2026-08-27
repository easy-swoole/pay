<?php

namespace EasySwoole\Pay\Response\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;

class ComplaintInfoQueryResponse extends BaseBean
{
    public int|null $id;

    public string|null $opposite_pid;

    public string|null $opposite_name;

    public string|null $complain_amount;

    public string|null $contact;

    public string|null $gmt_complain;

    public string|null $gmg_process;

    public string|null $gmt_overdue;

    public string|null $complain_content;

    public string|null $trade_no;

    /**
     * @var
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
     * 【示例值】PROCESSING
     */
    public string|null $status;

    /**
     * @var
     * 【描述】投诉单状态枚举值描述，与投诉单状态码一一对应
     */
    public string|null $status_description;

    /**
     * @var
     * 【描述】商家处理投诉结果码
     * 【枚举值】
     * 已联系到用户，协商一致，无异议: CONSENSUS_WITH_CLIENT
     * 其他: ORTHER
     * 不涉及退款，已针对投诉内容进行整改: RECTIFICATION_NO_REFUND
     * 已退款，用户无异议: REFUND
     * 已提交证明材料: SUBMIT_PROOF_NOT_CONTACTED
     */
    public string|null $process_code;


    /**
     * @var
     * 【描述】商家处理结果码对应描述，与结果码一一对应
     */
    public string|null $process_message;

    public string|null $process_remark;

    public string|null $gmt_risk_finish_time;

    /**
     * @var
     * 【描述】商家处理备注图片url列表
     * 【示例值】["http://mdn.alipayobjects.com/security_fraudmng/afts/img/A*wBSNTo3DUhcAAAAAAAAAAAAADsJ2AA/original?t=MVX3nKd-0YVvjEbYtoEDyQAAAABkdsIAAAAA"]
     */
    public array|null $process_img_url_list;


    public array|null $complaint_trade_info_list;


    public string|null $task_id;

    public string|null $upgrade_content;

    public string|null $gmt_upgrade;

    public string|null $gmt_upgrade_risk_finish_time;

    /**
     * @var
     * 【示例值】["高风险", "加急", "平台已介入", "升级投诉"]
     */
    public array|null $label_tag_list;
}