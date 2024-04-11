<?php

use App\Http\Controllers\TelegramMessages\TelegramMessagesController;
use Illuminate\Support\Facades\Route;

Route::post('/message/{message_id}/answer', [TelegramMessagesController::class, 'sendMessage']);
