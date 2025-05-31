<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalsResource extends JsonResource
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
            'bank_name' => $this->bank->bank_name,
            'requester' => $this->requester->name(),
            'requesterID' => $this->requester->id,
            'approved_by' => optional($this->approvedBy)->name() ?? '-',
            'account_number' => $this->bank->account_number,
            'created_at' => $this->created_at->format('l, F jS, Y - g:iA'),
            'updated_at' => $this->created_at->eq($this->updated_at) ? '-' : $this->updated_at->format('d/m/Y  - h:iA') ,
            'wallet_balance' => optional($this->requester->wallet)->balance ?? 0,
        ];
    }
}
