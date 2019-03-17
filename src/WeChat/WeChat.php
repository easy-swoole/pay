<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:40
 */

namespace EasySwoole\Pay\WeChat;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidGatewayException;
use EasySwoole\Pay\Exceptions\InvalidSignException;

use EasySwoole\Pay\WeChat\AbstractInterface\WeChatPay;
use EasySwoole\Pay\WeChat\WeChatPay\OfficialAccount;
use EasySwoole\Pay\WeChat\WeChatPay\Wap;

use EasySwoole\Pay\WeChat\RequestBean\OfficialAccount as OfficialAccountRequest;
use EasySwoole\Pay\WeChat\RequestBean\Wap as WapRequest;

use EasySwoole\Pay\WeChat\RequestBean\OrderFind as OrderFindRequest;
use EasySwoole\Pay\WeChat\RequestBean\RefundFind as RefundFindRequest;
use EasySwoole\Pay\WeChat\RequestBean\Close as CloseRequest;
use EasySwoole\Pay\WeChat\RequestBean\Refund as RefundRequest;
use EasySwoole\Pay\WeChat\RequestBean\Download as DownloadRequest;
use EasySwoole\Pay\WeChat\RequestBean\DownloadFundFlow as DownloadFundFlowRequest;
use EasySwoole\Pay\WeChat\RequestBean\Comment as CommentRequest;


use EasySwoole\Pay\WeChat\ResponseBean\OfficialAccount as OfficialAccountResponse;
use EasySwoole\Pay\WeChat\ResponseBean\Wap as WapResponse;
use EasySwoole\Spl\SplArray;
use EasySwoole\Utility\Str;

/**
 * Class WeChat
 * @package EasySwoole\Pay\WeChat
 * @method OfficialAccountResponse officialAccount(OfficialAccountRequest $bean) 公众号支付
 * @method WapResponse wap(WapRequest $bean) H5 支付
 *
 */
class WeChat
{
    private $config;

    function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 支付
     * @param $gateway
     * @param $arguments
     * @return mixed
     * @throws InvalidGatewayException
     */
    public function __call($gateway, $arguments)
    {
        $gateway = get_class($this) . 'Pay\\' . Str::studly($gateway);
        if (class_exists($gateway)) {
            $app = new $gateway($this->config);
            if ($app instanceof WeChatPay) {
                return call_user_func_array([$app, 'pay'], $arguments);
            }
            throw new InvalidGatewayException("Pay Gateway [{$gateway}] Must Be An Instance Of WeChatPayInterface");
        }
        throw new InvalidGatewayException("Pay Gateway [{$gateway}] Not Exists");
    }


    /**
     * 订单查询
     * @param OrderFindRequest $bean
     * @return SplArray
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function orderFind(OrderFindRequest $bean): SplArray
    {
        return $this->config->requestApi($this->config->getGateWay() . '/pay/orderquery', $bean);
    }

    /**
     * 退款查询
     * @param RefundFindRequest $bean
     * @return SplArray
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function refundFind(RefundFindRequest $bean): SplArray
    {
        return $this->config->requestApi($this->config->getGateWay() . '/pay/refundquery', $bean);
    }

    /**
     * 关闭订单
     * @param CloseRequest $bean
     * @return \EasySwoole\Spl\SplArray
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function close(CloseRequest $bean): SplArray
    {
        return $this->config->requestApi($this->config->getGateWay() . '/pay/closeorder', $bean);
    }

    /**
     * 申请退款
     * @param RefundRequest $bean
     * @return \EasySwoole\Spl\SplArray
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function refund(RefundRequest $bean): SplArray
    {
        return $this->config->requestApi($this->config->getGateWay() . '/secapi/pay/refund', $bean, true);
    }

    /**
     * 下载对账单
     * @param DownloadRequest $bean
     * @return string
     * @throws GatewayException
     */
    public function download(DownloadRequest $bean): string
    {
        return $this->config->request($this->config->getGateWay() . '/pay/downloadbill', $bean);
    }

    /**
     * 下载资金对账单
     * @param DownloadFundFlowRequest $bean
     * @return string
     * @throws GatewayException
     */
    public function downloadFundFlow(DownloadFundFlowRequest $bean): string
    {
        return $this->config->request($this->config->getGateWay() . '/pay/downloadfundflow', $bean, true);
    }

    /**
     * 拉取订单评价数据(ps:测试未成功)
     * @param CommentRequest $bean
     * @return string
     * @throws GatewayException
     */
    public function comment(CommentRequest $bean): string
    {
        return $this->config->request($this->config->getGateWay() . '/billcommentsp/batchquerycomment', $bean, true);
    }

    /**
     * 结果返回给微信服务器
     * @return string
     */
    public function success(): string
    {
        return (new SplArray(['return_code' => 'SUCCESS', 'return_msg' => 'OK']))->toXML();
    }

    /**
     * 支付或退款异步通知签名校验
     * @param null $content
     * @param bool $refund
     * @return SplArray
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function verify($content = null, $refund = false): SplArray
    {
        $data = $this->config->fromXML($content);
        if ($refund) {
            $decrypt_data = $this->config->fromXML($this->config->decryptRefundContents($data['req_info']));
            $data = array_merge($decrypt_data, $data);
        }
        if ($refund || $this->config->generateSign($data) === $data['sign']) {
            return new SplArray($data);
        }
        throw new InvalidSignException('Wechat Sign Verify FAILED', $data->__toString());
    }


}