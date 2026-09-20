<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\Participant;
use EasySwoole\Pay\Beans\Alipay\TransferSceneReportInfos;

class Transfer  extends BaseBean
{
    public string $out_biz_no;

    public string $trans_amount;

    public string $biz_scene = 'DIRECT_TRANSFER';

    public string $product_code = 'TRANS_ACCOUNT_NO_PWD';

    public string $order_title;

    public Participant $payee_info;

    public ?string $remark;

    public ?string $business_params;

    /**
     * @var string|null
     * 目前支持以下枚举值：现金营销、企业退款、佣金报酬、业务结算、二手回收、公益补助、行政补贴和退款、保险理赔
     * 注意：26年及以后新接入商户必须传入该字段。
     */
    public ?string $transfer_scene_name;

    /**
     * @var array<TransferSceneReportInfos>|null
     */
    public array|null $transfer_scene_report_infos;
}