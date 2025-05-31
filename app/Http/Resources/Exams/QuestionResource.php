<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'answer' => $this->answer,
            'explain' => $this->explain,
            'intro' => $this->intro,
            'options' => json_decode($this->options),
            'question' => $this->question,
            'subject' => $this->subject(),
            'isPureText' => $this->isPureText,
            'number' => $this->number,
            'exam' => $this->exam(),
            'year' => $this->year,
            'status' => $this->status,
            'created_by_name' => optional($this->createdBy)->name(),
            'created_by' => optional($this->createdBy)->id,
            'approved_by_name' => optional($this->approvedBy)->name(),
            'approved_by' => optional($this->approvedBy)->id,
        ];
    }
}
