<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use phpDocumentor\Reflection\Types\This;
use Tests\TestCase;

class ReadsThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public $thread;

    public function setUp():void
    {
        parent::setUp();

        $this->thread = create(Thread::class);

    }

    /** @test */
    public function a_user_can_see_all_threads()
    {

        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);

        $response = $this->get($this->thread->path());
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_see_single_thread()
    {

        $response = $this->get($this->thread->path());

        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_replies_that_are_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_channel()
    {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadInNotChannel = create(Thread::class);
        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadInNotChannel->title);
    }


}

