<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class customAuthController extends Controller
{
    public function adult(){
        return view('customAuth.index');
    }

    public function site(){
        return view('site');
    }

    public function admin(){
        return view('admin');
    }
    public function adminLogin(){
        return view('auth/adminLogin');
    }
//
//    public function checkAdminLogin(){
//    }
}
