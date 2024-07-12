<?php

declare(strict_types=1);

namespace App\Telegram\Jobs;

use App\Telegram\Models\Chat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

final class ProcessChatData implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param int $chatId
     */
    public function __construct(
        private readonly int $chatId,
    ) {
    }

    public function handle(): void
    {
        /** @var array<string, mixed>|null $chatData */
        $chatData = Cache::get(sprintf('chat_from_tg:%d', $this->chatId));

        if (null !== $chatData) {
            Chat::query()->updateOrCreate([
                'chat_id' => $this->chatId,
            ], [
                'data' => $chatData,
            ]);
        }
    }
}
