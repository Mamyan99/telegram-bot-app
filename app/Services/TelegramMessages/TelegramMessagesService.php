<?php

namespace App\Services\TelegramMessages;

use App\Http\Dto\TelegramMessageDto\TelegramMessageDto;
use App\Library\Telegram\TelegramLibrary;
use App\Models\TelegramMessage;
use App\Repositories\TelegramMessage\TelegramMessageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TelegramMessagesService
{
    public function __construct(
        protected readonly TelegramMessageRepositoryInterface $telegramMessageRepository,
        protected readonly TelegramLibrary $telegramLibrary
    ) {}

    public function index(): Collection
    {
        return $this->telegramMessageRepository->index();
    }

    public function answer(int $messageId, string $messageText): void
    {
        $message = $this->telegramMessageRepository->getMessageByMessageId($messageId);

        $data = [
            'chat_id' => $message->chat_id,
            'reply_parameters' => json_encode([
                'message_id' => $message->message_id,
            ]),
            'text' => $messageText
        ];

        $response = $this->telegramLibrary->sendMessage($data);

        if ($response['ok'] ?? false) {
            $data = $response['result'];

            $dto = TelegramMessageDto::from([
                    'messageId' => $data['message_id'],
                    'parentMessageId' => $data['reply_to_message']['message_id'],
                    'fromUserId'=> $data['from']['id'],
                    'fromFirstName'=> $data['from']['first_name'],
                    'fromUserUsername' => $data['from']['username'],
                    'chatId' => $data['chat']['id'],
                    'date' => $data['date'],
                    'message' => $data['text'],
                ]
            );

            $message = TelegramMessage::create($dto);
            $this->telegramMessageRepository->save($message);
        }
    }
}