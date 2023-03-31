<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //
    public function formRegister(){
        return view('auth.register');
        }

        
        public function register(Request $request){
        $request->validate([
        'prenom' => 'required|string|max:50',
        'nom' => 'required|string|max:50',
        'login' => 'required|string|max:30|unique:users',
        'mdp' => 'required|string|confirmed'
        ]);

        $user = new User();
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->save();

        session()->flash('etat','formulaire rempli attente de verification !');

        Auth::login($user);
        return redirect('/home');
        }
        
}
