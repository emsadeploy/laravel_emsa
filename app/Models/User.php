<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;
    

  
    protected $fillable = [
        'name',
        'email',
        'password',
        'ap_paterno',
        'ap_materno',
        'nr_rut',
        'nr_telefono',
        'id_cargo',
        'id_gerencia',
        'str_empresa',
        'is_active',
        'remember_token',
        'id_empresa'
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function gerency()
    {
        return $this->belongsTo(Gerency::class, 'id_gerencia', 'id')->select(['id', 'name','is_active']);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id')->select(['id', 'name', 'description', 'is_active']);
    }

}
