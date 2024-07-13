<?php

declare(strict_types=1);

namespace App\Telegram\Handlers;

use App\Telegram\Models\Update;
use SergiX44\Nutgram\Nutgram;

final readonly class OnUpdateHandler
{
    /**
     * @param Nutgram $bot
     */
    public function __invoke(Nutgram $bot): void
    {
        $update = $bot->update();

        if (null === $update || ! isset($update->update_id)) {
            return;
        }

        Update::updateOrCreateFromType($update);
    }
}
