<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

/**
 * Class UserExportResource
 *
 * @property mixed id
 * @property mixed owner_sequence_no
 * @property mixed name
 * @property mixed email
 * @property mixed email_verified_at
 * @property mixed tags
 */
class UserExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Column\User\OwnerSequenceNo,
            new \App\ValueObjects\Column\User\Name,
            new \App\ValueObjects\Column\User\Email,
            new \App\ValueObjects\Column\User\EmailVerifiedAt(),
            new \App\ValueObjects\Column\User\Tags,
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
            'email' => $this->resource->email,
            'email_verified_at' => $this->resource->email_verified_at?->format('Y/m/d'),
            'tags' => $this->resource->tags,
        ];
    }
}
