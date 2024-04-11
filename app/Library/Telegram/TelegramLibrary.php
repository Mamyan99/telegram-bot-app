<?php

namespace App\Library\Telegram;

use Ixudra\Curl\Facades\Curl;

class TelegramLibrary
{
    const METHOD_POST = 'post';
    const METHOD_GET = 'get';
    const TELEGRAM_SET_WEBHOOK_PATH = '/setWebhook';
    const TELEGRAM_SEND_MESSAGE_PATH = '/sendMessage';
    const APP_WEBHOOK_PATH = '/telegram/handle-webhook';

    public function setWebhookUrl()
    {
        $url = config('telegram.telegram-bot-url') . self::TELEGRAM_SET_WEBHOOK_PATH;
        $webhookUrl = config('telegram.app-webhook-base-url') . self::APP_WEBHOOK_PATH;

        $data = [
            'url' => $webhookUrl
        ];

        return $this->sendRequest($url, self::METHOD_POST, $data);
    }

    private function sendRequest(string $url, string $method, array $data = [])
    {
        $response = Curl::to($url)
            ->withData($data)
            ->$method();

        return json_decode($response, true);
    }

    public function sendMessage(array $data)
    {
        $url = config('telegram.telegram-bot-url') . self::TELEGRAM_SEND_MESSAGE_PATH;

        $response = $this->sendRequest($url, self::METHOD_POST, $data);

        return $response;
    }
}