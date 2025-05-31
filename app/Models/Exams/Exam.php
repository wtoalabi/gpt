<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\CustomQuery;
use App\Models\Base\BaseModel;
use App\Models\Base\Permissible;
use App\Models\Base\Recordable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Exam extends BaseModel
{
    use HasFactory, CustomQuery, SoftDeletes;

    protected $fillable = [
        'id', 'name', 'version','name_id'
    ];
    
    public function subjects(){
        return $this->belongsToMany(Subject::class, 'exam_subjects');
    }
    
}

