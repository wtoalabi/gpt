<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Plans\UserPlanResource;
use App\Models\Settings\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
           /* 'id' => $this->id,
            'name' =>  $this->name,
            'email' =>  $this->email,
            'phone' =>  $this->phone,
            'about' =>  $this->about,
            'gender' =>  $this->gender,
            'profile' => new UserProfileResource($this->profile),
            
            'connections' => $this->connections()*/
            'user' => [
                'user_id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'token' => $this->token,
            ],
            'profile' => new UserProfileResource($this->profile),
            'plan' => new UserPlanResource(optional($this->user_plan())),
            'settings' => count($this->settings) > 0 ? getUserSettings($this->settings->first()) : defaultSettings(),
            'connections' => $this->connections(),
        ];
    }
}

function defaultSettings(){
    $settingsObject = [];
    $settings = Setting::all()->values();

    for($i = 0; count($settings) > $i; $i++){
        $setting = $settings[$i];
        $settingsObject[$setting->name] = json_decode($setting->value);
    }


    return $settingsObject;
}


function getUserSettings($userSettings){
    return json_decode($userSettings->value);
}
