<?php

namespace telegram_client\Dto\Chat;

use telegram_client\Dto\RequestInterface;

class ChatDto implements RequestInterface
{
    public function getArray(): array
    {
        return [];
    }
}