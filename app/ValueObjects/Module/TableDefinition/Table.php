<?php

namespace App\ValueObjects\Module\TableDefinition;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use stdClass;

class Table
{
    protected string $name;
    protected Collection $columns;
    protected Collection $uniqueKeys;
    protected Collection $foreignKeys;

    public function __construct(stdClass $data)
    {
        // stdClassオブジェクトで
        // "Tables_in_cms_template" => "cache"
        // という形式のデータが渡されるので、配列に変換して最初の要素をテーブル名として取得する
        $dataToArray = (array) $data;
        $this->name = array_values($dataToArray)[0];
        $this->columns = new Collection();
        $this->uniqueKeys = new Collection();
        $this->foreignKeys = new Collection();
    }

    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }
        return null;
    }

    /**
     * カラムを追加する
     * @param Column $column
     * @return void
     */
    public function addColumn(Column $column): void
    {
        $this->columns->push($column);
    }

    /**
     * ユニークキーを追加する
     * @param Collection $uniqueKeys
     * @return void
     */
    public function addUniqueKeys(Collection $uniqueKeys): void
    {
        $uniqueKeys->map(function ($uniqueKey) {
            $this->uniqueKeys->push(new Constraint($uniqueKey));
        });
    }

    /**
     * 外部キーを追加する
     * @param Collection $foreignKeys
     * @return void
     */
    public function addForeignKeys(Collection $foreignKeys): void
    {
        $foreignKeys->map(function ($foreignKey) {
            $this->foreignKeys->push(new Constraint($foreignKey));
        });
    }

    /**
     * マークダウン形式に変換する
     * @return string
     */
    public function toMarkdown(): string
    {
        // テーブル名を追加
        $markdown = "# {$this->name}\n\n";
        $markdown .= "## カラム一覧\n\n";
        $markdown .= "| Field | Type | Null | Key | Default | Extra | Privileges | Comment |\n";
        $markdown .= "| --- | --- | --- | --- | --- | --- | --- | --- |\n";
        foreach ($this->columns as $column) {
            $markdown .= "| {$column->name} | {$column->type} | {$column->nullable} | {$column->key} | {$column->default} | {$column->extra} | {$column->privileges} | {$column->comment} |\n";
        }

        // キー制約情報がある場合は追加
        if($this->foreignKeys->isNotEmpty()||$this->uniqueKeys->isNotEmpty()){

            $markdown .= "## キー制約\n\n";

            // 外部キー制約
            if ($this->foreignKeys->isNotEmpty()) {
                $markdown .= "### 外部キー制約\n\n";
                $markdown .= "| Constraint | Column | Reference | Comment |\n";
                $markdown .= "| --- | --- | --- | --- |\n";
                foreach ($this->foreignKeys as $foreignKey) {
                    $markdown .= "| {$foreignKey->constraintName} | {$foreignKey->columnName} | {$foreignKey->reference} | {$foreignKey->comment} |\n";
                }
                $markdown .= "\n";
            }

            // ユニークキー制約
            if ($this->uniqueKeys->isNotEmpty()) {
                $markdown .= "### ユニークキー制約\n\n";
                $markdown .= "| Constraint | Column | Comment |\n";
                $markdown .= "| --- | --- | --- |\n";
                foreach ($this->uniqueKeys as $uniqueKey) {
                    $markdown .= "| {$uniqueKey->constraintName} | {$uniqueKey->columnName} | {$uniqueKey->comment} |\n";
                }
            }
        }

        return $markdown;
    }
}
