<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Spl\SplBean;

class WechatConfig extends SplBean
{
    protected $mch_private_key;

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

    protected function initialize(): void
    {
        if(is_file($this->mch_private_key)){
            $this->mch_private_key = file_get_contents($this->mch_private_key);
        }
    }


}