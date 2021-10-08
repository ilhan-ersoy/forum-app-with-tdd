<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // Sign In

    protected function signIn($user = null) {
        $user = $user ?: create(User::class);

        $this->actingAs($user);

        return $user;
    }
}
