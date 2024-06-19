<?php

namespace Segakgd\TelegramClient;

use Segakgd\TelegramClient\Dto\Request\Invoice\InvoiceDto;
use Segakgd\TelegramClient\Dto\Request\Message\MessageDto;
use Segakgd\TelegramClient\Dto\Request\Message\PhotoDto;
use Segakgd\TelegramClient\Dto\Request\Webhook\WebhookDto;
use Segakgd\TelegramClient\Dto\Response\GetWebhookInfoDto;
use Segakgd\TelegramClient\HttpClient\Core\HttpClient;
use Segakgd\TelegramClient\HttpClient\Exception\BadRequestException;
use Segakgd\TelegramClient\HttpClient\Exception\InvalidMethodException;
use Segakgd\TelegramClient\HttpClient\HttpService;
use Segakgd\TelegramClient\HttpClient\Request\Request;
use Segakgd\TelegramClient\HttpClient\Response\Response;

readonly class TelegramManager
{
    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function getWebhookInfo(string $token): Response
    {
        $request = $this->buildRequest(
            method: HttpClient::METHOD_GET,
            scenario: 'getWebhookInfo',
            token: $token,
            responseClassName: GetWebhookInfoDto::class
        );


        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function sendPhoto(string $message, string $photo, string $token, int $chatId): Response
    {
        $photoDto = (new PhotoDto())
            ->setChatId($chatId);

        $photoDto->setPhoto($photo);
        $photoDto->setCaption($message);
        $photoDto->setParseMode('MarkdownV2');

        $request = $this->buildRequest(
            method: HttpClient::METHOD_POST,
            scenario: 'sendPhoto',
            token: $token,
            data: $photoDto->getArray(),
        );

        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function sendMessage(string $message, string $token, int $chatId): Response
    {
        $messageDto = (new MessageDto())
            ->setChatId($chatId);

        $messageDto->setText($message);

        $request = $this->buildRequest(
            method: HttpClient::METHOD_POST,
            scenario: 'sendMessage',
            token: $token,
            data: $messageDto->getArray(),
        );

        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function sendInvoice(InvoiceDto $invoiceDto, string $token): Response
    {
        $request = $this->buildRequest(
            method: HttpClient::METHOD_POST,
            scenario: 'sendInvoice',
            token: $token,
            data: $invoiceDto->getArray(),
        );

        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function setWebhook(WebhookDto $webhookDto, string $token): Response
    {
        $request = $this->buildRequest(
            method: HttpClient::METHOD_POST,
            scenario: 'setWebhook',
            token: $token,
            data: $webhookDto->getArray(),
        );

        return (new HttpService())->request($request);
    }

    private function buildRequest(
        string $method,
        string $scenario,
        string $token,
        ?array $data = null,
        ?string $responseClassName = null,
    ): Request {
        return (new Request())
            ->setMethod($method)
            ->setScenario($scenario)
            ->setToken($token)
            ->setData($data)
            ->setResponseClassName($responseClassName);
    }
}
