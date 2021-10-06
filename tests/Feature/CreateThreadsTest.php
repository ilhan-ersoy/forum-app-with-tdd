<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function an_unauthenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed in user
        $this->actingAs(User::factory()->create());

        // When we hit the endpoint to create a new thread
        $thread = Thread::factory()->make();

        $this->post('/threads', $thread->toArray());

        // Then, when we visit the thread page

        $response = $this->get("/threads/$thread->id");

        // We should see the new thread
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }
}
