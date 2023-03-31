<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $p = User::all();
        return view('home') -> with('user',$p);
        }
}
