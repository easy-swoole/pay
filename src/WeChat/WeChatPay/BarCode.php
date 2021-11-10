<?php


namespace EasySwoole\Pay\WeChat\WeChatPay;


use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\ResponseBean\BarCode as MicroPayResponse;
use EasySwoole\Pay\WeChat\Utility;

class BarCode extends AbstractPayBase
{
    protected function requestPath(): string
    {
        return '/pay/micropay';
    }
    function pay(Base $bean)
    {
        if ($bean->getNotifyUrl()===null){
            $bean->setNotifyUrl( $this->config->getNotifyUrl() );
        }
        $utility      = new Utility( $this->config );

        $result       = $utility->request( $this->requestPath(), $bean );
        $result = is_array($result) ? $result : $utility->fromXML($result);
        if ((isset($result['return_code']) && $result['return_code'] == 'SUCCESS') && isset($result['err_code']) && $result['result_code'] == 'FAIL') {
            // 以下情况 可能已经支付成功了,所以需要返回给调用者
            if (in_array($result['err_code'], ['BANKERROR', 'SYSTEMERROR', 'USERPAYING'])) {
                // 这里为了兼容微信的一个BUG，用请求的sign_type代替响应值里的sign_type
                if (!isset($result['sign_type']) && $bean->getSignType() != null) {
                    $result['sign_type'] = $bean->getSignType();
                }
                if ($utility->generateSign($result) === $result['sign']) {
                    $resultArray = new SplArray($result);
                    return new MicroPayResponse($resultArray->getArrayCopy());
                }
                throw new InvalidSignException('sign is error');
            }
        }
        if (!isset($result['return_code']) || $result['return_code'] != 'SUCCESS' || $result['result_code'] != 'SUCCESS') {
            throw new GatewayException('Get Wechat API Error:' . ($result['return_msg'] ?? $result['retmsg']) . ($result['err_code_des'] ?? ''),$result,$result['return_code']);
        }
    }
}
