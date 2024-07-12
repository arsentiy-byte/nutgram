<?php

declare(strict_types=1);

namespace Tests\Unit\Telegram\Handlers;

use SergiX44\Nutgram\Telegram\Properties\ChatType;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;
use SergiX44\Nutgram\Telegram\Types\Common\Update;
use SergiX44\Nutgram\Telegram\Types\User\User;
use Tests\BotTestCase;

final class OnUpdateHandlerTest extends BotTestCase
{
    public function testUpdateDataProcessed(): void
    {
        /** @var User $user */
        $user = $this->bot->user();
        $chat = Chat::make($this->bot->chatId(), ChatType::SENDER);
        $update = new Update();
        $update->update_id = $this->faker->numberBetween();

        $this->bot
            ->setCommonChat($chat)
            ->setCommonUser($user)
            ->hearUpdate($update)
            ->reply();

        $this->assertDatabaseHas('tg_updates', [
            'update_id' => $this->bot->updateId(),
        ]);
    }
}
