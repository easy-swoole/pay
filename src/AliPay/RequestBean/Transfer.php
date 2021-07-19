<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

/**
 * Class Transfer
 * package EasySwoole\Pay\AliPay\RequestBean
 *
 * doc link: https://opendocs.alipay.com/apis/api_28/alipay.fund.trans.uni.transfer
 */
class Transfer extends Base
{
    protected $method = 'alipay.fund.trans.uni.transfer';
    /**
     * @var string
     */
    protected $out_biz_no;

    /**
     * @var string
     */
    protected $trans_amount;

    /**
     * @var string
     */
    protected $product_code;

    /**
     * @var string
     */
    protected $biz_scene;

    /**
     * @var string
     */
    protected $order_title;

    /**
     * @var string
     */
    protected $original_order_id;

    /**
     * @var array
     */
    protected $payee_info;

    /**
     * @var string
     */
    protected $remark;

    /**
     * @var string
     */
    protected $business_params;

    /**
     * @var array
     */
    protected $sign_data;

    /**
     * @return string
     */
    public function getOutBizNo(): string
    {
        return $this->out_biz_no;
    }

    /**
     * @param string $out_biz_no
     */
    public function setOutBizNo(string $out_biz_no): void
    {
        $this->out_biz_no = $out_biz_no;
    }

    /**
     * @return string
     */
    public function getTransAmount(): string
    {
        return $this->trans_amount;
    }

    /**
     * @param string $trans_amount
     */
    public function setTransAmount(string $trans_amount): void
    {
        $this->trans_amount = $trans_amount;
    }

    /**
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->product_code;
    }

    /**
     * @param string $product_code
     */
    public function setProductCode(string $product_code): void
    {
        $this->product_code = $product_code;
    }

    /**
     * @return string
     */
    public function getBizScene(): string
    {
        return $this->biz_scene;
    }

    /**
     * @param string $biz_scene
     */
    public function setBizScene(string $biz_scene): void
    {
        $this->biz_scene = $biz_scene;
    }

    /**
     * @return string
     */
    public function getOrderTitle(): string
    {
        return $this->order_title;
    }

    /**
     * @param string $order_title
     */
    public function setOrderTitle(string $order_title): void
    {
        $this->order_title = $order_title;
    }

    /**
     * @return string
     */
    public function getOriginalOrderId(): string
    {
        return $this->original_order_id;
    }

    /**
     * @param string $original_order_id
     */
    public function setOriginalOrderId(string $original_order_id): void
    {
        $this->original_order_id = $original_order_id;
    }

    /**
     * @return array
     */
    public function getPayeeInfo(): array
    {
        return $this->payee_info;
    }

    /**
     * @param array $payee_info
     */
    public function setPayeeInfo(array $payee_info): void
    {
        $this->payee_info = $payee_info;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     */
    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return string
     */
    public function getBusinessParams(): string
    {
        return $this->business_params;
    }

    /**
     * @param string $business_params
     */
    public function setBusinessParams(string $business_params): void
    {
        $this->business_params = $business_params;
    }

    /**
     * @return array
     */
    public function getSignData(): array
    {
        return $this->sign_data;
    }

    /**
     * @param array $sign_data
     */
    public function setSignData(array $sign_data): void
    {
        $this->sign_data = $sign_data;
    }
}