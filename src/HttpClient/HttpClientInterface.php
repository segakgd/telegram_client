<?php

namespace telegram_client\HttpClient;

use telegram_client\Dto\RequestInterface;
use telegram_client\Dto\ResponseInterface;

interface HttpClientInterface
{
    public function request(
        RequestInterface $request,
        string $scenarioMethod,
        string $token,
        string $requestMethod,
    ): ResponseInterface;
}