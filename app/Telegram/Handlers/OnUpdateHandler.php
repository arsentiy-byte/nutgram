<?php

declare(strict_types=1);

namespace App\Telegram\Handlers;

use App\Telegram\Jobs\ProcessUpdateData;
use Illuminate\Contracts\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Nutgram;

final readonly class OnUpdateHandler
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
        $update = $bot->update();

        if (null === $update || ! isset($update->update_id)) {
            return;
        }

        $this->cache->set(sprintf('update_from_tg:%d', $update->update_id), $update->toArray());

        ProcessUpdateData::dispatch($update->update_id);
    }
}
