<?php
/**
 * Created by PhpStorm.
 * User: huangmengting
 * Date: 19/3/14
 * Time: 21:07
 */

foreach(spl_classes() as $key=>$value)
{
    echo $key.' -> '.$value."\r\n";
}