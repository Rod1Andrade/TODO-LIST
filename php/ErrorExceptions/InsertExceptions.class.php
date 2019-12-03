<?php

namespace php\ErrorExceptions;

use Exception;

class InsertExceptions extends Exception
{
    public function __construct(string $msg, int $code = 0)
    {
        parent::__construct($msg, $code);
    }
}