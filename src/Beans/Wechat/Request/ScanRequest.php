<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午12:19
 */

namespace EasySwoole\EasyPay\Beans\Wechat\Request;

use EasySwoole\Spl\SplBean;

/**
 * 发起扫码支付参数
 * Class ScanRequest
 * @package EasySwoole\EasyPay\Beans\Wechat\Request
 */
class ScanRequest extends SplBean
{
    protected $body;
    protected $detail;
    protected $attach;
    protected $out_trade_no;
    protected $fee_type;
    protected $total_fee;
    protected $time_start;
    protected $time_expire;
    protected $product_id;
    protected $limit_pay;
    protected $scene_info;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * @param mixed $attach
     */
    public function setAttach($attach): void
    {
        $this->attach = $attach;
    }

    /**
     * @return mixed
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * @param mixed $out_trade_no
     */
    public function setOutTradeNo($out_trade_no): void
    {
        $this->out_trade_no = $out_trade_no;
    }

    /**
     * @return mixed
     */
    public function getFeeType()
    {
        return $this->fee_type;
    }

    /**
     * @param mixed $fee_type
     */
    public function setFeeType($fee_type): void
    {
        $this->fee_type = $fee_type;
    }

    /**
     * @return mixed
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * @param mixed $total_fee
     */
    public function setTotalFee($total_fee): void
    {
        $this->total_fee = $total_fee;
    }

    /**
     * @return mixed
     */
    public function getTimeStart()
    {
        return $this->time_start;
    }

    /**
     * @param mixed $time_start
     */
    public function setTimeStart($time_start): void
    {
        $this->time_start = $time_start;
    }

    /**
     * @return mixed
     */
    public function getTimeExpire()
    {
        return $this->time_expire;
    }

    /**
     * @param mixed $time_expire
     */
    public function setTimeExpire($time_expire): void
    {
        $this->time_expire = $time_expire;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getLimitPay()
    {
        return $this->limit_pay;
    }

    /**
     * @param mixed $limit_pay
     */
    public function setLimitPay($limit_pay): void
    {
        $this->limit_pay = $limit_pay;
    }

    /**
     * @return mixed
     */
    public function getSceneInfo()
    {
        return json_decode($this->scene_info, true);
    }

    /**
     * @param string $id
     * @param string $name
     * @param string $area_code
     * @param string $address
     */
    public function setSceneInfo($id = '', $name = '', $area_code = '', $address = ''): void
    {
        $this->scene_info = json_encode(
            [ 'id' => $id, 'name' => $name, 'area_code' => $area_code, 'address' => $address ]
        );
    }

}