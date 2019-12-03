<?php

namespace php\ErrorExceptions;

use Exception;

class ConnectionException extends Exception
{
    public function __construct($msg, $code = 0)
    {
        parent::__construct($msg, $code);
    }
}