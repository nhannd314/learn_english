<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sound extends Model
{
    protected $fillable = ['title', 'img', 'file'];

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class)
            ->withTimestamps()
            ->withPivot('order');
    }
}
