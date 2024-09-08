<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Spl\SplBean;

class WechatConfig extends SplBean
{
    protected ?string $mch_private_key;

    protected ?string $mch_public_key;

    protected ?string $mch_cert_serial_no;

    protected ?string $mch_id;

    protected ?string $app_id;

    protected ?string $encrypt_key;

    /**
     * @return mixed
     */
    public function getMchPrivateKey()
    {
        return $this->mch_private_key;
    }

    /**
     * @param mixed $mch_private_key
     */
    public function setMchPrivateKey($mch_private_key): void
    {
        $this->mch_private_key = $mch_private_key;
    }

    /**
     * @return mixed
     */
    public function getMchCertSerialNo()
    {
        return $this->mch_cert_serial_no;
    }

    /**
     * @param mixed $mch_cert_serial_no
     */
    public function setMchCertSerialNo($mch_cert_serial_no): void
    {
        $this->mch_cert_serial_no = $mch_cert_serial_no;
    }

    /**
     * @return mixed
     */
    public function getMchId()
    {
        return $this->mch_id;
    }

    /**
     * @param mixed $mch_id
     */
    public function setMchId($mch_id): void
    {
        $this->mch_id = $mch_id;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param mixed $app_id
     */
    public function setAppId($app_id): void
    {
        $this->app_id = $app_id;
    }

    /**
     * @return mixed
     */
    public function getMchPublicKey()
    {
        return $this->mch_public_key;
    }

    /**
     * @param mixed $mch_public_key
     */
    public function setMchPublicKey($mch_public_key): void
    {
        $this->mch_public_key = $mch_public_key;
    }

    /**
     * @return mixed
     */
    public function getEncryptKey()
    {
        return $this->encrypt_key;
    }

    /**
     * @param mixed $encrypt_key
     */
    public function setEncryptKey($encrypt_key): void
    {
        $this->encrypt_key = $encrypt_key;
    }

    protected function initialize(): void
    {
        if(($this->mch_private_key !== null) && is_file($this->mch_private_key)){
            $this->mch_private_key = file_get_contents($this->mch_private_key);
        }

        if(($this->mch_public_key !== null) && is_file($this->mch_public_key)){
            $this->mch_public_key = file_get_contents($this->mch_public_key);
        }
    }
}