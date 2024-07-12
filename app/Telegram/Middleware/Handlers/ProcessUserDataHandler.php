<?php

declare(strict_types=1);

namespace App\Telegram\Middleware\Handlers;

use App\Telegram\Jobs\ProcessUserData;
use Illuminate\Contracts\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Telegram\Types\User\User;

final readonly class ProcessUserDataHandler
{
    /**
     * @param Repository $cache
     */
    public function __construct(
        private Repository $cache,
    ) {
    }

    /**
     * @param User $user
     * @return void
     * @throws InvalidArgumentException
     */
    public function handle(User $user): void
    {
        $this->cache->set(sprintf('user_from_tg:%d', $user->id), $user->toArray());

        ProcessUserData::dispatch($user->id);
    }
}
