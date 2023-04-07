<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Formations;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ActionController extends Controller
{
    //
    public function PasswordFormEtu(Request $request){
        return view('etudiant.modifyPasswordEtu');
    }

    public function updatepasswordEtu(Request $request)
{
    $user = Auth::user();
    $currentPassword = $request->input('mdpactuel');
    $newPassword = $request->input('Nouveaumdp');

    if (Hash::check($currentPassword, $user->mdp)) {
        $this->validate($request, [
            'Nouveaumdp' => 'required|string|confirmed|min:4',
        ]);

        $user->mdp = Hash::make($newPassword);
        $user->save();

        session()->flash('etat', 'Votre mot de passe a été modifié avec succès !');
        return redirect()->route('home');
    } else {
        session()->flash('error', 'Le mot de passe actuel est incorrect.');
        return redirect()->route('accountEtu');
    }
}

public function PasswordFormProf(Request $request){
    return view('enseignant.modifyPasswordProf');
}

public function updatepasswordProf(Request $request)
{
$user = Auth::user();
$currentPassword = $request->input('mdpactuel');
$newPassword = $request->input('Nouveaumdp');

if (Hash::check($currentPassword, $user->mdp)) {
    $this->validate($request, [
        'Nouveaumdp' => 'required|string|confirmed|min:4',
    ]);

    $user->mdp = Hash::make($newPassword);
    $user->save();

    session()->flash('etat', 'Votre mot de passe a été modifié avec succès !');
    return redirect()->route('home');
} else {
    session()->flash('error', 'Le mot de passe actuel est incorrect.');
    return redirect()->route('accountProf');
}
}

public function modifyNameProf(Request $request){
    $user = Auth::user();
    $currentName = $request->input('Name');
    $currentLastName = $request->input('LastName');
    $newName = $request->input('newName');
    $newLastName = $request->input('newLastName');

    // Vérifier si les champs sont vides
    if(empty($newName) || empty($newLastName)){
        session()->flash('error', 'Le prenom et le nom sont requis');
        return redirect('modify-nom-prenom');
    }

    // Mettre à jour le nom et le prenom de l'utilisateur dans la base de données
    $user->prenom = $newName;
    $user->nom = $newLastName;
    $user->save();

    // Rediriger l'utilisateur vers la page de profil mise à jour
    session()->flash('etat', 'Votre nom/prenom a été modifié avec succès !');
    return redirect()->route('home');
}

public function nameFormProf(){
    return view ("enseignant.modifyNameProf");
}

public function nameFormEtu(){
    return view ("etudiant.modifyNameEtu");
}

public function modifyNameEtu(Request $request){
    $user = Auth::user();
    $currentName = $request->input('Name');
    $currentLastName = $request->input('LastName');
    $newName = $request->input('newName');
    $newLastName = $request->input('newLastName');

    // Vérifier si les champs sont vides
    if(empty($newName) || empty($newLastName)){
        session()->flash('error', 'Le prenom et le nom sont requis');
        return redirect('');
    }

    // Mettre à jour le nom et le prenom de l'utilisateur dans la base de données
    $user->prenom = $newName;
    $user->nom = $newLastName;
    $user->save();

    // Rediriger l'utilisateur vers la page de profil mise à jour
    session()->flash('etat', 'Votre nom/prenom a été modifié avec succès !');
    return redirect()->route('home');
}



}
