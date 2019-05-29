<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\WeChat\ResponseBean;


use EasySwoole\Spl\SplBean;

class App extends SplBean
{
	protected $appid;
	protected $partnerid;
	protected $prepayid;
	protected $package;
	protected $noncestr;
	protected $timestamp;
	protected $sign;

}