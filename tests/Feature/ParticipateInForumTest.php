<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        // Given me a authenticated user
        $authenticatedUser = $this->signIn(create(User::class));
        // And a existing thread
        $thread = create(Thread::class);
        // When the user adds a replay to the thread
        $reply = make(Reply::class);

        $this->post("/threads/$thread->id/replies", $reply->toArray());

        // Then their reply should be visible on the page

        $this->get("/thread/$thread->id")
                ->assertSee($reply->body);

    }
}
