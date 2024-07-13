<?php

declare(strict_types=1);

namespace App\Telegram\Middleware;

use App\Telegram\Models\Chat;
use App\Telegram\Models\User;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Nutgram;

final readonly class OnStartCommandMiddleware
{
    /**
     * @param Nutgram $bot
     * @param $next
     * @return void
     * @throws InvalidArgumentException
     */
    public function __invoke(Nutgram $bot, $next): void
    {
        if (null !== $bot->user()) {
            User::updateOrCreateFromType($bot->user());
        }

        if (null !== $bot->chat()) {
            Chat::updateOrCreateFromType($bot->chat());
        }

        $next($bot);
    }
}
