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
        $user = User::factory()->create();
        $this->be($user);
        // And a existing thread
        $thread = Thread::factory()->create();
        // When the user adds a replay to the thread
        $reply = Reply::factory()->make();

        $this->post("/threads/$thread->id/replies", $reply->toArray());

        // Then their reply should be visible on the page

        $this->get("/thread/$thread->id")
                ->assertSee($reply->body);

    }
}
