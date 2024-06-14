<?php

namespace Segakgd\TelegramClient;

use Segakgd\TelegramClient\Dto\Request\Invoice\InvoiceDto;
use Segakgd\TelegramClient\Dto\Request\Message\MessageDto;
use Segakgd\TelegramClient\Dto\Request\Message\PhotoDto;
use Segakgd\TelegramClient\Dto\Request\Webhook\WebhookDto;
use Segakgd\TelegramClient\Dto\Response\GetWebhookInfoDto;
use Segakgd\TelegramClient\HttpClient\Exception\BadRequestException;
use Segakgd\TelegramClient\HttpClient\HttpService;
use Segakgd\TelegramClient\HttpClient\Request\Request;
use Segakgd\TelegramClient\HttpClient\Response\Response;

readonly class TelegramManager
{
    /**
     * @throws BadRequestException
     */
    public function getWebhookInfo(string $token): Response
    {
        $request = $this->buildRequest(
            HttpService::METHOD_GET,
            'getWebhookInfo',
            $token,
            null,
            GetWebhookInfoDto::class
        );


        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     */
    public function sendPhoto($responsibleMessageDto, string $token, int $chatId): Response
    {
        $message = $responsibleMessageDto->getMessage();
        $replyMarkup = $responsibleMessageDto->getKeyBoard();
        $photo = $responsibleMessageDto->getPhoto();

        $photoDto = (new PhotoDto())
            ->setChatId($chatId);

        $photoDto->setPhoto($photo);
        $photoDto->setCaption($message);
        $photoDto->setReplyMarkup($replyMarkup);
        $photoDto->setParseMode('MarkdownV2');

        $request = $this->buildRequest(
            HttpService::METHOD_POST,
            'sendPhoto',
            $token,
            $photoDto->getArray(),
        );

        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     */
    public function sendMessage($responsibleMessageDto, string $token, int $chatId): Response
    {
        $message = $responsibleMessageDto->getMessage();
        $replyMarkup = $responsibleMessageDto->getKeyBoard();

        $messageDto = (new MessageDto())
            ->setChatId($chatId);

        $messageDto->setText($message);
        $messageDto->setReplyMarkup($replyMarkup);

        $request = $this->buildRequest(
            HttpService::METHOD_POST,
            'sendMessage',
            $token,
            $messageDto->getArray(),
        );

        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     */
    public function sendInvoice(InvoiceDto $invoiceDto, string $token): Response
    {
        $request = $this->buildRequest(
            HttpService::METHOD_POST,
            'sendInvoice',
            $token,
            $invoiceDto->getArray(),
        );

        return (new HttpService())->request($request);
    }

    /**
     * @throws BadRequestException
     */
    public function setWebhook(WebhookDto $webhookDto, string $token): Response
    {
        $request = $this->buildRequest(
            HttpService::METHOD_POST,
            'setWebhook',
            $token,
            $webhookDto->getArray(),
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
