<?php

namespace Database\Factories;

use App\Models\TelegramMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TelegramMessage>
 */
class TelegramMessageFactory extends Factory
{

    protected $model = TelegramMessage::class;


    public function definition(): array
    {
        return [

            'id' => $this->faker->numberBetween(1000, 10000),
            'chat_id' => $this->faker->randomDigit,
            'from_user_id' => $this->faker->randomDigit,
            'from_user_first_name' => $this->faker->name,
            'from_user_username' => $this->faker->userName,
            'message_id' => $this->faker->randomDigit,
            'message' => $this->faker->text,
            'date' => $this->faker->date
        ];
    }
}
