<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Dto\TelegramMessageDto\TelegramMessageDto;
use App\Http\Requests\Webhook\HandleWebhookRequest;
use App\Services\TelegramWebhook\TelegramWebhookService;

class TelegramWebhookController extends Controller
{
    public function handleWebhook(
        HandleWebhookRequest $request,
        TelegramWebhookService $service
    ) {
        $dto = TelegramMessageDto::from([
                'messageId' => $request->getMessageId(),
                'parentMessageId' => $request->getParentMessageId(),
                'fromUserId'=> $request->getFromUserId(),
                'fromFirstName'=> $request->getFromUserFirstName(),
                'fromUserUsername' => $request->getFromUserUsername(),
                'chatId' => $request->getChatId(),
                'date' => $request->getDate(),
                'message' => $request->getMessage(),
            ]
        );

        $service->handleWebhook($dto);

        return $this->response();
    }
}
