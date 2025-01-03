<?php

namespace Segakgd\TelegramClient\Dto\Request;

readonly class MessageRequestDto
{
    public function __construct(
        public int|string $chatId,
        public string $text,
        public array $replyMarkup = [],
        public ?int $messageThreadId = null,
        public ?string $parseMode = null,
        public ?array $entities = null,
        public ?bool $disableWebPagePreview = null,
        public ?bool $disableNotification = null,
        public ?bool $protectContent = null,
        public ?int $replyToMessageId = null,
        public ?bool $allowSendingWithoutReply = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'chat_id' => $this->chatId,
            'text' => $this->text,
            'reply_markup' => [],
            'message_thread_id' => null,
            'parse_mode' => null,
            'entities' => null,
            'disable_web_page_preview' => null,
            'disable_notification' => null,
            'protect_content' => null,
            'reply_to_message_id' => null,
            'allow_sending_without_reply' => null,
        ];
    }
}
