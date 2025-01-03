<?php

namespace Segakgd\TelegramClient;

use Exception;
use Throwable;

readonly class TelegramExceptionManager
{
    private const NESTING_CALL = 5;

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
        int $counter = 0,
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

        $previous = $error->getPrevious();

        if (!is_null($previous) && static::NESTING_CALL > $counter) {
            $counter++;

            $telegramMessageBuilder = $this->enrichFromException($telegramMessageBuilder, $error->getPrevious(), $counter);
        }

        return $telegramMessageBuilder;
    }
}
