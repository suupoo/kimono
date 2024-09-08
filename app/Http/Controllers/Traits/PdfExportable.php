<?php

namespace App\Http\Controllers\Traits;

use App\UseCases\ResourceAction\ExportPdfAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait PdfExportable
{
    /**
     * PDFエクスポート
     */
    public function exportPdf(Request $request, ExportPdfAction $action): RedirectResponse|StreamedResponse
    {
        if (! isset($this->exportResource)) {
            throw new \RuntimeException('exportResourceプロパティが設定されていません');
        }

        // リソースクラスを設定
        $action->setExportResourceClass($this->exportResource);

        return $action($request, $this->model::class);
    }
}
