<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

/**
 * Class CompanyExportResource
 * @property mixed id
 * @property mixed owner_sequence_no
 * @property mixed name
 * @property mixed tags
 */
class CompanyExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Company\OwnerSequenceNo,
            new \App\ValueObjects\Company\Name,
            new \App\ValueObjects\Company\Tags,
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'owner_sequence_no' => $this->resource->owner_sequence_no,
            'name'              => $this->resource->name,
            'tags'              => $this->resource->tags,
        ];
    }
}
