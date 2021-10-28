<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // Sign In

    protected function signIn($user = null, $attributes = []) {
        $user = $user ?: create(User::class, $attributes);

        $this->actingAs($user);

        return $user;

    }
}
