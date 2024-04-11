<?php

namespace App\Services\TelegramWebhook;

use App\Http\Dto\TelegramMessageDto\TelegramMessageDto;
use App\Models\TelegramMessages;
use App\Repositories\TelegramMessage\TelegramMessageRepositoryInterface;

class TelegramWebhookService
{
    public function __construct(
        protected readonly TelegramMessageRepositoryInterface $telegramMessageRepository
    ) {}

    public function handleWebhook(TelegramMessageDto $dto): void
    {
        $message = TelegramMessages::create($dto);

        $this->telegramMessageRepository->save($message);
    }
}