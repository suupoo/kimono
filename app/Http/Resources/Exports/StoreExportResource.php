<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

class StoreExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Store\OwnerSequenceNo,
            new \App\ValueObjects\Store\Name,
            new \App\ValueObjects\Store\Code,
            new \App\ValueObjects\Store\PostCode,
            new \App\ValueObjects\Store\Prefecture,
            new \App\ValueObjects\Store\Address1,
            new \App\ValueObjects\Store\Address2,
            new \App\ValueObjects\Store\Tags,
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
            'code'              => $this->resource->code,
            'post_code'         => $this->resource->post_code,
            'prefecture'        => $this->resource->prefecture?->label(),
            'join_date'         => $this->resource->address1,
            'quit_date'         => $this->resource->address2,
            'tags'              => $this->resource->tags,
        ];
    }
}
