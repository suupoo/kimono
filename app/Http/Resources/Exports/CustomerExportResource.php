<?php

namespace App\Http\Resources\Exports;

use Illuminate\Http\Request;

/**
 * Class CustomerExportResource
 *
 * @property mixed id
 * @property mixed owner_sequence_no
 * @property mixed customer_name
 * @property mixed post_code
 * @property mixed address1
 * @property mixed address2
 * @property mixed tags
 */
class CustomerExportResource extends BaseExportResource
{
    public function csvHeaders(): array
    {
        return [
            new \App\ValueObjects\Customer\OwnerSequenceNo,
            new \App\ValueObjects\Customer\CustomerName,
            new \App\ValueObjects\Customer\PostCode,
            new \App\ValueObjects\Customer\Prefecture,
            new \App\ValueObjects\Customer\Address1,
            new \App\ValueObjects\Customer\Address2,
            new \App\ValueObjects\Customer\Note,
            new \App\ValueObjects\Customer\Tags,
        ];
    }

    /**
     * PDFへ出力する項目
     */
    public static function pdfOutputColumns(): array
    {
        return [
            new \App\ValueObjects\Customer\PostCode,
            'address',
            new \App\ValueObjects\Customer\CustomerName,
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
            'customer_name' => $this->resource->customer_name,
            'post_code' => $this->resource->post_code,
            'prefecture' => $this->resource->prefecture?->label(),
            'address_1' => $this->resource->address_1,
            'address_2' => $this->resource->address_2,
            'address' => $this->resource->address,
            'note' => $this->resource->note,
            'tags' => $this->resource->tags,
        ];
    }
}
