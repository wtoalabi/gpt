<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectDashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'exams' =>  $this->exams->pluck('name'),
            'exam_ids' =>  $this->exams->pluck('id'),
            'questions_count' => count($this->questions), 
        ];
    }
}
