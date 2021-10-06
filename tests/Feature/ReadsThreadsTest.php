<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class ReadsThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public $thread;

    public function setUp():void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();

    }

    /** @test */
    public function a_user_can_see_all_threads()
    {

        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);

        $response = $this->get('/thread/'.$this->thread->id);
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_see_single_thread()
    {

        $response = $this->get('/thread/'.$this->thread->id);

        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_replies_that_are_associated_with_a_thread()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);
        $this->get('/thread/'.$this->thread->id)
            ->assertSee($reply->body);
    }
}
