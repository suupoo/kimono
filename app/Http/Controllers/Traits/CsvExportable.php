<?php

namespace App\Http\Controllers\Traits;

use App\UseCases\ResourceAction\ExportCsvAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait CsvExportable
{
    /**
     * CSVエクスポート
     */
    public function exportCsv(Request $request, ExportCsvAction $action): RedirectResponse|StreamedResponse
    {
        if (! isset($this->exportResource)) {
            throw new \RuntimeException('exportResourceプロパティが設定されていません');
        }

        // リソースクラスを設定
        $action->setExportResourceClass($this->exportResource);

        return $action($request, $this->model::class);
    }
}
