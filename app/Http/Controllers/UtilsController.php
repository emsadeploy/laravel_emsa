<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilsController extends Controller
{
    function getSession()
    {
        $user   = Auth::user();
        $rol    = $user->getRoleNames();

        return ['user' => $user->name,'rol'  => $rol[0]];
    }
}
