<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Spl\SplBean;

class WechatConfig extends SplBean
{
    /**
     * 商户 API 证书，支持传入 apiclient_cert.pem 文件路径或证书内容。
     * 商户号和商户证书序列号会从该证书中自动解析。
     */
    protected string $mch_api_client_cert;

    /**
     * 商户 API 私钥，支持传入 apiclient_key.pem 文件路径或私钥内容，用于请求签名。
     */
    protected string $mch_api_client_key;

    /**
     * 商户 API 证书序列号，从商户 API 证书中自动解析。
     */
    protected string $mch_cert_serial_no;

    /**
     * 微信支付商户号，从商户 API 证书的 CN 中自动解析。
     */
    protected string $mch_id;

    /**
     * 微信应用 AppID，例如公众号、开放平台应用或小程序的 AppID。
     */
    protected ?string $app_id;

    /**
     * APIv3 密钥，用于解密微信支付回调通知中的加密数据。
     */
    protected ?string $encrypt_key;

    /**
     * 微信支付公钥，支持传入 pub_key.pem 文件路径或公钥内容，用于响应和回调验签。
     */
    protected ?string $wechat_pay_public_key = null;

    /**
     * 微信支付公钥 ID，格式为 PUB_KEY_ID_...，用于匹配响应和回调中的 Wechatpay-Serial。
     */
    protected ?string $wechat_pay_public_key_id = null;


    public function getMchApiClientCert():string
    {
        return $this->mch_api_client_cert;
    }

    /**
     * @param mixed $mch_api_client_cert
     */
    public function setMchApiClientCert(string $mch_api_client_cert): void
    {
        $this->mch_api_client_cert = $mch_api_client_cert;
        $this->parseMchApiClientCert();
    }

    public function getMchApiClientKey(): string
    {
        return $this->mch_api_client_key;
    }

    public function setMchApiClientKey(string $mch_api_client_key): void
    {
        $this->mch_api_client_key = $mch_api_client_key;
        $this->parseMchApiClientKey();
    }

    /**
     * @return mixed
     */
    public function getMchCertSerialNo():string
    {
        return $this->mch_cert_serial_no;
    }


    /**
     * @return mixed
     */
    public function getMchId()
    {
        return $this->mch_id;
    }


    /**
     * @return mixed
     */
    public function getAppId():string
    {
        return $this->app_id;
    }

    /**
     * @param mixed $app_id
     */
    public function setAppId(string $app_id): void
    {
        $this->app_id = $app_id;
    }

    /**
     * @return mixed
     */
    public function getEncryptKey():?string
    {
        return $this->encrypt_key;
    }

    /**
     * @param mixed $encrypt_key
     */
    public function setEncryptKey(string $encrypt_key): void
    {
        $this->encrypt_key = $encrypt_key;
    }

    public function getWechatPayPublicKey(): ?string
    {
        return $this->wechat_pay_public_key;
    }

    public function setWechatPayPublicKey(string $wechat_pay_public_key): void
    {
        $this->wechat_pay_public_key = $wechat_pay_public_key;
        $this->parseWechatPayPublicKey();
    }

    public function getWechatPayPublicKeyId(): ?string
    {
        return $this->wechat_pay_public_key_id;
    }

    public function setWechatPayPublicKeyId(string $wechat_pay_public_key_id): void
    {
        $this->wechat_pay_public_key_id = $wechat_pay_public_key_id;
    }

    protected function initialize(): void
    {
        if(!empty($this->mch_api_client_cert)){
            $this->parseMchApiClientCert();
        }
        if(!empty($this->mch_api_client_key)){
            $this->parseMchApiClientKey();
        }
        if(!empty($this->wechat_pay_public_key)){
            $this->parseWechatPayPublicKey();
        }
    }

    private function parseMchApiClientCert():void
    {
        if(is_file($this->mch_api_client_cert)){
            $this->mch_api_client_cert = file_get_contents($this->mch_api_client_cert);
        }
        $ssl = openssl_x509_parse($this->mch_api_client_cert);
        $this->mch_id = $ssl['subject']['CN'];
        $this->mch_cert_serial_no = $ssl['serialNumberHex'];
    }

    private function parseMchApiClientKey(): void
    {
        if(is_file($this->mch_api_client_key)){
            $this->mch_api_client_key = file_get_contents($this->mch_api_client_key);
        }
    }

    private function parseWechatPayPublicKey(): void
    {
        if(is_file($this->wechat_pay_public_key)){
            $this->wechat_pay_public_key = file_get_contents($this->wechat_pay_public_key);
        }
    }
}
