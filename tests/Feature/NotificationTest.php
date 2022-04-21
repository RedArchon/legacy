<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_reminder_schedule_can_be_stored()
    {
        //assert reminder can be stored
        $response = $this->withHeaders([
            'X-SCHEDULER-HEADER' => 'secret!'
        ])
            ->post('/api/reminders/schedule', [
                'channel' => 'mail',
                'message' => 'lorem ipsum',
                'time' => now(),
                'email' => 'bruce@wayne.test'
            ]);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send_notification_command_exits_successfully()
    {
        $this->artisan('notifications:send')->assertSuccessful();
    }
}
