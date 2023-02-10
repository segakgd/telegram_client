<?php

namespace telegram_client\HttpClient;

use telegram_client\Dto\RequestInterface;
use telegram_client\Dto\ResponseInterface;

class HttpClient implements HttpClientInterface
{

    public function request(RequestInterface $request): ResponseInterface
    {
        // TODO: create response builder and return response object
    }
}