<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug', 'description','thumbnail'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = static::generateUniqueSlug($course->title);
        });

        static::updating(function ($course) {
            // Nếu title thay đổi thì cập nhật lại slug
            if ($course->isDirty('title')) {
                $course->slug = static::generateUniqueSlug($course->title);
            }
        });
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class)->orderBy('unit_number');
    }

    protected static function generateUniqueSlug($title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
