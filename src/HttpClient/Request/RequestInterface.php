<?php

namespace telegram_client\HttpClient\Request;

interface RequestInterface
{
    public function getData(): array;

    public function setData(array $data): self;

    public function getScenario(): string;

    public function setScenario(string $scenario): self;

    public function getToken(): string;

    public function setToken(string $token): self;

    public function getMethod(): string;

    public function setMethod(string $method): self;
}