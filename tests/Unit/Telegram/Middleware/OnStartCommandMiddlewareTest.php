<?php

declare(strict_types=1);

namespace Tests\Unit\Telegram\Middleware;

use SergiX44\Nutgram\Telegram\Types\User\User;
use Tests\BotTestCase;

final class OnStartCommandMiddlewareTest extends BotTestCase
{
    public function testUserDataProcessed(): void
    {
        /** @var User $user */
        $user = $this->bot->user();

        $this->assertDatabaseHas('tg_users', ['user_id' => $user->id]);
    }

    public function testChatDataProcessed(): void
    {
        $this->bot
            ->hearText('/start')
            ->reply();

        $this->assertDatabaseHas('tg_chats', ['chat_id' => $this->bot->chatId()]);
    }
}
