<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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
        $this->signIn();
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadInNotChannel = create(Thread::class);
        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadInNotChannel->title);
    }

    /** @test */
        public function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create(User::class,['name'=>'Ilhan']));

        $threadByIlhan = create(Thread::class, ['user_id' => auth()->id()]);
        $threadByNotIlhan = create(Thread::class);

        $this->get('/threads?by=Ilhan')
            ->assertSee($threadByIlhan->title)
            ->assertDontSee($threadByNotIlhan->title);

    }


}

