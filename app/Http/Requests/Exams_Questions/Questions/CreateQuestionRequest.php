<?php

namespace App\Http\Requests\Exams_Questions\Questions;

use App\Http\Requests\BaseFormRequests;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends BaseFormRequests
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
            'question' => 'required|string',
            'intro' => 'nullable|string',
            'isPureText' => 'nullable|boolean',
            'options' => 'required',
            'question' => 'required|string',
            'number' => ['required', 'numeric', 'between:1,100'],
            'exam' => 'required',
            'answer' => 'nullable',
            'subject' => 'required',
            'explain' => 'nullable',
            'year' => 'required',
        ];
    }
}
