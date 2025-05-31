<?php

namespace App\Http\Requests\Exams_Questions\Subjects;

use App\Http\Requests\BaseFormRequests;

class UpdateSubjectRequest extends BaseFormRequests
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
            'selected_exams' => 'nullable',
        ];
    }
}
