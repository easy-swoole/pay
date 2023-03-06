<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Spl\SplBean;

class Native extends SplBean
{
    protected $code_url;

    /**
     * @return mixed
     */
    public function getCodeUrl()
    {
        return $this->code_url;
    }

    /**
     * @param mixed $code_url
     */
    public function setCodeUrl($code_url): void
    {
        $this->code_url = $code_url;
    }
}