<?php
    /**
     * Created by Alabi Olawale
     * Date: 9/6/2019
     */
    declare(strict_types=1);
    
    namespace App\Models\Base;
    use GeneaLabs\LaravelModelCaching\Traits\Cachable;
    use App\Models\Base\Recordable;
    use Illuminate\Database\Eloquent\Model as Eloquent;

    abstract class BaseModel extends Eloquent{
        //use Cachable, Recordable;
        use Recordable;
        protected $cachePrefix = "qanda-cache-01";

       
    }
