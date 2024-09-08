<?php

namespace EasySwoole\Pay\Beans\Wechat;

use EasySwoole\Pay\Exception\Wechat;
use EasySwoole\Spl\SplBean;

class BaseBean extends SplBean
{
    function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();
        $final = [];
        foreach ($data as $key => $val){
            $temp = new \ReflectionProperty(static::class,$key);
            if($temp->getType()->allowsNull()){
                if($val !== null){
                    if($val instanceof BaseBean){
                        $val = $val->toArray();
                    }
                    $final[$key] = $val;
                }
            }else{
                if($val === null){
                    throw new Wechat(static::class." param {$key} can not be null");
                }
                if($val instanceof BaseBean){
                    $val = $val->toArray();
                }
                $final[$key] = $val;
            }
        }
        return $final;
    }
}