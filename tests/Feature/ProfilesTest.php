<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = $this->signIn();

        $this->get($user->path())
            ->assertSee($user->name);
    }

    /** @test */
    public function profiles_display_all_threads_created_by_the_associated_user()
    {
        $user = $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => $user->id]);


        $this->get($user->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }


}
