<?php

namespace Tests\Feature;

use Faker\Factory as Faker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class TelegramMessageWebhookHandleTest extends TestCase
{
    public function visitRoute(array $params): TestResponse
    {
        return $this->post('telegram/handle-webhook', $params);
    }

    public function test_it_cannot_handle_with_empty_data(): void
    {
        $data = [];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
    }

    public function test_it_cannot_handle_without_message_data(): void
    {
        $faker = Faker::create();

        $data = [
            'update_id' => $faker->randomDigit,
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
    }

    public function test_it_cannot_handle_without_from_data(): void
    {
        $faker = Faker::create();

        $data = [
            'update_id' => $faker->randomDigit,
            'message' => [
                'message_id' => $faker->randomDigit,
            ]
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
    }

    public function test_it_cannot_handle_without_chat_data(): void
    {
        $faker = Faker::create();

        $data = [
            'update_id' => $faker->randomDigit,
            'message' => [
                'message_id' => $faker->randomDigit,
                'from' => [
                    'id' => $faker->randomDigit,
                    'first_name' => $faker->name,
                    'username' => $faker->name
                ]
            ]
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
    }

    public function test_it_cannot_handle_without_chat_id_data(): void
    {
        $faker = Faker::create();

        $data = [
            'update_id' => $faker->randomDigit,
            'message' => [
                'message_id' => $faker->randomDigit,
                'from' => [
                    'id' => $faker->randomDigit,
                    'first_name' => $faker->name,
                    'username' => $faker->name
                ],
                'chat' => [

                ]
            ]
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
    }

    public function test_it_cannot_handle_without_date_data(): void
    {
        $faker = Faker::create();

        $data = [
            'update_id' => $faker->randomDigit,
            'message' => [
                'message_id' => $faker->randomDigit,
                'from' => [
                    'id' => $faker->randomDigit,
                    'first_name' => $faker->name,
                    'username' => $faker->name
                ],
                'chat' => [
                    'id' => $faker->randomDigit
                ]
            ]
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
    }

    public function test_it_can_handle(): void
    {
        $faker = Faker::create();

        $data = [
            'update_id' => $faker->randomDigit,
            'message' => [
                'message_id' => $faker->randomDigit,
                'from' => [
                    'id' => $faker->randomDigit,
                    'first_name' => $faker->name,
                    'username' => $faker->name
                ],
                'chat' => [
                    'id' => $faker->randomDigit
                ],
                'date' => $faker->unixTime,
                'text' => $faker->text
            ]
        ];

        $response = $this->visitRoute($data);

        $response->assertOk();
    }
}
