<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerency extends Model
{
    protected $table = 'gerencies';
    protected $fillable = ['name', 'description', 'is_active'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
