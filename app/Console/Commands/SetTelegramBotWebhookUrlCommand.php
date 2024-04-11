<?php

namespace App\Console\Commands;

use App\Library\Telegram\TelegramLibrary;
use Illuminate\Console\Command;

class SetTelegramBotWebhookUrlCommand extends Command
{
    protected $signature = 'set-telegram-bot-webhook-url';
    protected $description = 'Set telegram webhook url';

    public function handle(
        TelegramLibrary $telegramLibrary
    ) {
        $result = $telegramLibrary->setWebhookUrl();

        if (isset($result['result']) && $result['result']) {
            $this->info('Webhook URL successfully assigned');
        } else {
            $this->info('Something went wrong, please check your data and try again');
        }

    }
}
