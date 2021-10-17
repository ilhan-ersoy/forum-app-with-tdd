<?php
namespace Tests\Feature;

use App\Models\Channel;
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
        $thread = make(Thread::class);
        // if the user is not authenticated then must redirecting to login page
        $this->post("/threads", $thread->toArray())->assertRedirect('login');
    }

    /** @test */
    public function guest_may_not_visit_thread_create_page()
    {
        $this->get("/threads/create")->assertRedirect('login');
    }

    /** @test */
    public function an_unauthenticated_user_can_create_new_forum_threads()
    {
        $this->actingAs(create(User::class));

        $thread = make(Thread::class, ['id' => 1]);

        $this->post('/threads', $thread->toArray());

        $response = $this->get($thread->path());

        $response->assertSee($thread->title);

        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null, 'id' => 1])->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null, 'id' => 1])->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_required_a_valid_channel()
    {
        Channel::factory(2)->create();

        $this->publishThread(['channel_id' => null, 'id' => 1])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['id' => 1, 'channel_id' => 999 ])
            ->assertSessionHasErrors('channel_id');


    }

    public function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = make(Thread::class, $overrides);

        return $this->post('/threads', $thread->toArray());
    }

}
