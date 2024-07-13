<?php

/** @var Nutgram $bot */

use App\Telegram\Commands\StartCommand;
use App\Telegram\Handlers\OnMessageHandler;
use App\Telegram\Handlers\OnUpdateHandler;
use App\Telegram\Middleware\OnStartCommandMiddleware;
use SergiX44\Nutgram\Nutgram;

$bot->onUpdate(OnUpdateHandler::class);
$bot->onMessage(OnMessageHandler::class);

$bot->registerCommand(StartCommand::class)->middleware(OnStartCommandMiddleware::class);
