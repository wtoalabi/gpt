<?php

namespace App\Http\Requests\Staff;

use App\Http\Requests\BaseFormRequests;
use App\Models\Staff\Staff;

class UpdateStaffRequest extends BaseFormRequests
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $staff = Staff::find(request('id'));
        return [
            'id' => 'required',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => $staff->email === request('email') ? ['required', 'string', 'email'] : ['required', 'string',
                'email', 'unique:staff'],
            'password' => 'nullable|min:6',
            'role' => 'nullable'
        ];
    }
}
