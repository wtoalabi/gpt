<?php
    /**
     * Created by Alabi Olawale
     * Date: 8/3/2019
     */
    declare(strict_types=1);
    
    namespace App\Models\Base\Collections;
    
    use App\Platform\Accounts\Merchants\Merchant;
    use Illuminate\Support\Str;

    class UniqueSlugs{
        public static function Get($model, $field, $slugValue) {
            $slug = Str::slug($slugValue);
            
            $allRelatedSlugs = collect($model::withTrashed()->where($field, 'like', "%$slug%" . '%')->get()
                ->pluck
            ($field));
            if (!$allRelatedSlugs->contains($slug)) {
                return $slug;
            }
            for ($count = 1; $count <= $allRelatedSlugs->count(); $count++) {
                $newSlug = $slug . '-' . $count;
                if (!$allRelatedSlugs->contains($newSlug)) {
                    return $newSlug;
                }
            }
        }
    
    }
