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

//redirige vers la vue  pour modifier le nom d'un prof
public function nameFormProf(){
    return view ("enseignant.modifyNameProf");
}

//redirife vers la vue pour modifier le nom et prenom etc d'un etudiant
public function nameFormEtu(){
    return view ("etudiant.modifyNameEtu");
}

//fonction pour modifier le nom et prenom etc d'un etudiant
public function modifyNameEtu(Request $request){
    $user = Auth::user();
    $currentName = $request->input('Name');
    $currentLastName = $request->input('LastName');
    $newName = $request->input('newName');
    $newLastName = $request->input('newLastName');

    
    if(empty($newName) || empty($newLastName)){
        session()->flash('error', 'Le prenom et le nom sont requis');
        return redirect()->route('modify-nom-prenom-etu');
    }

    $user->prenom = $newName;
    $user->nom = $newLastName;
    $user->save();

    session()->flash('etat', 'Votre nom/prenom a été modifié avec succès !');
    return redirect()->route('home');
}

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

// modifier l'intitulé d'une formation
public function modifyFormations(Request $request,$id){

    $validated = $request->validate([
        'intitule'=> 'nullable|alpha_spaces|max:50',
]);
    $formation = Formations::find($id);

    if($formation === null){
        $request->session()->flash('error','Impossible de modifier la formation car inexistante');
        return redirect()->route('/');
    }

    $formation->intitule = $validated["intitule"];
    $formation->save();

    $request->session()->flash('etat','Formation modifié avec succes !');
    return redirect()->route('home');
}

public function modifyFormationsForm(Request $request,$id){
    $formation = Formations::find($id);

    if($formation === null){
        $request->session()->flash('error','Impossbilde de modifier la formation car inexistante');
        return redirect()->route('formation');
    }

    return view('admin.modifyFormationAdmin',["formation"=>$formation]);
}

//fonction qui suprrime une formation en utilisant le softdeletes
public function deleteFormation(Request $request, $id) {

    $formation = Formations::find($id);

    if ($formation === null) {
        $request->session()->flash('error', 'Oops, Une erreur est survenue.');
        return redirect()->route('formation');
    }
    
    $formation->delete();
    $request->session()->flash('etat', 'Formation supprimé.');
    return redirect()->route('home');
}

// Affiche la vue de suppression d'une personne

public function suppForm($id){
    $formation = Formations::find($id);
    return view('admin.deleteFormation') -> with('formation',$formation);
}

}
