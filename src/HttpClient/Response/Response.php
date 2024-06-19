<?php

namespace Segakgd\TelegramClient\HttpClient\Response;

class Response
{
    public function __construct(
        private int $code,
        private array $result,
        private string $description,
    ) {
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function setResult(array $result): void
    {
        $this->result = $result;
    }

    public static function mapFromArray(array $data): Response
    {
        return new static(
            code: isset($data['ok']) ? 200 : 400,
            result: $data['result'] ?? [],
            description: $data['description'] ?? '',
        );
    }
}
