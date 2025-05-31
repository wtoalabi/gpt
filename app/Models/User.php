<?php

namespace App\Models;

use App\Models\Messages\MessageThread;
use App\Models\Exams\Exam;
use App\Models\Exams\Quiz;
use App\Models\Plans\UserPlan;
use App\Models\Plans\UsersSetting;
use App\Models\Profile\UserProfile;
use App\Models\Settings\Setting;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Base\Recordable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Resources\Exams\SubjectsCollection;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Recordable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'username',
        'exam',
        'avatar',
        'subjects',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'bool',
        'subjects' => 'array'
    ];

    public function profile()
    {
        //return $this->hasOne(UserProfile::class);
        
    }
    
    
    public function plan()
    {
        //return $this->belongsToMany(Plan::class,'user_plans','user_id','plan_id');
    }


    public function settings()
    {
       // return $this->hasMany(UsersSetting::class,'user_id');
    }

    public function user_plan(){
        //return $this->plan->first();
    }

  
    
    /*public function message_threads() {
        return $this->hasMany(MessageThread::class,'sender','id');
    }*/

    public function exam(){
        return Exam::where('name_id', $this->exam)->first()->only(['name_id','name','version']);
    }

    public function subjects(){
        $exam = Exam::where('name_id', $this->exam)->first();
        //return 
        //dd($this->subjects);
        $subjects =  $exam->subjects->whereIn("name",$this->subjects)->all();
        //dd($subjects);
        return new SubjectsCollection($subjects);
        //return Exam::where('name_id', $this->exam)->first()->only(['name_id','name','version']);
    }

    public function quizzes(){
        return $this->hasMany(Quiz::class); 
    }
}
