<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;

final class StartCommand extends Command
{
    protected string $command = 'start';

    protected ?string $description = 'The start command.';

    /**
     * @param Nutgram $bot
     * @return void
     */
    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage('Hello, world!');
    }
}
