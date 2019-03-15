<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/8
 * Time: 11:23
 */

$result = file_get_contents('php://input');
$msg = "[" . date('Y-m-d H:i:s') . "]" . $result . "\r\n";
file_put_contents(dirname(__DIR__) . '/Temp/notify-' . date('Y-m-d') . '.log', $msg, FILE_APPEND);