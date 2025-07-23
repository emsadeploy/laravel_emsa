<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UtilsController;


class UserController extends Controller
{
    protected $utils;

    public function __construct(UtilsController $utils)
    {
        $this->utils = $utils;
    }

    function index()
    {
        $session    = $this->utils->getSession();

        return view('users.UserList')->with('user_name', $session['user'])->with('rol',$session['rol']);
    }   
}
