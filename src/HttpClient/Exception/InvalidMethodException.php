<?php

namespace Segakgd\TelegramClient\HttpClient\Exception;

use Exception;

class InvalidMethodException extends Exception
{
    public function __construct(string $method)
    {
        parent::__construct("The $method method is invalid");
    }
}
