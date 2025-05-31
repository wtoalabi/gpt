<?php
    
    namespace App\Http\Resources\Staff;
    
    use Illuminate\Http\Resources\Json\JsonResource;
    
    class StaffResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param \Illuminate\Http\Request $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'status' => $this->status,
                'email' => $this->email,
                'questions_post_count' => $this->questions_post_count,
                'role' => optional($this->role())->title ?? 'None'
               /* 'title' => $this->title,
                'description' => $this->description,
                'isCore' => $this->isCore,
                'permissions_count' => $this->permissions_count*/
                /*'usersCount' => $this->users_count,
                'merchantsCount' => $this->merchants_count,
                'adminsCount' => $this->admins_count,
                'permissionsCount' => $this->permissions_count,
                */
            ];
        }
    }
