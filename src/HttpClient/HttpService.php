<?php

namespace Segakgd\TelegramClient\HttpClient;

use Segakgd\TelegramClient\HttpClient\Core\HttpClient;
use Segakgd\TelegramClient\HttpClient\Exception\BadRequestException;
use Segakgd\TelegramClient\HttpClient\Exception\InvalidMethodException;
use Segakgd\TelegramClient\HttpClient\Request\Request;
use Segakgd\TelegramClient\HttpClient\Response\Response;

class HttpService
{
    private const TELEGRAM_URI = 'https://api.telegram.org';

    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function request(Request $request): Response
    {
        $response = (new HttpClient)->request(
            uri: $this->makeTargetUri(
                token: $request->getToken(),
                scenario: $request->getScenario()
            ),
            requestArray: $request->getData() ?? [],
            method: $request->getMethod()
        );

        return Response::mapFromArray($response);
    }

    private function makeTargetUri(string $token, string $scenario): string
    {
        return static::TELEGRAM_URI . "/bot$token/$scenario";
    }
}
