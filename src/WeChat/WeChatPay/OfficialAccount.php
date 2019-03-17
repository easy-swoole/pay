<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/11
 * Time: 17:54
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\WeChat\AbstractInterface\WeChatPay;
use EasySwoole\Pay\WeChat\RequestBean\PayBase as PayBaseBean;
use \EasySwoole\Pay\WeChat\ResponseBean\OfficialAccount as OfficiaAccountResponse;
use EasySwoole\Pay\WeChat\Utility;

class OfficialAccount extends AbstractPayBase implements WeChatPay
{

    public function pay(PayBaseBean $bean): OfficiaAccountResponse
    {
        $utility = new Utility($this->config);
        $bean->setNotifyUrl($this->config->getNotifyUrl());
        $result = $utility->requestApi($this->getRequestUrl(), $bean);
        $result = [
            'appId' => $this->config->getAppId(),
            'package' => 'prepay_id=' . $result['prepay_id'],
            'signType' => $bean->getSignType()
        ];
        $response = new OfficiaAccountResponse($result);
        $response->setPaySign($utility->generateSign($response->toArray()));
        return $response;
    }

}