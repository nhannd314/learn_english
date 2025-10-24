<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug', 'description','thumbnail', 'order'];

    /**
     * Get the route key for the model.
     */
//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

    protected static function boot()
    {
        parent::boot();

        // tao slug khi create model
        static::creating(function ($course) {
            $course->slug = SlugHelper::generateUniqueSlug(self::class, $course->title);
        });

        // Nếu title thay đổi thì cập nhật lại slug
        static::updating(function ($course) {
            if ($course->isDirty('title')) {
                $course->slug = SlugHelper::generateUniqueSlug(self::class, $course->title);
            }
        });
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class)->orderBy('order');
    }
}
