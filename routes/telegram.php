<?php

use App\Http\Controllers\Webhook\TelegramWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/handle-webhook', [TelegramWebhookController::class, 'handleWebhook']);