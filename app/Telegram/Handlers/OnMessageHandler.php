<?php

declare(strict_types=1);

namespace App\Telegram\Handlers;

use App\Telegram\Models\Message;
use SergiX44\Nutgram\Nutgram;

final readonly class OnMessageHandler
{
    /**
     * @param Nutgram $bot
     */
    public function __invoke(Nutgram $bot): void
    {
        $message = $bot->message();

        if (null === $message) {
            return;
        }

        Message::updateOrCreateFromType($message);
    }
}
