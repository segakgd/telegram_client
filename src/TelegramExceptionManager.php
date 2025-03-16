<?php

namespace Segakgd\TelegramClient;

use Exception;
use Throwable;

readonly class TelegramExceptionManager
{
    public function makeReport(Throwable|string $error): string
    {
        if (!$error instanceof Throwable) {
            $error = new Exception($error);
        }

        $telegramMessageBuilder = new TelegramMessageBuilder();
        $telegramMessageBuilder = $this->enrichFromException($telegramMessageBuilder, $error);

        return $telegramMessageBuilder->getMessage();
    }

    private function enrichFromException(
        TelegramMessageBuilder $telegramMessageBuilder,
        Throwable $error,
    ): TelegramMessageBuilder {
        $telegramMessageBuilder->bold('Error: ');
        $telegramMessageBuilder->bold(
            text: $error->getMessage()
        );

        $telegramMessageBuilder->newLine();
        $telegramMessageBuilder->bold('File: ');
        $telegramMessageBuilder->addText(
            text: $error->getFile()
        );

        $telegramMessageBuilder->newLine();
        $telegramMessageBuilder->bold('Line: ');
        $telegramMessageBuilder->addText(
            text: $error->getLine()
        );

        $telegramMessageBuilder->newLine();
        $telegramMessageBuilder->bold('Code: ');
        $telegramMessageBuilder->addText(
            text: $error->getCode()
        );

        $telegramMessageBuilder->newLine();
        $telegramMessageBuilder->bold('Trace: ');
        $telegramMessageBuilder->addText(
            text: $error->getTraceAsString()
        );

        $telegramMessageBuilder->newLine();
        $telegramMessageBuilder->newLine();

        return $telegramMessageBuilder;
    }
}
