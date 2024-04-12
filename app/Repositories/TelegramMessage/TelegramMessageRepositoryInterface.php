<?php

namespace App\Repositories\TelegramMessage;

use App\Models\TelegramMessage;
use Illuminate\Database\Eloquent\Collection;

interface TelegramMessageRepositoryInterface
{
    public function save(TelegramMessage $messages): bool;
    public function index(): Collection;
    public function getMessageByMessageId(int $messageId): TelegramMessage;
}