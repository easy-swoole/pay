<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Spl\SplBean;

class App extends SplBean
{
    protected $prepay_id;

    /**
     * @return mixed
     */
    public function getPrepayId()
    {
        return $this->prepay_id;
    }

    /**
     * @param mixed $prepay_id
     */
    public function setPrepayId($prepay_id): void
    {
        $this->prepay_id = $prepay_id;
    }
}