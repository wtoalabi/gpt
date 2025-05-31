<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\BaseModel;
use App\Models\Staff\Staff;

class StaffBank extends BaseModel
{
    use HasFactory;
    protected $casts = [
        'default' => 'bool'
    ];
    protected $fillable = ['default','bank_name','account_name','account_number'];

    public function staff(){
        return $this->belongsTo(Staff::class,'staff');
    }
    public function staff_object(){
        //return $this->belongsTo(Staff::class,'staff');
    }
}
