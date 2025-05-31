<?php
    
    namespace App\Http\Resources\Roles;
    
    use Illuminate\Http\Resources\Json\JsonResource;
    
    class RolesResource extends JsonResource
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
                'title' => $this->title,
                'description' => $this->description,
                'isCore' => $this->isCore,
                'permissions_count' => $this->permissions_count
                /*'usersCount' => $this->users_count,
                'merchantsCount' => $this->merchants_count,
                'adminsCount' => $this->admins_count,
                'permissionsCount' => $this->permissions_count,
                */
            ];
        }
    }
