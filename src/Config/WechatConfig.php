<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Spl\SplBean;

class WechatConfig extends SplBean
{
    protected $mch_private_key;

    protected $mch_cert_serial_no;

    protected $mch_id;

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

    protected function initialize(): void
    {
        if(is_file($this->mch_private_key)){
            $this->mch_private_key = file_get_contents($this->mch_private_key);
        }
    }


}