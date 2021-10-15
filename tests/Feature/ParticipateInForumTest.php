<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->post("/threads/some-channel/1/replies",[])->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        // Given me a authenticated user
        $authenticatedUser = $this->signIn(create(User::class));
        // And a existing thread
        $thread = create(Thread::class);
        // When the user adds a replay to the thread
        $reply = make(Reply::class);

        $this->post("/threads/$thread->channel->slug/$thread->id/replies", $reply->toArray());

        // Then their reply should be visible on the page
        $response = $this->get($thread->path());

        $response->assertSee($reply->body);
    }
}
