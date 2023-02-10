<?php

namespace telegram_client\HttpClient;

use telegram_client\Dto\ResponseInterface;
use telegram_client\Service\TelegramServiceInterface;

interface ResponseBuilderInterface
{
    public function build(): ResponseInterface;
}