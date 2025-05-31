<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Staff\Staff;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Payment extends BaseModel
{
    use HasFactory;
    protected $casts = [
        'status' => 'bool',
    ];

    public function approvedBy(){
        return $this->belongsTo(Staff::class,'approved_by');
    }
}
