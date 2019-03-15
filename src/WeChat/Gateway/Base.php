<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/11
 * Time: 17:54
 */

namespace EasySwoole\Pay\WeChat\Gateway;


use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\Exceptions\NetworkErrorException;
use EasySwoole\Pay\WeChat\Config;

class Base
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }


    /**
     * 请求
     * @param array $data
     * @param bool $userCert
     * @return array
     * @throws InvalidSignException
     * @throws \EasySwoole\Pay\Exceptions\GatewayException
     */
    protected function requestApi(array $data, bool $userCert = false): array
    {
        $result = $this->config->requestApi($this->config->getGateWay() . '/' . static::REQUEST_URL, $data, $userCert);
        $this->checkSign($result);
        return $result;
    }

    /**
     * 验证签名
     * @param array $result
     * @return bool
     * @throws InvalidSignException
     */
    public function checkSign(array $result): bool
    {
        //验证签名
        if (!$this->isSignSet($result)) {
            throw new InvalidSignException("签名错误！");
        }
        $sign = $this->config->generateSign($result);
        if ($result['sign'] == $sign) {
            //签名正确
            return true;
        }
        throw new InvalidSignException("签名错误！");
    }

    /**
     * 检测签名
     * @param array $result
     * @return bool
     */
    public function isSignSet(array $result): bool
    {
        return array_key_exists('sign', $result);
    }

}