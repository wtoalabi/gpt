<?php

namespace App\Http\Requests\Roles;

use App\Http\Requests\BaseFormRequests;

class UpdateRoleRequest extends BaseFormRequests
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required|string'
        ];
    }
}
