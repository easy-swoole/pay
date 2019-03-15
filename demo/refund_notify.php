<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 10:40
 */

$result = file_get_contents('php://input');
$msg = "[" . date('Y-m-d H:i:s') . "]" . $result . "\r\n";
file_put_contents(dirname(__DIR__) . '/Temp/refund_notify-' . date('Y-m-d') . '.log', $msg, FILE_APPEND);