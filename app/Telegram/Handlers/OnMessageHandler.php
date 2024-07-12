<?php

declare(strict_types=1);

namespace App\Telegram\Handlers;

use App\Telegram\Jobs\ProcessMessageData;
use Illuminate\Contracts\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Nutgram;

final readonly class OnMessageHandler
{
    /**
     * @param Repository $cache
     */
    public function __construct(
        private Repository $cache,
    ) {
    }

    /**
     * @param Nutgram $bot
     * @throws InvalidArgumentException
     */
    public function __invoke(Nutgram $bot): void
    {
        $message = $bot->message();

        if (null === $message) {
            return;
        }

        $this->cache->set(sprintf('message_from_tg:%d', $message->message_id), $message->toArray());

        ProcessMessageData::dispatch($message->message_id);
    }
}
