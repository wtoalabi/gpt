<?php
    /**
     * Created by Alabi Olawale
     * Date: 8/13/2019
     */
    declare(strict_types=1);
    
    namespace App\Models\Base\Collections;
    
    
    class Pagination{
        public static function Get($object) {
            $current_page = optional(request('queryPagination'))['page'];
            return [
                'rowsNumber' => $object->total(),
                'rowsPerPage' => $object->perPage(),
                'page' => $current_page ?? $object->currentPage(),
            ];
        }
        
    }
