<?php

namespace Tests\Feature;

use App\Library\Telegram\TelegramLibrary;
use App\Models\TelegramMessage;
use Faker\Factory as Faker;
use Faker\Generator;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class TelegramMessageReplyTest extends TestCase
{
    private TelegramMessage $message;
    private Generator $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Faker::create();
        $this->message = TelegramMessage::factory()->create();
        $messageId = $this->message->message_id;

        $this->mock(TelegramLibrary::class, function ($mock) use ($messageId) {
            $mock->shouldReceive('sendMessage')->andReturn($this->getSendMessageMockData($messageId));
        });
    }

    public function visitRoute(int $messageId, array $params): TestResponse
    {
        return $this->post("/api/message/$messageId/answer", $params);
    }

    public function test_it_cannot_handle_with_empty_data(): void
    {
        $data = [];

        $response = $this->visitRoute($this->message->message_id, $data);

        $response->assertUnprocessable();
    }

    public function test_it_cannot_handle_with_nonexistent_data(): void
    {
        $data = [
            'message' => $this->faker->text
        ];

        $response = $this->visitRoute($this->faker->numberBetween(1000, 10000), $data);

        $response->assertStatus(500);
    }

    public function test_it_can_reply(): void
    {
        $data = [
            'message' => $this->faker->text
        ];

        $response = $this->visitRoute($this->message->message_id, $data);

        $response->assertStatus(200);
    }

    private function getSendMessageMockData(int $messageId): array
    {
        return [
            'ok' => true,
            'result' => [
                'message_id' => $this->faker->randomDigit,
                'reply_to_message' => [
                    'message_id' => $messageId
                ],
                'from' => [
                    'id' => $this->faker->randomDigit,
                    'first_name' => $this->faker->name,
                    'username' => $this->faker->name
                ],
                'chat' => [
                    'id' => $this->faker->randomDigit
                ],
                'date' => $this->faker->unixTime,
                'text' => $this->faker->text
            ],

            'update_id' => $this->faker->randomDigit,
            'message' => [
                'message_id' => $this->faker->randomDigit,
                'from' => [
                    'id' => $this->faker->randomDigit,
                    'first_name' => $this->faker->name,
                    'username' => $this->faker->name
                ],
                'chat' => [
                    'id' => $this->faker->randomDigit
                ],
                'date' => $this->faker->unixTime,
                'text' => $this->faker->text
            ]
        ];

    }
}
