<?php

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\ResponseBean\BarCode as MicroPayResponse;
use EasySwoole\Pay\WeChat\Utility;
use EasySwoole\Spl\SplArray;

class BarCode extends AbstractPayBase
{
    protected function requestPath(): string
    {
        return '/pay/micropay';
    }

    function pay(Base $bean)
    {
        if ($bean->getNotifyUrl() === null) {
            $bean->setNotifyUrl($this->config->getNotifyUrl());
        }
        $utility = new Utility($this->config);

        $result = $utility->request($this->requestPath(), $bean);
        $result = is_array($result) ? $result : $utility->fromXML($result);

        // return_code:通信结果，所以必须是success，否则就是失败的。
        if (!isset($result['return_code']) || $result['return_code'] != 'SUCCESS') {
            throw new GatewayException('Get Wechat API Error:' . ($result['return_msg'] ?? $result['retmsg']) . ($result['err_code_des'] ?? ''), $result, $result['return_code']);
        }
        // 当result_code 为fail时  err_code  为：BANKERROR, SYSTEMERROR, USERPAYING ,可能也是成功的，所以需要返回给调用方
        if ($result['result_code'] == 'FAIL') {
            if (!in_array($result['err_code'], ['BANKERROR', 'SYSTEMERROR', 'USERPAYING'])) {
                throw new GatewayException('Get Wechat API Error:' . ($result['return_msg'] ?? $result['retmsg']) . ($result['err_code_des'] ?? ''), $result, $result['return_code']);
            }
        }
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
