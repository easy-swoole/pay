<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:40
 */

namespace EasySwoole\Pay\WeChat;


use EasySwoole\Spl\SplBean;

class Config extends SplBean
{
	/**
	 * @var string
	 */
	protected $appid; // APP APPID
	/**
	 * @var string
	 */
	protected $appId; // 公众号 APPID
	/**
	 * @var string
	 */
	protected $miniAppId;  // 小程序 APPID
	/**
	 * @var string
	 */
	protected $mchId;
	/**
	 * @var string
	 */
	protected $key;
	/**
	 * @var string
	 */
	protected $notifyUrl;
	/**
	 * @var string
	 */
	protected $certClient; // optional，退款等情况时用到
	/**
	 * @var string
	 */
	protected $certKey; // optional，退款等情况时用到

	/**
	 * @return string
	 */
	public function getAppid() : string
	{
		return $this->appid;
	}

	/**
	 * @param string $appid
	 */
	public function setAppid( string $appid ) : void
	{
		$this->appid = $appid;
	}

	/**
	 * @return string
	 */
	public function getMiniAppId() : string
	{
		return $this->miniAppId;
	}

	/**
	 * @param string $miniAppId
	 */
	public function setMiniAppId( string $miniAppId ) : void
	{
		$this->miniAppId = $miniAppId;
	}

	/**
	 * @return string
	 */
	public function getMchId() : string
	{
		return $this->mchId;
	}

	/**
	 * @param string $mchId
	 */
	public function setMchId( string $mchId ) : void
	{
		$this->mchId = $mchId;
	}

	/**
	 * @return string
	 */
	public function getKey() : string
	{
		return $this->key;
	}

	/**
	 * @param string $key
	 */
	public function setKey( string $key ) : void
	{
		$this->key = $key;
	}

	/**
	 * @return string
	 */
	public function getNotifyUrl() : string
	{
		return $this->notifyUrl;
	}

	/**
	 * @param string $notifyUrl
	 */
	public function setNotifyUrl( string $notifyUrl ) : void
	{
		$this->notifyUrl = $notifyUrl;
	}

	/**
	 * @return string
	 */
	public function getCertClient() : string
	{
		return $this->certClient;
	}

	/**
	 * @param string $certClient
	 */
	public function setCertClient( string $certClient ) : void
	{
		$this->certClient = $certClient;
	}

	/**
	 * @return string
	 */
	public function getCertKey() : string
	{
		return $this->certKey;
	}

	/**
	 * @param string $certKey
	 */
	public function setCertKey( string $certKey ) : void
	{
		$this->certKey = $certKey;
	}

}