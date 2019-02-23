<?php

namespace Textline\Exceptions;

class AuthenticationException extends \Exception
{
    public function __construct(string $message)
    {
        var_dump($message);
        die();
        parent::__construct($message, 401);
    }
}

