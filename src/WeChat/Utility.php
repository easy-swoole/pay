<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-03-17
 * Time: 21:14
 */

namespace EasySwoole\Pay\WeChat;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\Utility\NewWork;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Spl\SplArray;


class Utility
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 生成签名
     * @param array $data
     * @return string
     */
    public function generateSign(array $data): string
    {
        ksort($data);
        $signType = isset($data['sign_type']) ? $data['sign_type'] : 'MD5';
        switch ($signType) {
            case 'HMAC-SHA256':
                $string = hash_hmac('sha256', $this->getSignContent($data) . '&key=' . $this->config->getKey(), $this->config->getKey());
                break;
            default:
                $string = md5($this->getSignContent($data) . '&key=' . $this->config->getKey());
        }
        return strtoupper($string);
    }

    /**
     * 组成签名内容
     * @param array $data
     * @return string
     */
    private function getSignContent(array $data): string
    {
        unset($data['sign']);
        return  urldecode(http_build_query($data));
        /*
         $buff = '';
         foreach ($data as $k => $v) {
             $buff .= ($k != 'sign' && $v != '' && !is_array($v)) ? $k . '=' . $v . '&' : '';
         }
         return trim($buff, '&');
        */
    }

    /**
     * 请求返回数组
     * @param string $endpoint
     * @param Base $bean
     * @param bool $useCert
     * @return SplArray
     * @throws GatewayException
     * @throws InvalidArgumentException
     * @throws InvalidSignException
     */
    public function requestApi(string $endpoint, Base $bean, bool $useCert = false): SplArray
    {
        $result = $this->request($endpoint, $bean, $useCert);

        $result = is_array($result) ? $result : $this->fromXML($result);

        if (!isset($result['return_code']) || $result['return_code'] != 'SUCCESS' || $result['result_code'] != 'SUCCESS') {
            throw new GatewayException('Get Wechat API Error:' . ($result['return_msg'] ?? $result['retmsg']) . ($result['err_code_des'] ?? ''), 20000);
        }
        if (strpos($endpoint, 'mmpaymkttransfers') !== false || $this->generateSign($result) === $result['sign']) {
            return new SplArray($result);
        }
        throw new InvalidSignException('sign is error');
    }

    /**
     * 请求返回原生字符串
     * @param string $endpoint
     * @param Base $bean
     * @param bool $useCert
     * @return string
     * @throws GatewayException
     */
    public function request(string $endpoint, Base $bean, bool $useCert = false): string
    {
        if($endpoint==='/mmpaymkttransfers/promotion/transfers'){ //企业付款需要商家号mch_appid
            $bean->setMchAppId($this->config->getMchAppId());// 商家appid mch_appid
            $bean->setTransferMchId($this->config->getMchId());      // 商家号mchid
        }else{  //非企业付款
            $bean->setAppId($bean instanceof \EasySwoole\Pay\WeChat\RequestBean\MiniProgram ? $this->config->getMiniAppId() : $this->config->getAppId());
            $bean->setMchId($this->config->getMchId()); // 商家号mch_id
        }
        $bean->setSign($this->generateSign($bean->toArray()));
        $xml = (new SplArray($bean->toArray()))->toXML(true);
        $response = NewWork::postXML($this->config->getGateWay() . $endpoint,$xml , $useCert ? [
            'ssl_cert_file' => $this->config->getApiClientCert(),
            'ssl_key_file' => $this->config->getApiClientKey()]
            : []);
        if ($response->getStatusCode() == 200) {
            return $response->getBody();
        }
        throw new GatewayException('Get Wechat API Error url:' . $this->config->getGateWay() . $endpoint . ' params:' . $bean->__toString(), 20000);
    }

    /**
     * XML转化为array
     * @param $xml
     * @return array
     * @throws InvalidArgumentException
     */
    public function fromXML($xml): array
    {
        if (!$xml) {
            throw new InvalidArgumentException('Convert To Array Error! Invalid Xml!');
        }
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    /**
     * 退款解密
     * @param $contents
     * @return string
     */
    public function decryptRefundContents($contents)
    {
        return openssl_decrypt(
            base64_decode($contents),
            'AES-256-ECB',
            md5($this->config->getKey()),
            OPENSSL_RAW_DATA
        );
    }
}