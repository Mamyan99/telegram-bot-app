<?php
return [
    'telegram-bot-base-url' => env('TELEGRAM_BASE_API_URL'),
    'telegram-bot-url' => env('TELEGRAM_BASE_API_URL') . env('TELEGRAM_BOT_TOKEN'),
    'telegram-bot-token' => env('TELEGRAM_BOT_TOKEN'),
    'app-webhook-base-url' => env('APP_WEBHOOK_BASE_URL'),
];