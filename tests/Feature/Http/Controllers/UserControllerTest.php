<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User as ResourceModel; // モデル紐付け
use App\Enums\UserRole;
use Illuminate\Support\Facades\Log;
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
        $response = $this->get(route($this->resourcePrefix.'.index',[
            'sort' => 'id',
            'order' => 'asc',
        ]));

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
            'password_confirmation' => 'password',
            'role' => UserRole::NORMAL->value
        ];

        // 登録処理
        $response = $this->post(route("$this->resourcePrefix.store"), $storeData);

        // 登録後のリダイレクト先が正しいか
        $response->assertRedirect(route("$this->resourcePrefix.index"));

        // $storeDataから$columnsに存在するカラムのみ抽出
        $search = [];
        $model = new ResourceModel();
        foreach ($model->getColumns() as $column) {
            $columnName = $column->columnName();
            if (array_key_exists($columnName, $storeData)) {
                $search[$columnName] = $storeData[$columnName];
            }
        }


        // 登録データがDBに保存されているか
        $this->assertDatabaseHas(ResourceModel::class, $search);
    }

    public function test_ログイン時にユーザの更新ができる(): void
    {
        // ログイン
        $this->login();

        $user = ResourceModel::factory([
            'name' => 'テスト更新太郎',
            'email' => 'update@example.cm',
            'role' => UserRole::NORMAL->value
        ])->create();


        $updateData = [
            'name' => 'テスト太郎更新終わり',
            'email' => 'updated@example.com',
            'role' => UserRole::ADMIN->value
        ];

        // 登録処理
        $response = $this->put(route("$this->resourcePrefix.update",[
            'id' => $user->id,
        ]), $updateData);

        // 登録後のリダイレクト先が正しいか
        $response->assertRedirect(route("$this->resourcePrefix.show",[
            'id' => $user->id,
        ]));

        // $storeDataから$columnsに存在するカラムのみ抽出
        $search = [];
        $model = new ResourceModel();
        foreach ($model->getColumns() as $column) {
            $columnName = $column->columnName();
            if (array_key_exists($columnName, $updateData)) {
                $search[$columnName] = $updateData[$columnName];
            }
        }


        // 登録データがDBに保存されているか
        $this->assertDatabaseHas(ResourceModel::class, $search);

        // 登録データ数が1件であるか
        $this->assertDatabaseCount(ResourceModel::class, 1);
    }
}
