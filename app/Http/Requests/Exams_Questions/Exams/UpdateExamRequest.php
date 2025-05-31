<?php

namespace App\Http\Requests\Exams_Questions\Exams;

use App\Http\Requests\BaseFormRequests;

class UpdateExamRequest extends BaseFormRequests
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'id' => 'required',
            'name' => 'required|string',
            'name_id' => 'required|string',
            'version' => 'required',
        ];
    }
}
