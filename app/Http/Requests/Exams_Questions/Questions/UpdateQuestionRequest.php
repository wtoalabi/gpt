<?php

namespace App\Http\Requests\Exams_Questions\Questions;

use App\Http\Requests\BaseFormRequests;

class UpdateQuestionRequest extends BaseFormRequests
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'id' => 'required',
            'question' => 'required|string',
            'intro' => 'nullable|string',
            'isPureText' => 'nullable|boolean',
            'options' => 'required',
            'number' => ['required', 'numeric', 'between:1,100'],
            'question' => 'required|string',
            'exam' => 'required',
            'subject' => 'required',
            'answer' => 'nullable',
            'year' => 'required',
            'explain' => 'nullable',
        ];
    }
}
