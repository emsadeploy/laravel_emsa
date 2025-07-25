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


class UserController extends Controller
{
    protected $utils;

    public function __construct(UtilsController $utils)
    {
        $this->utils = $utils;
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
        $rut                = Rut::parse($rut)->format(Rut::FORMAT_WITH_DASH);



        $existe_rut = User::where('nr_rut','=',$rut)->count();

        if($existe_rut)
            return ['error'=>1,'text'=>'Rut ya ingresado','icon'=>'error','title'=>'Error'];

        try {

                $user   = User::create(['name'                      => $name,
                                        'ap_paterno'                => $ap_paterno,
                                        'ap_materno'                => $ap_materno,
                                        'email'                     => $email,
                                        'nr_rut'                    => $rut,
                                        'id_gerencia'               => $id_gerencia,
                                        'nr_telefono'               => $nr_telefono,
                                        'password'                  => $password]);


                foreach ($roles as $rol) // asignacion de roles
                {
                    $id_rol = $rol['id'];
                    $user->roles()->attach($id_rol); // Asignar rol al usuario
                }

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
                                'str_empresa',
                                'email',
                                'email_verified_at',
                                'password',
                                'is_active')
                                ->with('gerency')
                                ->with('roles')
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
