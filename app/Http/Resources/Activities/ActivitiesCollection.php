<?php

namespace App\Http\Resources\Activities;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivitiesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return $this->collection->transform(function($activity){
            return new QuestionReportsResource($activity);
        });
    }
}
