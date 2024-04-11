<?php

namespace App\Http\Requests\Webhook;

use Illuminate\Foundation\Http\FormRequest;

class HandleWebhookRequest extends FormRequest
{
    const MESSAGE = 'message';
    const MESSAGE_ID = 'message.message_id';
    const FROM_USER_ID = 'message.from.id';
    const FROM_USER_FIRST_NAME = 'message.from.first_name';
    const FROM_USER_USERNAME = 'message.from.username';
    const CHAT_ID = 'message.chat.id';
    const DATE = 'message.date';
    const TEXT = 'message.text';
    const PARENT_MESSAGE_ID = 'message.reply_to_message.message_id';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::MESSAGE => [
                'required',
                'array',
            ],
            self::MESSAGE_ID => [
                'required',
                'int',
            ],
            self::PARENT_MESSAGE_ID => [
                'nullable',
                'int',
            ],
            self::FROM_USER_ID => [
                'required',
                'int',
            ],
            self::FROM_USER_FIRST_NAME => [
                'required',
                'string',
            ],
            self::FROM_USER_USERNAME => [
                'required',
                'string',
            ],
            self::CHAT_ID => [
                'required',
                'int',
            ],
            self::DATE => [
                'required',
                'int',
            ],
            self::TEXT => [
                'required',
                'string',
            ],
        ];
    }

    public function getMessageId(): int
    {
        return $this->input(self::MESSAGE_ID);
    }

    public function getParentMessageId(): ?int
    {
        return $this->input(self::PARENT_MESSAGE_ID);
    }

    public function getFromUserId(): int
    {
        return $this->input(self::FROM_USER_ID);
    }

    public function getFromUserFirstName(): string
    {
        return $this->input(self::FROM_USER_FIRST_NAME);
    }

    public function getFromUserUsername(): string
    {
        return $this->input(self::FROM_USER_USERNAME);
    }

    public function getChatId(): int
    {
        return $this->input(self::CHAT_ID);
    }

    public function getDate(): int
    {
        return $this->input(self::DATE);
    }

    public function getMessage(): string
    {
        return $this->input(self::TEXT);
    }
}
