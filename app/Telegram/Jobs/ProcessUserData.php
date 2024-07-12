<?php

declare(strict_types=1);

namespace App\Telegram\Jobs;

use App\Telegram\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

final class ProcessUserData implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param int $userId
     */
    public function __construct(
        private readonly int $userId,
    ) {
    }

    public function handle(): void
    {
        /** @var array<string, mixed>|null $userData */
        $userData = Cache::get(sprintf('user_from_tg:%d', $this->userId));

        if (null !== $userData) {
            User::query()->updateOrCreate([
                'user_id' => $this->userId,
            ], [
                'username' => Arr::get($userData, 'username'),
                'first_name' => Arr::get($userData, 'first_name'),
                'last_name' => Arr::get($userData, 'last_name'),
                'data' => $userData,
            ]);
        }
    }
}
