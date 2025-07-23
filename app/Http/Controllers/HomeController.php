<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $rol    = 'Usuario';

        
        

        return view('dashboard')->with('user_name', $user->nombre)->with('rol',$rol);
    }
}
