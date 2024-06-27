<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_非ログイン時はユーザ一覧からログインページへリダイレクト(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }

    public function test_ログイン時はユーザ一覧画面が表示できる(): void
    {
        // Arrange（準備）
        $user = User::factory()->create(['name' => 'テスト太郎']);

        // Act（実行）
        $response = $this->actingAs($user)
            ->get('users');

        // Assert（検証）
        $response
            ->assertOk()
            ->assertSee('テスト太郎');
    }
}
