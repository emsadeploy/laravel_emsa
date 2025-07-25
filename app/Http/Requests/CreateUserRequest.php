<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Log; 

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Logueamos el ID del usuario aquí. Se ejecutará antes que las reglas.
        Log::info('Datos recibidos para creacion de usuario ID: ' . $this->input('id'), $this->all());

        $roles = $this->input('roles');

        // Si no se enviaron roles, no hacemos nada.
        if (!$roles) 
            return;
        

        // Paso 1: Asegurarse de que 'roles' sea siempre un arreglo.
        $rolesArray = !is_array($roles) || (isset($roles['id'])) ? [$roles] : $roles;

        // Paso 2: Extraer solo los IDs de los roles para la validación.
        $roleIds = array_map(function ($role) {
            return is_array($role) ? $role['id'] : $role->id;
        }, $rolesArray);

        // Reemplaza el input original de 'roles' con el arreglo de IDs ya procesado.
        $this->merge([
            'roles' => $roleIds,
        ]);
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
                'password_confirmation' => 'required|string|between:4,8|same:password',
                'id_gerencia'           => 'required|exists:gerencias,id',
                'roles'                 => 'required',
                'nr_telefono'           => 'nullable|numeric|digits:9|unique:users,nr_telefono',
                'id_empresa'            => 'required|exists:empresas,id', // Validar que la empresa sea una de las opciones permitidas
                'roles'   => 'required',
                'roles.*' => 'exists:roles,id'
            ];
    }

    public function messages()
    {

        return [
                    'required'                      =>  'El campo  :attribute es requerido',
                    'numeric'                       =>  'El campo  :attribute debe ser númerico',
                    'cl_rut'                        =>  'Rut Inválido',
                    'unique'                        =>  'El :attribute ya se encuentra ingresado',
                    'numeric'                       =>  'El :attribute debe ser un número',
                    'digits'                        =>  'El :attribute debe tener 8 caracteres',
                    'email'                         =>  'El :attribute no es un correo válido.',
                    'exists'                        =>  'El :attribute no existe.',
                    'password.between'              =>  'La contraseña debe tener entre :min y :max caracteres.',
                    'password_confirmation.same'    =>  'La confirmación de la contraseña no coincide con la contraseña.',
                    'id_gerencia.required'          =>  'La gerencia es requerida.',
                    'id_gerencia.exists'            =>  'La gerencia seleccionada no es válida.',
                    'id_empresa.required'           =>  'El campo empresa es obligatorio.',
                    'id_empresa.exists'             =>  'La empresa seleccionada no es válida.',
                    'nr_rut.required'               =>  'El campo RUT es obligatorio.',
                    'nr_rut.string'                 =>  'El campo RUT debe ser un texto.',
                    'nr_rut.unique'                 =>  'El RUT ya se encuentra registrado por otro usuario.',
                    'nr_telefono.digits'            =>  'El número de teléfono debe tener 9 dígitos.',
                    'nr_telefono.unique'            =>  'El número de teléfono ya está en uso por otro usuario.',   
                    'roles.required'                =>  'Debe seleccionar al menos un rol.',
                    'roles.*.exists'                =>  'El rol seleccionado no es válido.',
                ];      
    }


    public function attributes()
    {
        return [
                'name'                      => 'Nombre',
                'ap_paterno'                => 'Apellido Paterno',
                'ap_materno'                => 'Apellido Materno',
                'email'                     => 'Email',
                'rut'                       => 'Rut',
                'password'                  => 'Contraseña',
                'password_confirmation'     => 'Confirmar Contraseña',
                'rol'                       => 'Rol',
                'id_gerencia'               => 'Gerencia',
                'nr_telefono'               => 'Teléfono',
                'id_empresa'                => 'Empresa',
                'roles'                     => 'Roles',
                'nr_rut'            => 'RUT',
            ];
    }
}
