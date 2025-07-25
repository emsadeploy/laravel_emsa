<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//models
use App\Models\Roles;
use App\Models\Gerency;
use App\Models\Empresa;

class UtilsController extends Controller
{
    function getSession()
    {
        $user   = Auth::user();
        $rol    = $user->getRoleNames();

        return ['user' => $user->name,'rol'  => $rol[0]];
    }

    

    function getEmpresas()
    {
        return Empresa::select('id', 'name', 'description', 'is_active')
                        ->whereIn('id',[2,3])
                        ->with('gerencias')
                        ->with('roles')
                        ->where('is_active', true)->get();
    }
}
