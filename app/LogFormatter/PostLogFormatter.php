<?php

namespace App\LogFormatter;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;

class PostLogFormatter
{
    /**
     * Customize the given logger instance.
     */
    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                '%message%' . PHP_EOL, // Це буде тільки повідомлення
                null, // Порожній формат для дати
                false, // Немає мультибайтових символів
                true // Тримати одинарні лапки
            ));
        }
    }
}
