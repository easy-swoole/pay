<?php

namespace EasySwoole\Pay\Request\Alipay;

use EasySwoole\Pay\Exception\Alipay;
use EasySwoole\Spl\SplBean;

class BaseRequest extends SplBean
{
    protected string $app_id;

    protected string $method;

    protected string $format;

    protected string $charset;

    protected string $sign_type;

    protected string $sign;

    protected string $timestamp;

    protected string $version;
    
    protected ?string $notify_url;

    protected ?string $app_auth_token;
    protected string $biz_content;

    function toArray(int|callable $filter = null): array
    {
        $data = $this->jsonSerialize();
        $final = [];
        foreach ($data as $key => $val){
            $temp = new \ReflectionProperty(static::class,$key);
            if($temp->getType()->allowsNull()){
                if($val !== null){
                    $final[$key] = $val;
                }
            }else{
                if($val === null){
                    throw new Alipay("request ".static::class." param {$key} can not be null");
                }
                $final[$key] = $val;
            }
        }
        return $final;
    }

}