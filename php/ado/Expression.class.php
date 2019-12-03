<?php

namespace php\ado;

abstract class Expression
{
    const AND_OPERATOR  = 'AND';
    const OR_OPERATOR   = 'OR';

    abstract function dump() : string;
} 