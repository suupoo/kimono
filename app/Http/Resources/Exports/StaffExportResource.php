<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

class StaffExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Staff\OwnerSequenceNo,
            new \App\ValueObjects\Staff\Name,
            new \App\ValueObjects\Staff\Code,
            new \App\ValueObjects\Staff\Tel,
            new \App\ValueObjects\Staff\StaffPosition,
            new \App\ValueObjects\Staff\JoinDate,
            new \App\ValueObjects\Staff\QuitDate,
            new \App\ValueObjects\Staff\Tags,
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
            'tel'               => $this->resource->tel,
            'staff_position'    => $this->resource->staff_position?->label(),
            'join_date'         => $this->resource->join_date?->format('Y/m/d'),
            'quit_date'         => $this->resource->quit_date?->format('Y/m/d'),
            'tags'              => $this->resource->tags?->pluck('name')->join('/'),
        ];
    }
}
