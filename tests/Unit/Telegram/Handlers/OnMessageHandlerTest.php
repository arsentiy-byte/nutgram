<?php

declare(strict_types=1);

namespace Tests\Unit\Telegram\Handlers;

use SergiX44\Nutgram\Telegram\Properties\ChatType;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;
use SergiX44\Nutgram\Telegram\Types\User\User;
use Tests\BotTestCase;

final class OnMessageHandlerTest extends BotTestCase
{
    public function testMessageDataProcessed(): void
    {
        /** @var User $user */
        $user = $this->bot->user();
        $chat = Chat::make($this->bot->chatId(), ChatType::SENDER);

        $text = $this->faker->text;

        $this->bot
            ->setCommonChat($chat)
            ->setCommonUser($user)
            ->hearText($text)
            ->reply();

        $this->assertDatabaseHas('tg_messages', [
            'message_id' => $this->bot->messageId(),
            'text' => $text,
        ]);
    }
}
