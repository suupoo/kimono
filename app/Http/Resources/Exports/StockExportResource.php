<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

/**
 * Class StockExportResource
 *
 * @property mixed id
 * @property mixed owner_sequence_no
 * @property mixed name
 * @property mixed price
 * @property mixed quantity
 * @property mixed tags
 */
class StockExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Column\Stock\OwnerSequenceNo,
            new \App\ValueObjects\Column\Stock\Name,
            new \App\ValueObjects\Column\Stock\Price,
            new \App\ValueObjects\Column\Stock\Quantity,
            new \App\ValueObjects\Column\Stock\Tags,
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
            'name' => $this->resource->name,
            'price' => $this->resource->price,
            'quantity' => $this->resource->quantity,
            'tags' => $this->resource->tags,
        ];
    }
}
