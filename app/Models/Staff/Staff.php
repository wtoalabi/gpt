<?php

namespace App\Models\Staff;

use App\Models\Base\Authorization\Permission;
use App\Models\Base\Authorization\Role;
use App\Models\Base\CustomQuery;
use App\Models\Base\Recordable;
use App\Models\Exams\Question;
use App\Models\Payments\Payment;
use App\Models\Payments\StaffWallet;
use App\Models\Payments\StaffBank;
use App\Models\Payments\StaffWithdrawal;
use Database\Factories\StaffFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use App\Models\Base\Permissible;

use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Recordable, Permissible, CustomQuery, SoftDeletes;
    protected $casts = [
        'status' => 'boolean'
    ];

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','profile_image','questions_post_count'
    ];
    
    public function roles() {
        return $this->belongsToMany(Role::class,'staff_roles','staff_id','role_id');
    }
    
    public function role() {
        return $this->roles->first();
    }
    public function isSuper() {
        return $this->roles()->first()->title == 'Super Admin';
    }
   
    public function profile_image() {
        $basePath = "media/staff";
        if($this->profile_image){
            $path = "$basePath/$this->profile_image";
        }else{
            $path = "$basePath/default-thumb.png";
        }
        
        return asset(Storage::url($path));
    }
   
    public function name() {
        return $this->first_name .' '. $this->last_name;
    }
    
    public function permissions() {
        return $this->role()->permissions()->pluck('ability')->toArray();
    }
    
    protected static function newFactory() {
        return StaffFactory::new();
    }

    public function questions(){
        return $this->hasMany(Question::class, 'created_by');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'approved_by');
    }
    public function wallet(){
        return $this->hasOne(StaffWallet::class,'staff');
    }
    public function withdrawals(){
        return $this->hasMany(StaffWithdrawal::class,'staff');
    }
    public function banks(){
        return $this->hasMany(StaffBank::class,'staff');
    }
    public function total_withdrawals(){
        return $this->withdrawals->where('status', "Successful")->sum('amount');   
    }
    public function default_bank(){
        return $this->banks->where('default', 1)->first();
    }
}
