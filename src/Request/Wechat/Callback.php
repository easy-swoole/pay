<?php

namespace EasySwoole\Pay\Request\Wechat;

use EasySwoole\Spl\SplBean;

class Callback extends SplBean
{
    protected $signature;
    protected $timestamp;
    protected  $nonce;
    protected $certSerial;

    protected $body;

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature): void
    {
        $this->signature = $signature;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * @param mixed $nonce
     */
    public function setNonce($nonce): void
    {
        $this->nonce = $nonce;
    }

    /**
     * @return mixed
     */
    public function getCertSerial()
    {
        return $this->certSerial;
    }

    /**
     * @param mixed $certSerial
     */
    public function setCertSerial($certSerial): void
    {
        $this->certSerial = $certSerial;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }
}