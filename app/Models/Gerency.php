<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerency extends Model
{
    protected $table    = 'gerencias';
    protected $fillable = ['id_empresa', 'name', 'description', 'is_active'];
    protected $casts    = ['is_active' => 'boolean'];
}
