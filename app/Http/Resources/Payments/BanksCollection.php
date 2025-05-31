<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BanksCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request) {
        return $this->collection->transform(function($bank){
            return new BanksResource($bank);
        });
    }
}
