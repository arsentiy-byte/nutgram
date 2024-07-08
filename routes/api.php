<?php

declare(strict_types=1);

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('base');
Route::post('/webhook', TelegramController::class)->name('webhook');
