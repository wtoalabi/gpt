<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffSettingsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request) {
        return $this->collection->transform(function($setting){
            return new StaffSettingsResource($setting);
        });
    }
}
