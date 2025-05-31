<?php

namespace App\Http\Resources\Users;

use App\Helpers\Images;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user' =>[
                'phone' => $this->phone,
                'username' => $this->username,
                'token' => $this->token,
                'email' => $this->email,
            ]
        ];
    }
}
