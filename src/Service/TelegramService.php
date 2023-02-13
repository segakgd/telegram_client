<?php

namespace telegram_client\Service;

use telegram_client\Dto\Message\MessageDto;
use telegram_client\Dto\Webhook\WebhookDto;
use telegram_client\HttpClient\HttpClientInterface;

class TelegramService implements TelegramServiceInterface
{
    public function sendMessage(HttpClientInterface $httpClient, MessageDto $messageDto)
    {
        $httpClient->request($messageDto, 'sendMessage');
    }

    public function setWebhook(HttpClientInterface $httpClient, WebhookDto $webhookDto)
    {
        $httpClient->request($webhookDto, 'setWebhook');
    }
}