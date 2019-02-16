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

	/**
	 * Send a POST request.
	 *
	 *
	 * @param string       $endpoint
	 * @param string|array $data
	 * @param array        $options
	 *
	 * @return array|string
	 */
	public static function get( $endpoint, $data, $options = [] )
	{
		$client = new HttpClient();
	}

	/**
	 * Send a POST request.
	 *
	 *
	 * @param string       $endpoint
	 * @param string|array $data
	 * @param array        $options
	 *
	 * @return array|string
	 */
	public static function post( $endpoint, $data, $options = [] )
	{
		if( !is_array( $data ) ){
			$options['body'] = $data;
		} else{
			$options['form_params'] = $data;
		}
		$client = new HttpClient();

		return $client->request( 'post', $endpoint, $options );
	}

	public static function postJson( $endpoint, $data, $options = [] )
	{

	}

	public static function postXML( $endpoint, $data, $options = [] )
	{

	}
}