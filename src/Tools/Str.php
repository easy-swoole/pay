<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午1:11
 */

namespace EasySwoole\EasyPay\Tools;

/**
 * 字符串辅助工具
 * Class Str
 * @package EasySwoole\EasyPay\Tools
 */
class Str
{
    /**
     * 生成随机字符串
     * @return bool|string
     * @author: eValor < master@evalor.cn >
     */
    static function nonce()
    {
        mt_srand();
        return substr(str_shuffle("abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ23456789"), 0, 32);
    }

    /**
     * 生成订单号
     * @return string
     * @author: eValor < master@evalor.cn >
     */
    static function orderNum()
    {
        mt_srand();
        return date('ymdhis') . rand(1000, 9999);
    }

    /**
     * 转换到XML
     * @param $params
     * @return mixed
     * @author: eValor < master@evalor.cn >
     */
    static function toXml($params)
    {
        if (!is_array($params) || count($params) <= 0) {
            return false;
        }
        $xml = "<xml>";
        foreach ($params as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;

    }

    /**
     * 转换到数组
     * @param $xml
     * @return mixed
     * @author: eValor < master@evalor.cn >
     */
    static function fromXml($xml)
    {
        $parse = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $result = json_decode(json_encode($parse), true);
        if ($result) {
            return $result;
        } else {
            return [ 'return_code' => 'FAIL', 'return_msg' => 'DECODE ERR: ' . $xml ];
        }
    }
}