<?php

namespace Segakgd\TelegramClient\HttpClient\Exception;

use Exception;

class BadRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct("Bad request to the telegram API");
    }
}
