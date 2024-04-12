<?php

namespace App\Http\Controllers\TelegramMessages;

use App\Events\TelegramMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TelegramMessage\TelegramMessageRequest;
use App\Services\TelegramMessages\TelegramMessagesService;
use Illuminate\Http\JsonResponse;

class TelegramMessagesController extends Controller
{
    public function sendMessage(
        TelegramMessageRequest $request,
        TelegramMessagesService $service
    ): JsonResponse {
        $service->answer($request->getMessageId(), $request->getMessage());

        return $this->response();
    }
}