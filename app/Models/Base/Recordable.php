<?php
    /**
     * Created by Alabi Olawale
     * Date: 6/13/2019
     */
    declare(strict_types=1);
    
    namespace App\Models\Base;
    
    use App\Models\Activities\Activity;
    use Illuminate\Support\Str;
    
    trait Recordable
    {
     
        public function generic_name(){
            $name = $this->title  ?? $this->first_name ??  $this->name ?? $this->bank_name  ??  null;
            return $name;
        }

        protected static function boot(){
            parent::boot();
            $user = optional(auth())->user();
            static::saving(function ($model) use($user) {
               if($model->id){

                $newData = request()->all();
                $oldData = $model->getOriginal();
                if($user){
                    $user->generateUpdatedActivity($model, $oldData, $newData);
                }
               }
               
            });

            static::created(function ($model) use($user){
                if($user){
                    $user->generateCreatedActivity($model, $model->generic_name());
                }
            });

            static::deleted(function ($model) use($user){
                if($user){
                    $user->generateDeletedActivity($model, $model->generic_name());
                }
            });
        }


        public function activities() {
            return $this->hasMany(Activity::class,'actor_id');
        }
        
        /*$subjectModel comes in as the model of the actionable model. For instance, Address::class
        $subjectName comes in as the exact name of the subject...for instance: Nissam Micra 202
        or 2, Adewale Street, Garki, Abuja. We need this to be appended to the message string.
        */
        public function generateCreatedActivity($subjectModel, $subjectName, $customModelName = null, $customMessage = '', $customDetail = []) {
            
            if ($customMessage) {
                return Activity::Record($subjectModel, $customMessage, "CREATED", $customDetail);
            } else {
                $user = auth()->user();
                $name = $subjectName ? " ($subjectName)" : null;
                $modelName = $customModelName ?? Str::lower(class_basename($subjectModel));
                $message = $user->name() . " created a new " . $modelName . $name . " (with ID: " .$subjectModel->id . ")";
                Activity::Record($subjectModel, $message, "CREATED", $customDetail);
            }
        }
        
        /**
         * @param $subject . The subject with the updated values.
         * @param $oldSubject . The subject with the old values.
         * @param string $customMessage
         * @param array $customDetail
         */
        public function generateUpdatedActivity($subject, $oldData, $new_data = [], $customMessage = '' ) {
            $details = $this->detailsOfChangedValues($oldData, $new_data);
            if ($customMessage) {
                Activity::Record($subject, trim($customMessage, '"'), "UPDATED", $details);
            } else {
                $user = auth()->user();
                $objectName = '';
                /*if ($subject->name()) {
                    $objectName = " (". $subject->name() .")";
                }*/
                $subjectName = Str::lower(class_basename($subject)) ?? '';
                $message = $user->name() . " updated " . $subjectName . $objectName . " (with ID: " .$subject->id . ")";

                Activity::Record($subject, $message, "UPDATED", $details);
            }
        }
        
        public function generateDeletedActivity($subject, $actionName, $actionType = "", $customMessage = "", $details = []) {
            //dd([$subject, $actionName, $actionType, $customMessage]);
            if ($customMessage) {
                return Activity::Record($subject, $customMessage, "DELETED", $details);
            } else {
                $user = auth()->user();
                $name = $actionName  ? " ($actionName) "  :  class_basename($subject);
                $message = $user->name() . " deleted " . $actionType . $name . " (with ID: " .$subject->id . ")";
                return Activity::Record($subject, $message, "DELETED", $details);
            }
        }
        
        /**
         *
         */
        
        public function generateLoginActivity() {
            $user = auth()->user();
            $activity = new Activity();
            $activity->actor_id = $user->id;
            $activity->actor_role =  $user->role()->title;
            $activity->actor_path =get_class($user);
            $activity->subject_id = $user->id;
            $activity->subject_type = class_basename($user)."Login";
            $activity->subject_path = get_class($user);
            $activity->action = "LOGIN";
            $activity->message = $user->name() . " logs in.";
            $activity->modifications = null;
            $activity->save();
        }
        
        /**
         *
         */
        public function generateAccountCreationActivity() {
            $user = auth()->user();
            $message = $user->name . " registers.";
            $activity = new Activity();
            $activity->actor_id = $user->id;
            $activity->actor_role = $user->role()->title;
            $activity->actor_path =get_class($user);
            $activity->subject_id = $user->id;
            $activity->subject_type = class_basename($user)."Registration";
            $activity->subject_path = get_class($user);
            $activity->action = "REGISTER";
            $activity->message = $message;
            $activity->modifications = null;
            $activity->save();
        }
        
        /**
         *
         */
        public function generatePasswordRequestActivity($user) {
            $message = $user->name . " successfully requested a new password";
            $activity = new Activity();
            $activity->actor_id = $user->id;
            $activity->actor_role = $user->role()->title;
            $activity->actor_path =get_class($user);
            $activity->subject_id = $user->id;
            $activity->subject_type = class_basename($user)."PasswordRequest";
            $activity->subject_path = get_class($user);
            $activity->action = "NEW PASSWORD";
            $activity->message = $message;
            $activity->modifications = null;
            $activity->save();
        }
        
        /**
         *
         */
        public function generateTooManyLoginAttemptsActivity($user) {
            $lastSubjectType = '';
          if($user->activities->last()){
              $lastSubjectType = $user->activities->last()->subject_type;
          }
          if($lastSubjectType !== class_basename($user)."FailedLogin") {
              $message = $user->name . " is having trouble login in...";
              $activity = new Activity();
              $activity->actor_id = $user->id;
              $activity->actor_role = $user->role()->title;
              $activity->actor_path =get_class($user);
              $activity->subject_id = $user->id;
              $activity->subject_type = class_basename($user)."FailedLogin";
              $activity->subject_path = get_class($user);
              $activity->action = "FAILED_LOGIN";
              $activity->message = $message;
              $activity->modifications = null;
              $activity->save();
          }
        }
        
        /**
         * @param $new : a modelObject.
         * @param $old : model
         * @return array The generated array is given like:
         * [
         * "state" => "from Test state to Oyo"
         * "city" => "from Test city to Ogbomoso"
         * "is_default" => "from false to true"
         * ]
         */
        protected function detailsOfChangedValues($old, $new) {
            $changes = [];
            
            foreach ($new as $field => $value) {
                if (array_key_exists($field, $old)) {
                    
                    if (is_string($old[$field]) && is_string($value)) {
                        $old_value = json_decode($old[$field], true);
                        $new_value = json_decode($value, true);
                      
                        if ($old_value !== null && $new_value !== null) {
                            $oldJson = json_encode($old_value);
                            $newJson = json_encode($new_value);
        
                            if ($oldJson !== $newJson) {
                                recordChanges($changes, $field, $old, $value);
                            }
                        }else{
                            if ($old[$field] != $value) {
                                recordChanges($changes, $field, $old, $value);
                            }
                        }
                    } elseif ($old[$field] != $value) {
                       recordChanges($changes, $field, $old, $value);
                    }
                }
            }
            
            return $changes;
        }
        
    }

    function recordChanges(&$changes, $field, $old, $value){
        $changes[$field] = [
            'old' => $old[$field],
            'new' => $value
        ];
    }
