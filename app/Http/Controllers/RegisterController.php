<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Formations;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    // renvoie la vue pour s'enregister
    public function formRegister(){
        $formations = Formations::all();
        return view('auth.register',["formations"=>$formations]);
        }

        // fonction pour s'enregister
        public function register(Request $request){
        $request->validate([
        'prenom' => 'required|string|max:50',
        'nom' => 'required|string|max:50',
        'login' => 'required|string|max:30|unique:users',
        'formation'=>'nullable|integer',
        'mdp' => 'required|string|confirmed',
        ]);

        $user = new User();

        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->login = $request->login;
        $user->formation_id  = $request->formation;
        $user->mdp = Hash::make($request->mdp);
        $user->save();

        session()->flash('etat','formulaire rempli attente de verification !');
        return redirect("/home");
        }

        // pour creer un utilisateur en tant qu'admin
    public function RegisterUserAdmin(Request $request){
        $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'login' => 'required|string|max:30|unique:users',
            'formation'=>'nullable|integer',
            'mdp' => 'required|string|confirmed',
            ]);
    
            $user = new User();
    
            $user->prenom = $request->prenom;
            $user->nom = $request->nom;
            $user->login = $request->login;
            $user->formation_id  = $request->formation;
            $user->mdp = Hash::make($request->mdp);
            $user->save();
    
            session()->flash('etat','formulaire rempli attente de verification !');
            return redirect("/home");
    }
    //renvoie la vue pour creer un utilisateur en tant qu'admin
    public function formRegisterUser(){
        $formations = Formations::all();
        return view('admin.registerAdmin',["formations"=>$formations]);
        }
        
}
