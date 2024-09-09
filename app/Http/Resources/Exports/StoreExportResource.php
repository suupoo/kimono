<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

/**
 * Class StoreExportResource
 *
 * @property mixed id
 * @property mixed owner_sequence_no
 * @property mixed name
 * @property mixed code
 * @property mixed post_code
 * @property mixed prefecture
 * @property mixed address1
 * @property mixed address2
 * @property mixed tags
 */
class StoreExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Column\Store\OwnerSequenceNo,
            new \App\ValueObjects\Column\Store\Name,
            new \App\ValueObjects\Column\Store\Code,
            new \App\ValueObjects\Column\Store\PostCode,
            new \App\ValueObjects\Column\Store\Prefecture,
            new \App\ValueObjects\Column\Store\Address1,
            new \App\ValueObjects\Column\Store\Address2,
            new \App\ValueObjects\Column\Store\Tags,
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
            'code' => $this->resource->code,
            'post_code' => $this->resource->post_code,
            'prefecture' => $this->resource->prefecture?->label(),
            'join_date' => $this->resource->address1,
            'quit_date' => $this->resource->address2,
            'tags' => $this->resource->tags,
        ];
    }
}
