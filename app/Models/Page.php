<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'content'];

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }

    protected static function boot()
    {
        parent::boot();

        // tao slug khi create model
        static::creating(function ($page) {
            $page->slug = SlugHelper::generateUniqueSlug(self::class, $page->title);
        });

        // Nếu title thay đổi thì cập nhật lại slug
        static::updating(function ($page) {
            if ($page->isDirty('title')) {
                $page->slug = SlugHelper::generateUniqueSlug(self::class, $page->title);
            }
        });
    }
}
