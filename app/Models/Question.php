<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = ['game_id', 'question', 'hint', 'image_url', 'audio_url'];
    //protected $appends = ['audio', 'image'];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    protected function getImageAttribute()
    {
        return asset('storage/' . $this->image_url);
    }

    protected function getAudioAttribute()
    {
        return asset('storage/' . $this->audio_url);
    }
}
