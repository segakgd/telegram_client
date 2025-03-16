<?php

namespace Segakgd\TelegramClient;

class TelegramMessageBuilder
{
    private string $message = '';

    public function addText(string $text): static
    {
        $this->message .= $this->escapeMarkdown($text);

        return $this;
    }

    public function newLine(int $count = 1): static
    {
        $this->message .= str_repeat("\n", $count);

        return $this;
    }

    public function toUpperCase(): static
    {
        $this->message = strtoupper($this->message);

        return $this;
    }

    public function toLowerCase(): static
    {
        $this->message = strtolower($this->message);

        return $this;
    }

    public function addIndent(int $spaces = 4): static
    {
        $this->message .= str_repeat(' ', $spaces);

        return $this;
    }

    public function bold(string $text): static
    {
        $this->message .= "*" . $this->escapeMarkdown($text) . "*";
        return $this;
    }

    public function italic(string $text): static
    {
        $this->message .= "_" . $this->escapeMarkdown($text) . "_";

        return $this;
    }

    public function monospace(string $text): static
    {
        $this->message .= "`" . $this->escapeMarkdown($text) . "`";

        return $this;
    }

    public function addLink(string $text, string $url): static
    {
        $this->message .= "[" . $this->escapeMarkdown($text) . "]( " . $this->escapeMarkdown($url) . ")";

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function clear(): static
    {
        $this->message = '';
        return $this;
    }

    private function escapeMarkdown(string $text): string
    {
        $replacements = [
            '\\' => '\\\\',
            '_' => '\_',
            '*' => '\*',
            '[' => '\[',
            ']' => '\]',
            '(' => '\(',
            ')' => '\)',
            '~' => '\~',
            '`' => '\`',
            '>' => '\>',
            '#' => '\#',
            '+' => '\+',
            '-' => '\-',
            '=' => '\=',
            '|' => '\|',
            '{' => '\{',
            '}' => '\}',
            '.' => '\.',
            '!' => '\!',
            '/' => '\/',
        ];

        return strtr($text, $replacements);
    }
}