<?php

declare(strict_types=1);

namespace App\Telegram\Middleware;

use App\Telegram\Middleware\Handlers\ProcessChatDataHandler;
use App\Telegram\Middleware\Handlers\ProcessUserDataHandler;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Nutgram;

final readonly class OnStartCommandMiddleware
{
    /**
     * @param ProcessUserDataHandler $userDataHandler
     * @param ProcessChatDataHandler $chatDataHandler
     */
    public function __construct(
        private ProcessUserDataHandler $userDataHandler,
        private ProcessChatDataHandler $chatDataHandler,
    ) {
    }

    /**
     * @param Nutgram $bot
     * @param $next
     * @return void
     * @throws InvalidArgumentException
     */
    public function __invoke(Nutgram $bot, $next): void
    {
        if (null !== $bot->user()) {
            $this->userDataHandler->handle($bot->user());
        }

        if (null !== $bot->chat()) {
            $this->chatDataHandler->handle($bot->chat());
        }

        $next($bot);
    }
}
