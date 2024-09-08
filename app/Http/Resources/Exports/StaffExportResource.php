<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

/**
 * Class StaffExportResource
 *
 * @property mixed id
 * @property mixed owner_sequence_no
 * @property mixed name
 * @property mixed code
 * @property mixed tel
 * @property mixed staff_position
 * @property mixed join_date
 * @property mixed quit_date
 * @property mixed tags
 */
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
            'name' => $this->resource->name,
            'code' => $this->resource->code,
            'tel' => $this->resource->tel,
            'staff_position' => $this->resource->staff_position?->label(),
            'join_date' => $this->resource->join_date,
            'quit_date' => $this->resource->quit_date,
            'tags' => $this->resource->tags,
        ];
    }
}
