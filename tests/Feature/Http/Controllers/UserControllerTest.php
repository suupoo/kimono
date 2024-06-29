<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User as ResourceModel; // モデル紐付け
use App\Enums\UserRole;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected string $resourcePrefix = 'users';

    public function test_非ログイン時はユーザ一覧からログインページへリダイレクト(): void
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('login');
    }

    public function test_ログイン時はユーザ一覧画面が表示できる(): void
    {
        // Arrange（準備）
        $this->login();

        // Act（実行）
        $response = $this->get("/$this->resourcePrefix?sort=id&order=asc'");

        // Assert（検証）
        $response
            ->assertOk()
            ->assertSee(parent::LOGIN_USER_NAME);
    }

    public function test_ログイン時にユーザの新規登録ができる(): void
    {
        // ログイン
        $this->login();

        $storeData = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => UserRole::NORMAL,
        ];

        // 登録処理
        $response = $this->post(route("$this->resourcePrefix.store"), $storeData);

        // 登録後のリダイレクト先が正しいか
        $response->assertRedirect(route("$this->resourcePrefix.edit", ResourceModel::first()));

        // 登録データがDBに保存されているか
        $this->assertDatabaseHas('users', $storeData);
    }
}
