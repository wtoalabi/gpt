<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base\CustomQuery;
use App\Models\Base\BaseModel;
use App\Models\Base\Permissible;
use App\Models\Base\Recordable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subject extends BaseModel
{
    use HasFactory, SoftDeletes,CustomQuery;

    protected $fillable = [
        'id', 'name',
    ];

    public function exams(){
        return $this->belongsToMany(Exam::class, 'exam_subjects');
    }

    public function exam(){
        return $this->exams->first();
    }
    public function questions(){
        return $this->belongsToMany(Question::class, 'subject_questions');
    }
}
