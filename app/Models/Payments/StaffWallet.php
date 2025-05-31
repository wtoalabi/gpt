<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\BaseModel;

class StaffWallet extends BaseModel
{
    use HasFactory;
    protected $casts = [
        'status' => 'bool',
    ];
}
