<?php

namespace App\Console\Commands;

use App\Enums\AdministratorRole;
use App\Models\MSystemAdministrator;
use App\ValueObjects\Master\Administrator\Email;
use App\ValueObjects\Master\Administrator\Name;
use App\ValueObjects\Master\Administrator\Password;
use App\ValueObjects\Master\Administrator\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomAdminAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-admin:add {name} {email} {--init}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a administrator for custom-cms package.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = MSystemAdministrator::getTable();
        if (! DB::table($table)->exists()) {
            // テーブルが存在していない場合
            throw new \Exception("$table table is not exists. Please run php artisan migrate first.");
        }

        $administratorRoles = [];
        foreach (AdministratorRole::cases() as $administratorRole) {
            $administratorRoles[] = $administratorRole->value;
        }

        $name = $this->argument('name');
        $email = $this->argument('email');
        if ($this->option('init')) {
            // 初期化の場合
            $password = 'password';
            $role = AdministratorRole::SYSTEM->value;
        } else {
            // 通常実行
            $password = $this->secret('Please enter the password of the administrator.');
            $role = $this->choice('Please select the role of the administrator.', $administratorRoles);
        }

        // メールアドレスが既に存在しているか確認
        if (MSystemAdministrator::where(Email::NAME, $email)->exists()) {
            // 存在している場合
            throw new \Exception('Administrator '.$email.' is already exists.');
        }

        // カラムインスタンスを生成
        $columnName = new Name;
        $columnEmail = new Email;
        $columnPassword = new Password;
        $columnRole = new Role;

        // バリデーション
        Validator::validate([
            $columnName::NAME => $name,
            $columnEmail::NAME => $email,
            $columnPassword::NAME => $password,
            $columnPassword::NAME.'_confirmation' => $password,
            $columnRole::NAME => $role,
        ], [
            $columnName::NAME => $columnName->rules(),
            $columnEmail::NAME => $columnEmail->rules(),
            $columnPassword::NAME => $columnPassword->rules(),
            $columnRole::NAME => $columnRole->rules(),
        ]);

        // データ生成
        MSystemAdministrator::create([
            Name::NAME => $name,
            Email::NAME => $email,
            Password::NAME => bcrypt($password),
            Role::NAME => $role,
        ]);
    }
}
