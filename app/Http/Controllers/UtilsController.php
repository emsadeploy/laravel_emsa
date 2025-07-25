<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//models
use App\Models\Roles;
use App\Models\Gerency;

class UtilsController extends Controller
{
    function getSession()
    {
        $user   = Auth::user();
        $rol    = $user->getRoleNames();

        return ['user' => $user->name,'rol'  => $rol[0]];
    }

    function getRoles()
    {
        $roles = Roles::select('id','name')->get();

        return $roles;
    }

    function getGerencies()
    {
        $gerencies = Gerency::select('id', 'name')->where('is_active', 1)->get();

        return $gerencies;
    }
}
