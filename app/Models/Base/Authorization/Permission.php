<?php

namespace App\Models\Base\Authorization;

use App\Models\Base\BaseModel;
use App\Models\Base\CustomQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends BaseModel
{
    use HasFactory, CustomQuery;
    public $timestamps = false;
}
