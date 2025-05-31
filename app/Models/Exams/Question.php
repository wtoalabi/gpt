<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base\CustomQuery;
use App\Models\Exams\Subject;
use App\Models\Staff\Staff;
use App\Models\Exams\Exam;
use App\Models\Base\BaseModel;
use App\Models\Base\Permissible;
use App\Models\Base\Recordable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends BaseModel
{
    use HasFactory, CustomQuery, SoftDeletes;

    protected $hidden = ['pivot','created_at','updated_at'];
    protected $fillable = ['id', 'intro','isPureText','options','question','year','answer','explain','number'];
    protected $casts = [
        'status' => 'bool',
        'isPureText' => 'bool',
    ];


    public function subjects(){
        return $this->belongsToMany(Subject::class, 'subject_questions');
    }

    public function subject(){
        return $this->subjects()->first();
    }

    public function exams(){
        return $this->hasManyThrough(
            Exam::class,//deployemnt
            Subject::class, //environment
            'id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }
    public function createdBy(){
        return $this->belongsTo(Staff::class,'created_by');
    }

        public function approvedBy(){
            return $this->belongsTo(Staff::class,'approved_by');
        }
    public function exam(){
        return optional($this->subject())->exam();
    
    }
    
    public function scopeRelatedQuestions($query){
        return $query->where('year', $this->year)
            ->whereHas('subjects', function ($q) {
                $q->whereIn('subjects.id', $this->subjects->pluck('id'));
            })->pluck('number')->toArray();
    }


}
