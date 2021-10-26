<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/28
 * Time: 18:15
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidConfigException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\RequestBean\PayBase;
use EasySwoole\Pay\WeChat\ResponseBean\Micro as MicroResponse;
use EasySwoole\Pay\WeChat\Utility;

class Micro extends AbstractPayBase
{
    /**
     * 付款码支付
     * @param PayBase $bean 这里实际上会给入对应支付方法的Bean
     * @return MiniProgramResponse
     * @throws GatewayException
     * @throws InvalidArgumentException
     * @throws InvalidSignException
     */
    public function pay(Base $bean): MicroResponse
    {
        $appId = $bean->getAppid() ?: $this->config->getAppId();

        if (!$appId) {
            throw new InvalidConfigException('appId not exist');
        }

        $utility = new Utility($this->config);
        $sign = $utility->generateSign($bean->toArray());
        $bean->setSign($sign);

        $result = $utility->requestApi($this->requestPath(), $bean);
        return new MicroResponse((array)$result);
    }

    /**
     * 设置支付路径
     * @return string
     */
    public function requestPath(): string
    {
        return '/pay/micropay';
    }
}