<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $fillable = ['title', 'file_url', 'transcript'];
}
