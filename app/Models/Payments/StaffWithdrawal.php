<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base\CustomQuery;
use App\Models\Base\BaseModel;
use App\Models\Staff\Staff;

class StaffWithdrawal extends BaseModel
{
    use HasFactory, CustomQuery;
    protected $fillable = ['amount','status','staff','approved_by','bank_id','updated_at'];
    
    public function requester(){
        return $this->belongsTo(Staff::class,'staff');
    }
    
    
    public function approvedBy(){
        return $this->belongsTo(Staff::class,'approved_by');
    }

    public function bank(){
        return $this->belongsTo(StaffBank::class,'bank_id');
    }
}
