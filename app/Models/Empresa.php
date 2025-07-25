<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    public function gerencias()
    {
        return $this->hasMany(Gerency::class, 'id_empresa', 'id')
                    ->where('is_active', true)
                    ->select(['id', 'name', 'description', 'is_active', 'id_empresa']);
    }

    public function roles()
    {
        return $this->hasMany(Roles::class, 'id_empresa', 'id')->select(['id', 'name','id_empresa']);
    }   
}
