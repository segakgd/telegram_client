# Telegram report client

A PHP client library for interacting with the Telegram Bot API.

## Features

- Send messages
- Send exceptions

## Installation

Install via Composer:

```bash
composer require segakgd/telegram_client
```

## Usage

```php
    $telegramManager = new TelegramManager();

    $telegramToken = '0000000:0000000000000000000000000';

    $message = $telegramMessageBuilder
        ->addText("Привет, мир!")
        ->newLine()
        ->addIndent()
        ->bold("Это жирный текст")
        ->newLine(2)
        ->italic("Курсивный текст")
        ->newLine()
        ->monospace("Моноширинный текст")
        ->newLine()
        ->addLink("Нажми сюда", "https://example.com")
        ->getMessage();

    $chatId = '0000000';
    $messageDto = $telegramManager->createMessage($chatId, $message);
    
    $response = $telegramManager->sendMessage(
        message: $messageDto,
        token: $telegramToken,
    );
```

## Usage with exceptions

```php
    $telegramManager = new TelegramManager();

    $telegramToken = '0000000:0000000000000000000000000';

    $exception1 = new Exception('1');
    $exception2 = new Exception(message: '2', previous: $exception1);
    $exception3 = new Exception(message: '3', previous: $exception2);
    $exception4 = new Exception(message: '4', previous: $exception3);
    $exception5 = new Exception(message: '5', previous: $exception4);
    $exception6 = new Exception(message: '6', previous: $exception5);
    
    $message = (new TelegramExceptionManager())->makeReport($exception6);

    $chatId = '0000000';
    $messageDto = $telegramManager->createMessage($chatId, $message);
    
    $response = $telegramManager->sendMessage(
        message: $messageDto,
        token: $telegramToken,
    );
```