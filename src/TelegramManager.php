<?php

namespace Segakgd\TelegramClient;

use Segakgd\TelegramClient\Dto\Request\MessageRequestDto;
use Segakgd\TelegramClient\HttpClient\Core\HttpClient;
use Segakgd\TelegramClient\HttpClient\Exception\BadRequestException;
use Segakgd\TelegramClient\HttpClient\Exception\InvalidMethodException;
use Segakgd\TelegramClient\HttpClient\HttpService;
use Segakgd\TelegramClient\HttpClient\Request\Request;
use Segakgd\TelegramClient\HttpClient\Response\Response;

readonly class TelegramManager
{
    public function createMessage(string $chatId, string $text): MessageRequestDto
    {
        return new MessageRequestDto(
            chatId: $chatId,
            text: $text,
        );
    }

    /**
     * @throws BadRequestException
     * @throws InvalidMethodException
     */
    public function sendMessage(MessageRequestDto $message, string $token): Response
    {
        $request = (new Request())
            ->setMethod(HttpClient::METHOD_POST)
            ->setScenario('sendMessage')
            ->setToken($token)
            ->setData($message->toArray());

        return (new HttpService())->request($request);
    }
}
