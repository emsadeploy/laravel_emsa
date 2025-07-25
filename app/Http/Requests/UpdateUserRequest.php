<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Log; 

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepara los datos para la validación.
     * Este método se ejecuta ANTES de las reglas de validación.
     * Es el lugar ideal para limpiar datos y para registrar logs iniciales.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Logueamos el ID del usuario aquí. Se ejecutará antes que las reglas.
        Log::info('Datos recibidos para actualización de usuario ID: ' . $this->input('id'), $this->all());

        $roles = $this->input('roles');

        // Si no se enviaron roles, no hacemos nada.
        if (!$roles) {
            return;
        }

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


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->input('id');

        return [
            'id'           => 'required|exists:users,id',
            'name'         => 'required|string|max:255',
            'ap_paterno'   => 'required|string|max:255',
            'ap_materno'   => 'required|string|max:255',
            'id_gerencia'  => 'nullable|numeric|not_in:0|exists:gerencias,id',
            'id_empresa'   => 'required|exists:empresas,id', // Validar que la empresa sea una de las opciones permitidas

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId),
            ],
            'nr_telefono' => [
                'nullable',
                'numeric',
                'digits:9',
                Rule::unique('users')->ignore($userId),
            ],
            'nr_rut' => [
                'required',
                'string',
                'cl_rut', // Descomenta si tienes esta regla personalizada
                Rule::unique('users')->ignore($userId),
            ],

            // La regla 'confirmed' busca automáticamente un campo llamado 'password_confirmation'.
            // No necesitas una regla separada para 'password_confirmation'.
            'password' => 'nullable|string|min:4|max:8|confirmed',
            'password_confirmation' => 'nullable|string|min:4|max:8|same:password',

            // --- Validación de Roles Corregida ---
            // Ahora 'roles' es un arreglo de IDs gracias a prepareForValidation.
            'roles'   => 'required',
            'roles.*' => 'exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'required'              => 'El campo :attribute es requerido.',
            'string'                => 'El campo :attribute debe ser texto.',
            'email'                 => 'El :attribute no es un correo válido.',
            'unique'                => 'El :attribute ya se encuentra registrado por otro usuario.',
            'exists'                => 'El :attribute seleccionado no es válido.',
            'numeric'               => 'El campo :attribute debe ser numérico.',
            'not_in'                => 'Debe seleccionar un :attribute válido.',
            'min'                   => 'La :attribute debe tener al menos :min caracteres.',
            'max'                   => 'La :attribute no debe tener más de :max caracteres.',
            'confirmed'             => 'La confirmación de contraseña no coincide.',
            'array'                 => 'Debe seleccionar al menos un :attribute.',
            'empresa.in'            => 'La empresa debe ser una de las siguientes opciones: EMSA, DILAT.',
            'nr_telefono.digits'    => 'El número de teléfono debe tener 9 dígitos.',
            'nr_telefono.unique'    => 'El número de teléfono ya está en uso por otro usuario.',
            'id_empresa.exists'     => 'La empresa seleccionada no es válida.',
            'id_gerencia.exists'    => 'La gerencia seleccionada no es válida.',
            'nr_rut.required'       => 'El campo RUT es obligatorio.',
            'nr_rut.string'         => 'El campo RUT debe ser un texto.',
            'nr_rut.cl_rut'         => 'El RUT ingresado no es válido.',
            'nr_rut.unique'         => 'El RUT ya se encuentra registrado por otro usuario.',
            'roles.required'        => 'Debe seleccionar al menos un rol.',
            'roles.*.exists'        => 'El rol seleccionado no es válido.',
            'password_confirmation.same' => 'La confirmación de contraseña debe coincidir con la contraseña.',

        ];
    }

    public function attributes()
    {
        return [
            'name'                  => 'Nombre',
            'ap_paterno'            => 'Apellido Paterno',
            'ap_materno'            => 'Apellido Materno',
            'email'                 => 'Email',
            'nr_rut'                => 'RUT',
            'nr_telefono'           => 'Teléfono',
            'id_gerencia'           => 'Gerencia',
            'password'              => 'Contraseña',
            'password_confirmation'      => 'Confirmación de Contraseña', // Atributo para el mensaje de la regla 'confirmed'
            'roles'                 => 'Roles',
            'id_empresa'            => 'Empresa',

        ];
    }
}
