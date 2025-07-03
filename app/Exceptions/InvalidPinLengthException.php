<?php

namespace App\Exceptions;

use Exception;

class InvalidPinLengthException extends Exception
{
    public function __construct()
    {
        parent::__construct("Length if Pin Must Be Equal To 4"); 
    }
}
