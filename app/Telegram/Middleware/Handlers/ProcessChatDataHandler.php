<?php

declare(strict_types=1);

namespace App\Telegram\Middleware\Handlers;

use App\Telegram\Jobs\ProcessChatData;
use Illuminate\Contracts\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;

final readonly class ProcessChatDataHandler
{
    /**
     * @param Repository $cache
     */
    public function __construct(
        private Repository $cache,
    ) {
    }

    /**
     * @param Chat $chat
     * @return void
     * @throws InvalidArgumentException
     */
    public function handle(Chat $chat): void
    {
        $this->cache->set(sprintf('chat_from_tg:%d', $chat->id), $chat->toArray());

        ProcessChatData::dispatch($chat->id);
    }
}
