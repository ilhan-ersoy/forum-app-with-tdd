<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_favorite_anything()
    {

        $this->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Models\Reply');
        $this->post('/replies/'.$reply->id.'/favorites');
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_may_not_favorite_reply_one_more()
    {
        $this->signIn();
        $reply = create('App\Models\Reply');
        $this->post('/replies/'.$reply->id.'/favorites');

        $this->post('/replies/'.$reply->id.'/favorites');

        $this->assertCount(1, $reply->favorites);
    }


}
