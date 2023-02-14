<?php

namespace telegram_client\Service;

use telegram_client\Dto\Message\MessageDto;
use telegram_client\Dto\Webhook\WebhookDto;
use telegram_client\HttpClient\HttpClientInterface;

class TelegramService implements TelegramServiceInterface
{
    public function sendMessage(HttpClientInterface $httpClient, MessageDto $messageDto, string $token)
    {
        $httpClient->request($messageDto, 'sendMessage', $token);
    }

    public function setWebhook(HttpClientInterface $httpClient, WebhookDto $webhookDto, string $token)
    {
        $httpClient->request($webhookDto, 'setWebhook', $token);
    }
}