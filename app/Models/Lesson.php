<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = ['unit_id', 'title', 'lesson_number', 'vocabulary', 'content'];

    protected static function booted()
    {
        static::saved(function ($lesson) {
            // save words
            if (empty($lesson->words)) {
                return;
            }
            foreach ($lesson->words as $word) {
                // Tìm hoặc tạo từ mới
                Word::firstOrCreate(
                    ['word' => $word['word']],
                    $word
                );
            }
        });
    }

    /**
     * @return BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function getWordsAttribute()
    {
        if (! $this->vocabulary) return [];

        // Mỗi từ cách nhau bởi khoảng trắng hoặc xuống dòng
        $lines = preg_split("/\r\n|\n|\r/", trim($this->vocabulary));

        $words = [];

        foreach ($lines as $line) {
            // Ví dụ: "play_/pleɪ/_v:chơi;n:trò chơi,game"
            $parts = explode('_', trim($line));

            // Cột đầu tiên là từ vựng
            $word = trim($parts[0] ?? null);
            if (! $word) continue;
            $ipa = trim($parts[1] ?? null);
            $vn = trim($parts[2] ?? null);

            // tách nghĩa
            $meaning = array_map(fn($item) => explode(':', $item), explode(';', $vn));


            $words[] = [
                'word' => $word,
                'audio' => str_replace(' ', '-', $word) . '.mp3',
                'ipa' => $ipa,
                'vn' => $vn,
                'meaning' => $meaning,
            ];
        }

        return $words;
    }

}
