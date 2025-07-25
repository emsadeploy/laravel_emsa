<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

                'name'                  => 'required|string',
                'email'                 => 'required|email|unique:users,email',
                'ap_paterno'            => 'required|string',
                'ap_materno'            => 'required|string',
                'nr_rut'                => 'required|string|cl_rut|unique:users,nr_rut',
                'password'              => 'required|string|between:4,8',
                'confirm_password'      => 'required|string|between:4,8|same:password',
                'id_gerencia'           => 'required|exists:gerencies,id',
                'roles'                 => 'required|array',
            ];
    }

    public function messages()
    {

        return [
                    'required'              =>  'El campo  :attribute es requerido',
                    'numeric'               =>  'El campo  :attribute debe ser númerico',
                    'cl_rut'                =>  'Rut Inválido',
                    'unique'                =>  'El :attribute ya se encuentra ingresado',
                    'numeric'               => 'El :attribute debe ser un número',
                    'digits'                =>  'El :attribute debe tener 8 caracteres',
                    'email'                 =>  'El :attribute no es un correo válido.',
                    'exists'                =>  'El :attribute no existe.',
                    'password.between'      => 'La contraseña debe tener entre :min y :max caracteres.',
                    'confirm_password.same' => 'La confirmación de la contraseña no coincide con la contraseña.',
                    'id_gerencia.required'  => 'La gerencia es requerida.',
                ];
    }


    public function attributes()
    {
        return [
                'name'        => 'name Usuario',
                'ap_paterno'    => 'Apellido Paterno',
                'ap_materno'    => 'Apellido Materno',
                'email'         => 'Email',
                'rut'           => 'Rut',
                'password'      => 'Contraseña',
                'nr_unidad'     => 'Dirección Municipal',
                'rol'           => 'Rol',
                'nr_unidad'     => 'Unidad',
                'nr_depto'      => 'Departamento',
                'id_gerencia'   => 'Gerencia',
            ];
    }
}
