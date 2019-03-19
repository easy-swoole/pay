<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:10
 */
require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use EasySwoole\Pay\WeChat\Config;

$wechatConfig = new Config();
$wechatConfig->setAppId('');
$wechatConfig->setMchId('');
$wechatConfig->setKey('');
$wechatConfig->setNotifyUrl('');
$wechatConfig->setApiClientCert('');
$wechatConfig->setApiClientKey('');

return $wechatConfig;