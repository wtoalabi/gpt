<?php

namespace App\Http\Requests\Exams_Questions\Exams;

use App\Http\Requests\BaseFormRequests;
use Illuminate\Foundation\Http\FormRequest;

class CreateExamRequest extends BaseFormRequests
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'name_id' => 'required|string',
            'version' => 'required|string',
        ];
    }
}
