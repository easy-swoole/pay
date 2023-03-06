<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Spl\SplBean;

class H5 extends SplBean
{
    protected $h5_url;
    /**
     * @return mixed
     */
    public function getH5Url()
    {
        return $this->h5_url;
    }

    /**
     * @param mixed $h5_url
     */
    public function setH5Url($h5_url): void
    {
        $this->h5_url = $h5_url;
    }

}