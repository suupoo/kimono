<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

class StockExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Stock\OwnerSequenceNo,
            new \App\ValueObjects\Stock\Name,
            new \App\ValueObjects\Stock\Price,
            new \App\ValueObjects\Stock\Quantity,
            new \App\ValueObjects\Stock\Tags,
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
            'price'             => $this->resource->price,
            'quantity'          => $this->resource->quantity,
            'tags'              => $this->resource->tags,
        ];
    }
}
