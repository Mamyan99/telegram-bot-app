<?php

namespace App\Models;

use App\Http\Dto\TelegramMessageDto\TelegramMessageDto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\TelegramMessages
 *
 * @property int $id
 * @property int $chat_id
 * @property int $from_user_id
 * @property string $from_user_first_name
 * @property string $from_user_username
 * @property int $message_id
 * @property ?int $parent_message_id
 * @property string $message
 * @property Carbon $date
 */

class TelegramMessage extends Model
{
    use HasFactory;

    public static function create(TelegramMessageDto $dto)
    {
        $message = new self();

        $message->setChatId($dto->chatId);
        $message->setFromUserId($dto->fromUserId);
        $message->setFromUserFirstName($dto->fromFirstName);
        $message->setFromUserUsername($dto->fromUserUsername);
        $message->setMessageId($dto->messageId);
        $message->setParentMessageId($dto->parentMessageId);
        $message->setMessage($dto->message);
        $message->setDate($dto->date);

        return $message;
    }

    public function setChatId(int $chatId): void
    {
        $this->chat_id = $chatId;
    }

    public function setFromUserId(int $fromUserId): void
    {
        $this->from_user_id = $fromUserId;
    }

    public function setFromUserFirstName(string $fromUserFirstName): void
    {
        $this->from_user_first_name = $fromUserFirstName;
    }

    public function setFromUserUsername(string $fromUserUsername): void
    {
        $this->from_user_username = $fromUserUsername;
    }

    public function setMessageId(int $messageId): void
    {
        $this->message_id = $messageId;
    }

    public function setParentMessageId(?int $messageId): void
    {
        $this->parent_message_id = $messageId;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setDate(int $date): void
    {
        $this->date = Carbon::parse($date);
    }
}
