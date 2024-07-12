<?php

/** @var Nutgram $bot */

use App\Telegram\Handlers\OnMessageHandler;
use App\Telegram\Handlers\OnUpdateHandler;
use App\Telegram\Middleware\OnStartCommandMiddleware;
use SergiX44\Nutgram\Nutgram;

$bot->onUpdate(OnUpdateHandler::class);
$bot->onMessage(OnMessageHandler::class);

$bot
    ->onCommand('start', function (Nutgram $bot): void {
        $bot->sendMessage('Hello, world!');
    })
    ->description('The start command!')
    ->middleware(OnStartCommandMiddleware::class);
