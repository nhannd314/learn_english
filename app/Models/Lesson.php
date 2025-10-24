<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    protected $fillable = ['unit_id', 'title', 'order', 'content'];

    /**
     * @return BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function words(): BelongsToMany
    {
        return $this->belongsToMany(Word::class)
            ->withPivot('order')
            ->orderBy('lesson_word.order');
    }
}
