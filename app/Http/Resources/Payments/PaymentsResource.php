<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'status' => $this->status,
            'approved_by' => optional($this->approvedBy)->name(),
            'created_at' => $this->created_at->format('l, F jS, Y - g:iA'),
            'updated_at' => $this->updated_at,
        ];
    }
}
