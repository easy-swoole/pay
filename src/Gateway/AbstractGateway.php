<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午12:08
 */

namespace EasySwoole\EasyPay\Gateway;

use EasySwoole\EasyPay\Tools\Str;
use EasySwoole\Curl\Field;
use EasySwoole\Curl\Request;

abstract class AbstractGateway
{
    /**
     * 发送一个请求
     * @param $url
     * @param $urlParam
     * @param $dataParam
     * @author: eValor < master@evalor.cn >
     * @return array|mixed
     */
    function doWechatRequest($url, $urlParam = null, $dataParam = null)
    {
        $request = new Request($url);
        if ($urlParam) foreach ($urlParam as $item => $value) $request->addGet(new Field($item, $value));
        $dataParam = Str::toXml($dataParam);
        $request->setUserOpt([
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $dataParam,
            CURLOPT_HTTPHEADER => ['Content-Type:text/xml; charset=utf-8']
        ]);
        $response = $request->exec();
        if ($response->getErrorNo()) {
            return ['return_code' => 'FAIL', 'return_msg' => 'CURL ERR: ' . $response->getError()];
        } else {
            return Str::fromXml($response->getBody());
        }
    }
}