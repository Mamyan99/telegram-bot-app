<?php

namespace App\Repositories\TelegramMessage;

use App\Models\TelegramMessages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TelegramMessageRepository implements TelegramMessageRepositoryInterface
{
    private function query(): Builder
    {
        return TelegramMessages::query();
    }

    public function save(TelegramMessages $messages): bool
    {
        $messages->save();

        return true;
    }

    public function index(): Collection
    {
        //Here we can add pagination, if we need

        return $this->query()
            ->get();
    }

    public function getMessageByMessageId(int $messageId): TelegramMessages
    {
        return $this->query()
            ->where('message_id', $messageId)
            ->first();

    }
}