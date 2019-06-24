<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/11
 * Time: 13:52
 */
//生成沙箱key
require_once dirname(__DIR__) . '/vendor/autoload.php';
$url = 'https://api.mch.weixin.qq.com/sandboxnew/pay/getsignkey';
$mch_id = '';
$key = '';
$data['mch_id'] = $mch_id;
$data['nonce_str'] = \EasySwoole\Utility\Random::character(32);

function getSignContent(array $data): string
{
    $buff = '';
    foreach ($data as $k => $v) {
        $buff .= ($k != 'sign' && $v != '' && !is_array($v)) ? $k . '=' . $v . '&' : '';
    }
    return trim($buff, '&');
}

function generateSign(array $data, string $key): string
{
    ksort($data);
    $string = md5(getSignContent($data) . '&key=' . $key);
    return strtoupper($string);
}

$data['sign'] = generateSign($data, $key);
go(function () use ($url, $data) {
    $response = \EasySwoole\Pay\Utility\NewWork::postJson($url, \EasySwoole\Pay\Utility\Arr::toXml($data));
    var_dump($response->getBody());
});
