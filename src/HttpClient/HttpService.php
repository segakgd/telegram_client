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
        $responseArray = (new HttpClient)->request(
            uri: $this->makeTargetUri(
                token: $request->getToken(),
                scenario: $request->getScenario()
            ),
            requestArray: $request->getData() ?? [],
            method: $request->getMethod()
        );

        $code = 400;

        if (isset($responseArray['ok'])) {
            $code = $responseArray['ok'] === true ? 200 : 400;
        }

        $description = $responseArray['description'] ?? '';

        $result['result'] = $responseArray['result'] ?? [];

        $result['code'] = $code;
        $result['description'] = $description;

        $responseClassName = $request->getResponseClassName();

        if ($code == 400) {
            throw new BadRequestException('Error code 400');
        }

        if ($responseClassName) {
            // todo make responce
        }

        return new Response($code, $description);
    }

    private function makeTargetUri(string $token, string $scenario): string
    {
        return static::TELEGRAM_URI . "/bot$token/$scenario";
    }
}
