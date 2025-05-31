<?php
    
    namespace App\Http\Resources\Activities;
    
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Str;

    class ActivitiesResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param \Illuminate\Http\Request $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request){
            return [
                'id' => $this->id,
                'actor_id' => $this->verifyExistenceOfActor($this->actor_id, $this->actor_path),
                'actor_role' => $this->actor_role,
                'actor_type' => class_basename($this->actor_path),
                'subject_id' => $this->verifyExistenceOfTheSubject($this->subject_id,$this->subject_path),
                'subject_type' => $this->subject_type,
                'subject_slug' => Str::kebab("$this->subject_type Action"),
                'action' => $this->action,
                'message' => $this->message,
                'modifications' => $this->modifications,
                'created_at' => $this->created_at->format('l jS \\of F Y, h:i:s A') ." (".$this->created_at->diffForHumans().')',
            ];
        }
    
        private function verifyExistenceOfActor($actor_id, $actor_path) {
            $actor = app($actor_path)->find($actor_id);
            return $actor->id ?? "Removed";
        }
    
        private function verifyExistenceOfTheSubject($subject_id, $subject_path) {
            $subject = app($subject_path)->find($subject_id);
            return $subject->id ?? "Removed";
        }
    }
