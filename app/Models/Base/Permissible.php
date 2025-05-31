<?php
    /**
     * Created by Alabi Olawale
     * Date: 6/10/2019
     */
    declare(strict_types=1);
    
    namespace App\Models\Base;
    
    
    use App\Models\Base\Authorization\Permission;
    use App\Models\Base\Authorization\Role;
    
    
    trait Permissible
    {
        
        
        
        public function check($action, $model) {
            $user = auth()->user();
            if ($user->can($action, $model)) {
                return true;
            }
            //throw new NotAuthorizedException("", 401);
            abort(401, "You are not permitted for this action!!!");
            
        }
        
    }
