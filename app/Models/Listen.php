<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listen extends Model
{
    protected $fillable = ['title', 'file', 'transcript'];
}
