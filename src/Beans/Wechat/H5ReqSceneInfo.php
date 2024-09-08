<?php

namespace EasySwoole\Pay\Beans\Wechat;


class H5ReqSceneInfo extends BaseBean
{
    public string $payer_client_ip;

    public ?string $device_id;

    public ?StoreInfo $store_info;

    public H5Info $h5_info;

    protected function initialize(): void
    {
        if(empty($this->h5_info)){
            $this->h5_info = new H5Info();
        }
    }
}