<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function guest_may_not_create_thread()
    {
        $thread = create(Thread::class);
        $this->post("/threads", $thread->toArray())->assertRedirect('/login');
    }

    /** @test */
    public function guest_may_not_visit_thread_create_page()
    {
        $this->get("/threads/create")->assertRedirect('/login');
    }

    /** @test */
    public function an_unauthenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed in user
        $this->actingAs(create(User::class));

        // When we hit the endpoint to create a new thread
        $thread = create(Thread::class);

        $this->post('/threads', $thread->toArray());

        // Then, when we visit the thread page
        $response = $this->get("/thread/$thread->id");

        // We should see the new thread
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);

    }
}
