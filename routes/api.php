<?php

declare(strict_types=1);

use App\Http\Controllers\IndexController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('base');
Route::post('/webhook', WebhookController::class)->name('webhook');
