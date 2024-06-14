<?php

namespace Segakgd\TelegramClient\HttpClient\Core;

use Segakgd\TelegramClient\HttpClient\Exception\BadRequestException;
use Segakgd\TelegramClient\HttpClient\Exception\InvalidMethodException;

class HttpClient
{
    public const METHOD_POST = 'POST';
    public const METHOD_GET = 'GET';

    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function request(string $uri, array $requestArray, string $method): array
    {
        $response = match ($method) {
            self::METHOD_GET => $this->sendGet($uri, $requestArray),
            self::METHOD_POST => $this->sendPost($uri, $requestArray),
            default => throw new InvalidMethodException("The $method method is invalid"),
        };

        return json_decode($response ?? '', true) ?? [];
    }

    /**
     * @throws BadRequestException
     */
    private function sendGet(string $uri, array $requestArray): string
    {
        $curl = curl_init($uri . http_build_query($requestArray));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $response = curl_exec($curl);

        curl_close($curl);

        if (!$response) {
            throw new BadRequestException();
        }

        return $response;
    }

    /**
     * @throws BadRequestException
     */
    private function sendPost(string $uri, array $requestArray): string
    {
        $curl = curl_init($uri);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestArray, '', '&'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $response = curl_exec($curl);

        curl_close($curl);

        if (!$response) {
            throw new BadRequestException();
        }

        return $response;
    }
}
