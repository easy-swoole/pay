<?php

namespace EasySwoole\Pay\Exceptions;

class Exception extends \Exception
{
    /**
     * Raw error info.
     */
    public $extra;

    public function __construct($message, $extra = null, $code = 9999)
    {
        $this->extra = $extra;
        parent::__construct($message, intval($code));
    }

    public function getErrorExtraInfo()
    {
        return $this->extra;
    }
}
