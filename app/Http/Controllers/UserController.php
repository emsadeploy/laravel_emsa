<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Freshwork\ChileanBundle\Rut;


//controldores
use App\Http\Controllers\UtilsController;
//modelos
use App\Models\User;
//Request
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;



class UserController extends Controller
{
    protected $utils;

    public function __construct(UtilsController $utils)
    {
        $this->utils = $utils;
    }

    public function update(UpdateUserRequest $request)
    {
        $id                 = $request->id;
        $name               = $request->name;
        $ap_paterno         = $request->ap_paterno;
        $ap_materno         = $request->ap_materno;
        $email              = $request->email;
        $rut                = $request->nr_rut;
        $password           = $request->password;
        $roles              = $request->roles;
        $id_unidad          = $request->id_unidad;
        $id_depto           = $request->id_depto;
        $id_gerencia        = $request->id_gerencia;
        $id_empresa         = $request->id_empresa;

        $nr_rut             = Rut::parse($rut)->format(Rut::FORMAT_WITH_DASH);

        $existe_rut         = User::where('nr_rut','=',$rut)->where('id','!=',$id)->count();

        if($existe_rut)
            return response()->json(['error'=>1,'text'=>'Rut ya ingresado','icon'=>'error','title'=>'Error'],500);


        try 
        {
                $user = User::findOrFail($id);
                $user->update([
                            'name'                  => $name,
                            'ap_paterno'            => $ap_paterno,
                            'ap_materno'            => $ap_materno,
                            'email'                 => $email,
                            'id_unidad'             => $id_unidad,
                            'id_depto'              => $id_depto,
                            'nr_rut'                => $nr_rut,
                            'id_gerencia'           => $id_gerencia,
                            'id_empresa'            => $id_empresa]);


                if(trim($password) != '' &&   (strlen($password) >= 4 || strlen($password) <= 8))
                    $user->update(['password'=> bcrypt($password)]);

                if($password && (strlen($password) < 4 || strlen($password) > 8))
                    return response()->json(['error'=>1,'text'=>'La contraseña debe tener entre 4 y 8 caracteres','icon'=>'error','title'=>'Error'],500)    ;

                $user->syncRoles($roles);


            return response()->json(['error'=>0,'text'=>'Usuario Actualizado Correctamente','icon'=>'success','title'=>'Exito',],200);

        } 
        catch (\Throwable $th) 
        {
            Log::error('Error al actualizar usuario: '.$th->getMessage());
            return response()->json(['error'=>1,'text'=>'Error al actualizar usuario','icon'=>'error','title'=>'Error',],500);

        }
        
        

    }

    public function create(CreateUserRequest $request)
    {
        $name               = $request->name;
        $ap_paterno         = $request->ap_paterno;
        $ap_materno         = $request->ap_materno;
        $email              = $request->email;
        $rut                = $request->nr_rut;
        $nr_telefono        = $request->nr_telefono;
        $password           = bcrypt($request->password);
        $confirm_password   = bcrypt($request->confirm_password);
        $roles              = $request->roles;
        $id_gerencia        = $request->id_gerencia;
        $id_empresa         = $request->id_empresa;
        $rut                = Rut::parse($rut)->format(Rut::FORMAT_WITH_DASH);

        Log::debug(['largo_roles' => count($roles),'roles' => $roles]);

        $existe_rut         = User::where('nr_rut','=',$rut)->count();

        if($existe_rut)
            return response()->json(['error'=>1,'text'=>'Rut ya ingresado','icon'=>'error','title'=>'Error'],200);

        try {

                $user   = User::create(['name'                      => $name,
                                        'ap_paterno'                => $ap_paterno,
                                        'ap_materno'                => $ap_materno,
                                        'email'                     => $email,
                                        'nr_rut'                    => $rut,
                                        'id_gerencia'               => $id_gerencia,
                                        'nr_telefono'               => $nr_telefono,
                                        'password'                  => $password,
                                        'id_empresa'                => $id_empresa
                                    ]);

                $user->syncRoles($roles);


                return  response()->json(['error'=>0,'text'=>'Usuario Creado Correctamente','icon'=>'success','title'=>'Exito'],200);

        } catch (\Throwable $th) 
        {
            $user->delete();
            Log::error('Usuario eliminado por error al crear: '.$th->getMessage());
            return response()->json(['error'=>1,'text'=>'Error al crear usuario','icon'=>'error','title'=>'Error'],500);    
        }

    }

    function index() 
    {
        $session    = $this->utils->getSession();
        return view('users.UserList')->with('user_name', $session['user'])->with('rol',$session['rol']);
    }   

   
    public function list(Request $request)
    {
        $users = User::select(  'id',
                                'name',
                                'ap_paterno',
                                'ap_materno',
                                'nr_rut',
                                'nr_telefono',
                                'id_cargo',
                                'id_gerencia',
                                'id_empresa',
                                'email',
                                'email_verified_at',
                                'password',
                                'is_active')
                                ->with('gerency')
                                ->with('roles')
                                ->with('empresa')
                                ->paginate(10);

        return [
            'users' => $users,
            'pagination' => [
                'total'         => $users->total(),
                'per_page'      => $users->perPage(),
                'current_page'  => $users->currentPage(),
                'last_page'     => $users->lastPage(),
                'from'          => $users->firstItem(),
                'to'            => $users->lastItem()
            ]
        ];
    }
}
