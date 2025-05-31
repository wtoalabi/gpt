<?php

namespace App\Http\Resources\Users;

use App\Helpers\Images;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSimpleResource extends JsonResource
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
            'user_id' => $this->id,
            'full_name' => $this->first_name . ' ' .$this->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'status' => $this->status,
            'image' =>  Images::Load(optional($this->profile)->images)[0],
        ];
    }
}
