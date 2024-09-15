<?php

namespace App\Console\Commands;

use App\ValueObjects\Module\TableDefinition\Column;
use App\ValueObjects\Module\TableDefinition\Table;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CustomTableUpdateDocument extends Command
{
    protected string $fileName = 'definition.md';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-table:update-document';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tables documents.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (env('APP_ENV') !== 'local') {
            throw new \Exception("This command can only be executed in the local environment.");
        }

        $this->updateTableDefinition();
    }

    private function updateTableDefinition()
    {
        $tableData = [];

        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            // テーブル用のオブジェクトを生成
            $tableObject = new Table($table);

            // テーブルのカラム情報を取得
            $columns = DB::select("SHOW FULL COLUMNS FROM {$tableObject->name}");
            foreach ($columns as $column) {
                //  テーブル用カラムに変換
                $columnObject = new Column($column);
                $tableObject->addColumn($columnObject);
            }

            // 外部キー制約の情報を取得
            $foreignData = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where("TABLE_SCHEMA", config('database.connections.mysql.database'))
                ->where("CONSTRAINT_NAME", "LIKE", "%foreign%")
                ->where("TABLE_NAME", $tableObject->name)
                ->get();
            $tableObject->addForeignKeys($foreignData);

            // ユニークキー制約の情報を取得
            $uniqueData = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where("TABLE_SCHEMA", config('database.connections.mysql.database'))
                ->where("CONSTRAINT_NAME", "LIKE", "%unique%")
                ->where("TABLE_NAME", $tableObject->name)
                ->get();
            $tableObject->addUniqueKeys($uniqueData);

            // テーブルの要素を追加
            $tableData[] = $tableObject->toMarkdown();
        }

        /**
         * マークダウン形式のテーブル定義ファイルを作成する
         */

        $createdAt = \Carbon\Carbon::now()->format('Y年m月d日 H時i分s秒');

        // ファイルの先頭に追加する内容
        array_unshift($tableData,
            "# テーブル定義書 \n\n".
            "{$createdAt}\n\n" .
            "このファイルは自動生成されたファイルです。\n");

        // 配列を改行区切りの文字列に変換
        $export = implode("\n", $tableData);

        $tableDefinitionPath = database_path($this->fileName);
        if(!file_put_contents($tableDefinitionPath, $export, LOCK_EX)){
            echo "ファイルの書き込みに失敗しました";
        }
    }
}
