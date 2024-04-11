<?php

namespace App\Http\Dto\TelegramMessageDto;

use Spatie\LaravelData\Data;

class TelegramMessageDto extends Data
{
    public int $messageId;
    public ?int $parentMessageId;
    public int $fromUserId;
    public string $fromFirstName;
    public string $fromUserUsername;

    public int $chatId;
    public int $date;
    public string $message;
}