<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['source', 'ipa', 'mean'];

    protected $casts = [
        'mean' => 'array',
    ];

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function getFileAttribute()
    {
        return 'words/' . Str::slug($this->source) . '.mp3';
    }

    public static function createOrFail(array $data): self
    {
        if (self::where('source', $data['source'])->exists()) {
            throw new \Exception("The word '{$data['source']}' already exists.");
        }

        return self::create($data);
    }
}
