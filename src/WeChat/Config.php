<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:40
 */

namespace EasySwoole\Pay\WeChat;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\Utility\NewWork;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Spl\SplArray;
use EasySwoole\Spl\SplBean;

class Config extends SplBean
{
    /**
     * @var string
     */
    protected $appid; // APP APPID 公众号 APPID 或者小程序ID

    /**
     * @var string
     */
    protected $miniAppId;  // 小程序 APPID
    /**
     * @var string
     */
    protected $mchId;
    /**
     * @var string
     */
    protected $key;
    /**
     * @var string
     */
    protected $notifyUrl;
    /**
     * @var string
     */
    protected $certClient; // optional，退款等情况时用到
    /**
     * @var string
     */
    protected $certKey; // optional，退款等情况时用到

    protected $signType;//签名方式

    protected $gateWay = GateWay::NORMAL;//SANDBOX

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appid;
    }

    /**
     * @param string $appid
     */
    public function setAppId(string $appid): void
    {
        $this->appid = $appid;
    }


    /**
     * @return string
     */
    public function getMiniAppId(): string
    {
        return $this->miniAppId;
    }

    /**
     * @param string $miniAppId
     */
    public function setMiniAppId(string $miniAppId): void
    {
        $this->miniAppId = $miniAppId;
    }

    /**
     * @return string
     */
    public function getMchId(): string
    {
        return $this->mchId;
    }

    /**
     * @param string $mchId
     */
    public function setMchId(string $mchId): void
    {
        $this->mchId = $mchId;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     */
    public function setNotifyUrl(string $notifyUrl): void
    {
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * @return string
     */
    public function getCertClient(): string
    {
        return $this->certClient;
    }

    /**
     * @param string $certClient
     */
    public function setCertClient(string $certClient): void
    {
        $this->certClient = $certClient;
    }

    /**
     * @return string
     */
    public function getCertKey(): string
    {
        return $this->certKey;
    }

    /**
     * @param string $certKey
     */
    public function setCertKey(string $certKey): void
    {
        $this->certKey = $certKey;
    }

    /**
     * @return string
     */
    public function getGateWay(): string
    {
        return $this->gateWay;
    }

    /**
     * @param string $gateWay
     */
    public function setGateWay(string $gateWay): void
    {
        $this->gateWay = $gateWay;
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
                $string = hash_hmac('sha256', $this->getSignContent($data) . '&key=' . $this->getKey(), $this->getKey());
                break;
            default:
                $string = md5($this->getSignContent($data) . '&key=' . $this->getKey());
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
        $buff = '';
        foreach ($data as $k => $v) {
            $buff .= ($k != 'sign' && $v != '' && !is_array($v)) ? $k . '=' . $v . '&' : '';
        }
        return trim($buff, '&');
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
        $bean->setAppId($this->getAppId());
        $bean->setMchId($this->getMchId());
        $bean->setSign($this->generateSign($bean->toArray()));
        $response = NewWork::postXML($endpoint, (new SplArray($bean->toArray()))->toXML(), $useCert ? [
            'ssl_cert_file' => $this->getCertClient(),
            'ssl_key_file' => $this->getCertKey()]
            : []);
        if ($response->getStatusCode() == 200) {
            return $response->getBody();
        }
        throw new GatewayException('Get Wechat API Error url:' . $endpoint . ' params:' . $bean->__toString(), 20000);
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
            md5($this->getKey()),
            OPENSSL_RAW_DATA
        );
    }
}