<?php

namespace telegram_client\HttpClient;

use telegram_client\Dto\RequestInterface;
use telegram_client\Dto\Response;
use telegram_client\Dto\ResponseInterface;

class HttpClient implements HttpClientInterface
{
    public const METHOD_POST = 'POST';
    public const METHOD_GET = 'GET';

    public function request(
        RequestInterface $request,
        string $scenarioMethod,
        string $token,
        string $requestMethod = self::METHOD_POST,
    ): ResponseInterface {
        $requestArray = $request->getArray();

        $uri = "https://api.telegram.org/bot$token/$scenarioMethod";
        $responseArray = $this->curlRequest($uri, $requestArray, $requestMethod);

        $code = $responseArray['ok'] === true ? 200 : 400;
        $description = $responseArray['description'] ?? '';

        return new Response($code, $description);
    }

    private function curlRequest(string $uri, array $requestArray, string $method): array
    {
        if ($method === self::METHOD_GET) {
            $ch = curl_init($uri . http_build_query($requestArray));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);

            $response = curl_exec($ch);

            curl_close($ch);
        } elseif ($method === self::METHOD_POST){
            $ch = curl_init($uri);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestArray, '', '&'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);

            $response = curl_exec($ch);

            curl_close($ch);
        }

        return json_decode($response ?? '', true);
    }
}