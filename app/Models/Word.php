<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['word', 'ipa', 'vn'];

    protected $casts = [
        'vn' => 'array',
    ];

    public function lesson()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_word');
    }

    public function getAudioUrlAttribute()
    {
        return SlugHelper::generateWordAudioUrl($this->word);
    }

    public function getMeaningAttribute()
    {
        // tách nghĩa
        return(array_map(fn($item) => explode(':', $item), explode(';', $this->vn)));
    }
}
