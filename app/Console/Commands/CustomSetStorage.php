<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomSetStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-storage:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set SystemCompany Storage.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 引数で企業IDを受け取る
        $companyId = $this->ask('Please enter the company id.');

        // 受け取った企業が存在するか確認
        $mSystemCompany = \App\Models\MSystemCompany::findOrFail($companyId);

        // 存在している場合はコンソールに表示して確認[Y/n]
        if ($this->confirm('こちらの企業で正しいですか？: '.$mSystemCompany->name)) {
            // はいの場合は処理を続行

            // いずれかの値が設定されている場合は確認して上書きするか確認
            if ($mSystemCompany->conoha_tenant_username || $mSystemCompany->conoha_tenant_password || $mSystemCompany->conoha_tenant_id || $mSystemCompany->conoha_tenant_temporary_url_key || $mSystemCompany->conoha_container_name) {
                if (! $this->confirm('既に設定されている値があります。上書きしてもよろしいですか？')) {
                    return;
                }
            }

            // 更新処理
            $userName           = $this->ask('Please enter the Conoha username.');
            $password           = $this->secret('Please enter the Conoha password.');
            $tenantName         = $this->ask('Please enter the Conoha tenant name.');
            $tenantId           = $this->secret('Please enter the Conoha tenant id.');
            $temporaryUrlKey    = $this->secret('Please enter the Conoha temporary url key.');
            $containerName      = $this->ask('Please enter the Conoha container name.', $mSystemCompany->uuid);

            // 企業情報を更新
            $mSystemCompany->update([
                'conoha_tenant_username'          => $userName,
                'conoha_tenant_password'          => $password,
                'conoha_tenant_name'              => $tenantName,
                'conoha_tenant_id'                => $tenantId,
                'conoha_tenant_temporary_url_key' => $temporaryUrlKey,
                'conoha_container_name'           => $containerName,
            ]);
        }
    }
}
