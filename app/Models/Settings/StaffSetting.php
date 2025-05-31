<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\BaseModel;

class StaffSetting extends BaseModel
{
    use HasFactory;
    protected $fillable = ['id','description','title','value'];
}
