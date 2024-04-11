<?php

namespace App\Http\Requests\TelegramMessage;

use Illuminate\Foundation\Http\FormRequest;

class TelegramMessageRequest extends FormRequest
{
    const MESSAGE = 'message';
    const MESSAGE_ID = 'message_id';

    public function rules(): array
    {
        return [
            self::MESSAGE => [
                'required',
                'string',
            ],
        ];
    }

    public function getMessageId(): int
    {
        return $this->route(self::MESSAGE_ID);
    }

    public function getMessage(): string
    {
        return $this->input(self::MESSAGE);
    }
}
