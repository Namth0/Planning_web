<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cours;
use App\Models\Formations;
use App\Models\cours_users;
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
        return redirect()->route('modify-nom-prenom-etu');
    }

    // Mettre à jour le nom et le prenom de l'utilisateur dans la base de données
    $user->prenom = $newName;
    $user->nom = $newLastName;
    $user->save();

    // Rediriger l'utilisateur vers la page de profil mise à jour
    session()->flash('etat', 'Votre nom/prenom a été modifié avec succès !');
    return redirect()->route('home');
}


// fonction pour associer un prof a un cours 
// public function associerProf(Request $request, $coursId, $profId)
// {
//     // Vérifier que le cours et le prof existent
//     $cours = Cours::find($coursId);
//     $prof = User::find($profId);
//     if (!$cours || !$prof) {
//         $request->session()->flash('error', 'Cours ou professeur inexistant');
//         return redirect()->route('associer');
//     }

//     // Vérifier que le prof n'est pas déjà associé au cours
//     if ($cours->user_id->contains($prof)) {
//         $request->session()->flash('error', 'Ce professeur est déjà associé à ce cours');
//         return redirect()->route('associer');
//     }

//     // Associer le prof au cours
//     $cours->users()->attach($prof);

//     $request->session()->flash('etat', 'Professeur ajouté au cours avec succès');
//     return redirect()->route('home');
// }
public function associerProf(Request $request)
{
    // Récupérer l'ID du cours à associer depuis le formulaire
    $coursId = $request->input('id');
    // Vérifier que le cours existe
    $cours = Cours::find($coursId);
    if (!$cours) {
        $request->session()->flash('error', 'Cours inexistant');
        return redirect()->route('associer');
    }

    // Récupérer l'ID du professeur à associer depuis le formulaire
    $profId = $request->input('professeur_id');
    // Vérifier que le prof existe
    $prof = User::find($profId);
    if (!$prof || $prof->type !== 'enseignant') {
        $request->session()->flash('error', 'Professeur inexistant ou incorrect');
        return redirect()->route('associer');
    }

    // Associer le prof au cours
    $cours->users()->attach($prof);

    $request->session()->flash('etat', 'Professeur ajouté au cours avec succès');
    return redirect()->route('home');
}

public function AssocierForm()
{
    // $cours = Cours::findOrFail($coursId);
    // $profs = User::where('type', 'prof')->get();
    // return view('admin.addProfToCours', ["cours" => $cours, "enseignant" => $profs]);
    // Récupérer tous les cours
    $cours = Cours::all();
    // Récupérer tous les profs
    $profs = User::where('type', 'enseignant')->get();
   
    // Vérifier si la requête a réussi
    if (!$cours) {
        // Afficher un message d'erreur si la requête a échoué
        return view('error', ['message' => 'Impossible de récupérer les cours']);
    }

    // Vérifier si la requête a réussi
    if (!$profs) {
        // Afficher un message d'erreur si la requête a échoué
        return view('error', ['message' => 'Impossible de récupérer les professeurs']);
    }

    // Afficher la vue en envoyant les données des cours et des profs
    return view('admin.addProfToCours', ['cours' => $cours, 'profs' => $profs]);
}




}
