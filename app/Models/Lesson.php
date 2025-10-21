<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    protected $fillable = ['unit_id', 'title', 'lesson_number', 'vocabulary', 'content'];

    protected static function booted()
    {
        static::saved(function ($lesson) {
            // save words
//            if (empty($lesson->words)) {
//                return;
//            }
//            foreach ($lesson->words as $word) {
//                // Tìm hoặc tạo từ mới
//                Word::firstOrCreate(
//                    ['word' => $word['word']],
//                    $word
//                );
//            }
        });
    }

    /**
     * @return BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function words()
    {
        return $this->belongsToMany(Word::class, 'lesson_word');
    }
}
