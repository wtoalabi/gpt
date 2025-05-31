<?php

namespace App\Http\Requests\Roles;

use App\Http\Requests\BaseFormRequests;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleFormRequest extends BaseFormRequests
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
            'title' => 'required|string|unique:roles',
            'description' => 'required|string'
        ];
    }
}
