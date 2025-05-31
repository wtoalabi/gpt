<?php

namespace App\Http\Requests\Staff;

use App\Http\Requests\BaseFormRequests;
use Illuminate\Foundation\Http\FormRequest;

class CreateStaffFormRequest extends BaseFormRequests
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:staff',
            'password' => 'required|min:6',
            'role' => 'required'
        ];
    }
}
