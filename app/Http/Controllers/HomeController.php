<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UtilsController;


class HomeController extends Controller
{
    protected $utils;

    public function __construct(UtilsController $utils)
    {
        $this->utils = $utils;
    }

    public function index()
    {
        $session    = $this->utils->getSession();

        return view('dashboard')->with('user_name', $session['user'])->with('rol',$session['rol']);
    }

    public function init()
    {
        $roles      = $this->utils->getRoles();
        $gerencias  = $this->utils->getGerencies();

        return [
            'roles'     => $roles,
            'gerencias' => $gerencias
        ];
    }
}
