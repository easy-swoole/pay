<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 12:00
 */

namespace EasySwoole\Pay\Utility;


use EasySwoole\HttpClient\HttpClient;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;

class NewWork
{
    public static $TIMEOUT = 15;

    /**
     * Send a POST request.
     *
     *
     * @param string $endpoint
     * @param string|array $data
     * @param array $options
     *
     * @return array|string
     */
    public static function get($endpoint, $data, $options = [])
    {
        $client = new HttpClient();
    }

	/**
	 * @param $endpoint
	 * @param $data
	 * @return HttpClient
	 */
    public static function post($endpoint, $data)
    {
        $client = new HttpClient();
        return $client->setTimeout(self::$TIMEOUT)->postJson($data);
    }

    /**
     * @param       $endpoint
     * @param       $data
     * @param array $options
     */
    public static function postJson(string $endpoint, array $data, $options = [])
    {

    }

    public static function postXML($endpoint, $data, $options = [])
    {
        $client = new HttpClient();

        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $client->setClientSetting($key, $value);
            }
        }
        return $client->setTimeout(self::$TIMEOUT)->postXML($data);
    }

}