# telegram_client

A PHP client library for interacting with the Telegram Bot API.

## Features

- Send messages

## Installation

Install via Composer:

```bash
composer require segakgd/telegram_client
```

## Usage

```php
    $telegramManager = new TelegramManager();

    $telegramToken = '0000000:0000000000000000000000000';

    $response = $telegramManager->sendMessage(
        message: 'Your message', 
        token: $telegramToken, 
        chatId: 00000000,
    );
```