<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function userHome()
    {
        return view('home',["msg"=>"I am user role"]);
    }

    public function adminHome()
    {
        return view('admin.dashboard',["msg"=>"I am Superadmin role"]);
    }
}
