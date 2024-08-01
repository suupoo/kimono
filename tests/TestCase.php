<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected const LOGIN_USER_NAME = 'テスト太郎';

    protected function login($user = null)
    {
        $user = $user ?? User::factory(['name' => self::LOGIN_USER_NAME])->create();

        $this->actingAs($user);

        return $user;
    }
}
