<?php

namespace telegram_client\HttpClient;

use telegram_client\Dto\ResponseInterface;

interface ResponseBuilderInterface
{
    public function build(): ResponseInterface;
}