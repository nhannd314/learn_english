<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SlugHelper
{
    /**
     * @param string $modelClass    Tên class model, ví dụ App\Models\Page::class
     * @param string $title         Tiêu đề gốc để tạo slug
     * @return string
     */
    public static function generateUniqueSlug(string $modelClass, string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
