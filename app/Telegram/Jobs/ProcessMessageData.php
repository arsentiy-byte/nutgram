<?php

declare(strict_types=1);

namespace App\Telegram\Jobs;

use App\Telegram\Models\Message;
use Carbon\CarbonImmutable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

final class ProcessMessageData implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param int $messageId
     */
    public function __construct(
        private readonly int $messageId,
    ) {
    }

    public function handle(): void
    {
        /** @var array<string, mixed>|null $messageData */
        $messageData = Cache::get(sprintf('message_from_tg:%d', $this->messageId));

        if (null !== $messageData) {
            Message::query()->updateOrCreate([
                'message_id' => $this->messageId,
            ], [
                'from_id' => Arr::get($messageData, 'from.id'),
                'chat_id' => Arr::get($messageData, 'chat.id'),
                'text' => Arr::get($messageData, 'text'),
                'date' => CarbonImmutable::createFromTimestamp(Arr::get($messageData, 'date')),
                'data' => $messageData,
            ]);
        }
    }
}
