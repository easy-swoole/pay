<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午1:14
 */

namespace EasySwoole\EasyPay\Tools;

/**
 * 签名验签工具
 * Class Validate
 * @package EasySwoole\EasyPay\Tools
 */
class Validate
{
    /**
     * 生成签名
     * @param $payload
     * @param $secretKey
     * @author: eValor < master@evalor.cn >
     * @return array
     */
    static function generateWechatSign($payload, $secretKey)
    {
        // 去除空值然后进行排序
        $payload = array_filter($payload);
        $payload['sign_type'] = 'MD5';
        ksort($payload);

        // 构建查询字符串并拼接秘钥
        $content = urldecode(http_build_query($payload)) . '&key=' . $secretKey;
        $payload['sign'] = strtoupper(md5($content));
        return $payload;
    }
}