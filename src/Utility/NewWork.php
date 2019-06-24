<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 12:00
 */

namespace EasySwoole\Pay\Utility;


use EasySwoole\HttpClient\HttpClient;

class NewWork
{
    public static $TIMEOUT = 15;

    public static function get($endpoint, $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        $client->setQuery($data);
        return $client->get();
    }

    public static function post($endpoint, $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        return $client->setTimeout(self::$TIMEOUT)->post($data);
    }

    public static function postJson(string $endpoint, array $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        $client->setTimeout(self::$TIMEOUT);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        return $client->postJson($data);
    }

    public static function postXML($endpoint, $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        $client->setTimeout(self::$TIMEOUT);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        return $client->postXml($data);
    }

}