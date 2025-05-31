<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class Quiz extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','length','subject','answers'];
}
