<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Plans\UserPlanResource;
use App\Http\Resources\Exams\QuizCollection;
use App\Models\Settings\Setting;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user'=>[
                'user_id' => $this->id,
                //'full_name' => $this->first_name . ' ' .$this->last_name,
                'phone' => $this->phone,
                'username' => $this->username,
                'token' => $this->token,
                'email' => $this->email,
                'status' => var_export($this->status, true),
                'exam' => $this->exam,
                'subjects' => implode(",", $this->subjects),
                'subject_questions' => $this->subjects() ,
                'quizzes' =>  new QuizCollection($this->quizzes) ,
            ]
            

            //'hometown' =>  optional($this->profile)->hometown,
            //'location' =>  optional($this->profile)->location,
           // 'dob' =>  optional($this->profile)->dob,
            //'age' =>  Carbon::parse(optional($this->profile)->dob)->age,
        ];
    }
}


