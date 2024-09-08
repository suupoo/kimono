<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseExportResource extends JsonResource
{
    /**
     * CSV出力時のヘッダーを返す
     */
    public function csvHeaders(): array
    {
        return [
            // new App\ValueObjects\Model\ColumnValueObjects,
        ];
    }

    /**
     * CSV出力時のヘッダー名を返す
     */
    public function csvHeadersNames(): array
    {
        return array_map(function ($header) {
            return $header->label();
        }, $this->csvHeaders());
    }
}
