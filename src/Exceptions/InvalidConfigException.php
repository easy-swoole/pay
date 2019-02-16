<?php

namespace EasySwoole\Pay\Exceptions;

class InvalidConfigException extends Exception
{
    /**
     * @param string       $message
     * @param array|string $raw
     * @param int|string   $code
     */
    public function __construct($message, $raw = [], $code = 2)
    {
        parent::__construct($message, $raw, $code);
    }
}
