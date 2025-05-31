<?php

namespace App\Models\Activities;

use App\Models\Base\BaseModel;
use App\Models\Base\CustomQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use CustomQuery;
    protected $casts = ['modifications' => 'array'];
    protected $fillable = ['actor_id', 'actor_role', 'actor_path','subject_id', 'subject_type', 'subject_path', 'action', 'message', 'modifications'];
    
 
    
    
    /**
     * @param $subject . Comes in as a  model
     * @param string $message is the text that will be displayed on the front.
     * @param string $action comes in as "CREATED" or "DELETED"
     * @param array $modifications In activities that have changes, like "UPDATED", this is the array of
     * those changes.
     * The resultant model looks like this:
     * "actor_id" => 1
     * "actor_type" => "User"
     * "subject_id" => 1
     * "subject_path" => "App\Platform\Contacts\Addresses\Address"
     * "subject_type" => "address-action"
     * "action" => "CREATED"
     * "message" => "Ayebatari Chimamanda Ekwueme created a new address(Test Address)"
     * "modifications" => "null"
     * "updated_at" => "2019-06-14 20:28:27"
     * "created_at" => "2019-06-14 20:28:27"
     * "id" => 1
     */
    public static function Record($subject, string $message, string $action, array $modifications = null) {

        $actor = auth()->user();
        $activity = new Activity();
        $activity->actor_id = $actor->id;
        $activity->actor_role = $actor->role()->title;
        $activity->actor_path =get_class($actor);
        $activity->subject_id = $subject->id;
        $activity->subject_path = get_class($subject);
        $activity->subject_type = class_basename($subject);
        $activity->action = $action;
        $activity->message = $message;
        $activity->modifications = collect($modifications)->isEmpty() ? null : $modifications;
        $activity->save();
    }
    
}
