<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/11
 * Time: 17:54
 */

namespace EasySwoole\Pay\WeChat\Gateway;

use EasySwoole\Pay\WeChat\RequestBean\OfficialAccount;
use \EasySwoole\Pay\WeChat\ResponseBean\OfficialAccount as OfficiaAccountResponse;

class OfficiaAccount extends PayBase
{

    public function pay(OfficialAccount $officialAccount): OfficiaAccountResponse
    {
        $officialAccount->setNotifyUrl($this->config->getNotifyUrl());
        $result = $this->config->requestApi($this->getRequestUrl(), $officialAccount);
        $result = [
            'appId' => $this->config->getAppId(),
            'package' => 'prepay_id=' . $result['prepay_id'],
            'signType' => $officialAccount->getSignType()
        ];
        $response = new OfficiaAccountResponse($result);
        $response->setPaySign($this->config->generateSign($response->toArray()));
        return $response;
    }

}