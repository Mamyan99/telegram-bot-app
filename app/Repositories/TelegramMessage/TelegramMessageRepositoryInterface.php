<?php

namespace App\Repositories\TelegramMessage;

use App\Models\TelegramMessages;
use Illuminate\Database\Eloquent\Collection;

interface TelegramMessageRepositoryInterface
{
    public function save(TelegramMessages $messages): bool;
    public function index(): Collection;
    public function getMessageByMessageId(int $messageId): TelegramMessages;
}