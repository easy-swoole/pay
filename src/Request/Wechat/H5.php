<?php

namespace EasySwoole\Pay\Request\Wechat;

use EasySwoole\Pay\Beans\Wechat\H5ReqSceneInfo;

class H5 extends BaseRequest
{
    public H5ReqSceneInfo $scene_info;

    protected function initialize():void
    {
        parent::initialize();
        if(empty($this->scene_info)){
            $this->scene_info = new H5ReqSceneInfo();
        }
    }

}