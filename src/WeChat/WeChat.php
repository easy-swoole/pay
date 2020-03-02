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


use EasySwoole\Pay\WeChat\RequestBean\MiniProgram as MiniProgramRequest;
use EasySwoole\Pay\WeChat\RequestBean\OfficialAccount as OfficialAccountRequest;
use EasySwoole\Pay\WeChat\RequestBean\Scan as ScanRequest;
use EasySwoole\Pay\WeChat\RequestBean\Wap as WapRequest;
use EasySwoole\Pay\WeChat\RequestBean\App as AppRequest;

use EasySwoole\Pay\WeChat\RequestBean\OrderFind as OrderFindRequest;
use EasySwoole\Pay\WeChat\RequestBean\RefundFind as RefundFindRequest;
use EasySwoole\Pay\WeChat\RequestBean\Close as CloseRequest;
use EasySwoole\Pay\WeChat\RequestBean\Refund as RefundRequest;
use EasySwoole\Pay\WeChat\RequestBean\Transfer as TransferRequest;
use EasySwoole\Pay\WeChat\RequestBean\Download as DownloadRequest;
use EasySwoole\Pay\WeChat\RequestBean\DownloadFundFlow as DownloadFundFlowRequest;
use EasySwoole\Pay\WeChat\RequestBean\Comment as CommentRequest;


use EasySwoole\Pay\WeChat\ResponseBean\OfficialAccount as OfficialAccountResponse;
use EasySwoole\Pay\WeChat\ResponseBean\Wap as WapResponse;
use EasySwoole\Pay\WeChat\ResponseBean\Scan as ScanResponse;
use EasySwoole\Pay\WeChat\ResponseBean\MiniProgram  as MiniProgramResponse;
use EasySwoole\Pay\WeChat\ResponseBean\App  as AppResponse;

use EasySwoole\Pay\WeChat\WeChatPay\MiniProgram;
use EasySwoole\Pay\WeChat\WeChatPay\OfficialAccount;
use EasySwoole\Pay\WeChat\WeChatPay\Scan;
use EasySwoole\Pay\WeChat\WeChatPay\Wap;
use EasySwoole\Pay\WeChat\WeChatPay\App;
use EasySwoole\Spl\SplArray;

/**
 * Class WeChat
 * @package EasySwoole\Pay\WeChat
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
     * 公众号支付
     * @param OfficialAccountRequest $bean
     * @return OfficialAccountResponse
     */
    public function officialAccount(OfficialAccountRequest $bean): OfficialAccountResponse
    {
        return (new OfficialAccount($this->config))->pay($bean);
    }

    /**
     * H5支付
     * @param WapRequest $bean
     * @return WapResponse
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function wap(WapRequest $bean): WapResponse
    {
        return (new Wap($this->config))->pay($bean);
    }

    /**
     * 小程序支付
     * @param MiniProgramRequest $bean
     * @return MiniProgramResponse
     */
    public function miniProgram(MiniProgramRequest $bean): MiniProgramResponse
    {
        return (new MiniProgram($this->config))->pay($bean);
    }


    /**
     * app支付
     * @param AppRequest $bean
     * @return AppResponse
     */
    public function app(AppRequest $bean): AppResponse
    {
        return (new App($this->config))->pay($bean);
    }

    /**
     * 扫码支付
     * @param ScanRequest $bean
     * @return ResponseBean\Scan
     */
    public function scan(ScanRequest $bean): ScanResponse
    {
        return (new Scan($this->config))->pay($bean);
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
        return (new Utility($this->config))->requestApi('/pay/orderquery', $bean);
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
        return (new Utility($this->config))->requestApi('/pay/refundquery', $bean);
    }

    /**
     * 关闭订单
     * @param CloseRequest $bean
     * @return SplArray
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function close(CloseRequest $bean): SplArray
    {
        return (new Utility($this->config))->requestApi('/pay/closeorder', $bean);
    }

    /**
     * 申请退款
     * @param RefundRequest $bean
     * @return SplArray
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function refund(RefundRequest $bean): SplArray
    {
        return (new Utility($this->config))->requestApi('/secapi/pay/refund', $bean, true);
    }
    /**
     * 企业打款至微信账户
     * @param  TransferRequest $bean
     * @return SplArray
     * @throws GatewayException
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     */
    public function transfer(TransferRequest $bean): SplArray
    {
        return (new Utility($this->config))->requestApi('/mmpaymkttransfers/promotion/transfers', $bean, true);
    }

    /**
     * 下载对账单
     * @param DownloadRequest $bean
     * @return string
     * @throws GatewayException
     */
    public function download(DownloadRequest $bean): string
    {
        return (new Utility($this->config))->request('/pay/downloadbill', $bean);
    }

    /**
     * 下载资金对账单
     * @param DownloadFundFlowRequest $bean
     * @return string
     * @throws GatewayException
     */
    public function downloadFundFlow(DownloadFundFlowRequest $bean): string
    {
        return (new Utility($this->config))->request('/pay/downloadfundflow', $bean, true);
    }

    /**
     * 拉取订单评价数据(ps:测试未成功)
     * @param CommentRequest $bean
     * @return string
     * @throws GatewayException
     */
    public function comment(CommentRequest $bean): string
    {
        return (new Utility($this->config))->request('/billcommentsp/batchquerycomment', $bean, true);
    }

    /**
     * 结果返回给微信服务器
     * @return string
     */
    public static function success(): string
    {
        return (new SplArray(['return_code' => 'SUCCESS', 'return_msg' => 'OK']))->toXML();
    }

    /**
     * 结果返回给微信服务器
     * @return string
     */
    public static function fail(): string
    {
        return (new SplArray(['return_code' => 'FAIL', 'return_msg' => 'FAIL']))->toXML();
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
        $utility = new Utility($this->config);
        $data = $utility->fromXML($content);
        if ($refund) {
            $decrypt_data = $utility->fromXML($utility->decryptRefundContents($data['req_info']));
            $data = array_merge($decrypt_data, $data);
        }
        if ($refund || $utility->generateSign($data) === $data['sign']) {
            return new SplArray($data);
        }
        throw new InvalidSignException('Wechat Sign Verify FAILED', json_encode($data));
    }
}