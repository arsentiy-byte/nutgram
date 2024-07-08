<?php

/** @var Nutgram $bot */

use Nutgram\Laravel\Middleware\ValidateWebAppData;
use SergiX44\Nutgram\Nutgram;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->onCommand('start', function (Nutgram $bot): void {
    $bot->sendMessage('Hello, world!');
})->description('The start command!');

Route::middleware(ValidateWebAppData::class)->group(function (): void {
    // your routes here
});
