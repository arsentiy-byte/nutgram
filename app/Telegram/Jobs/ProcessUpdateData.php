<?php

declare(strict_types=1);

namespace App\Telegram\Jobs;

use App\Telegram\Models\Update;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

final class ProcessUpdateData implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param int $updateId
     */
    public function __construct(
        private readonly int $updateId,
    ) {
    }

    public function handle(): void
    {
        /** @var array<string, mixed>|null $updateData */
        $updateData = Cache::get(sprintf('update_from_tg:%d', $this->updateId));

        if (null !== $updateData) {
            Update::query()->updateOrCreate([
                'update_id' => $this->updateId,
            ], [
                'data' => $updateData,
            ]);
        }
    }
}
