<?php

function autoload($className): void
{
    if (strncmp('telegram_client', $className, 15) === 0) {
        $path = '../src/';
        $length = 15;

        $path .= str_replace('\\', '/', substr($className, $length)) . '.php';

        include $path;
    }
}

spl_autoload_register('autoload');
