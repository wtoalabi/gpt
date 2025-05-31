<?php

namespace App\Models\Base\Authorization;

use App\Models\Base\BaseModel;
use App\Models\Base\CustomQuery;
use App\Models\Base\Permissible;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends BaseModel {
    use HasFactory, CustomQuery;
    //protected $withCount =['permissions'];
    protected $fillable = ['title','description'];
    protected $casts = [
        'isCore' => 'bool'
    ];
    protected $withCount = ['permissions'];
    public function staffs() {
        return $this->belongsToMany(Staff::class,'staff_roles');
    }
    public function permissions() {
        return $this->belongsToMany(Permission::class,'role_permissions');
    }

}
