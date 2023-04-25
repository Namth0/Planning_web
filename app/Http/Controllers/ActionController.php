<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cours;
use App\Models\Formations;
use App\Models\Plannings;
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

//fonction pour qu'un etudiant s'inscrit a un cours 
public function inscriptionCours(Request $request,$id)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier que l'utilisateur est un étudiant
    if ($user->type == 'etudiant') {
        // Récupérer le cours correspondant à l'id donné en paramètre
        $cours = Cours::find($id);

        // Vérifier que le cours existe
        if ($cours) {
            // Vérifier que l'utilisateur n'est pas déjà inscrit à ce cours
            if (!$user->cours->contains($cours)) {
                // Ajouter le cours à la liste des cours de l'utilisateur
                $user->cours()->attach($cours->id);

                // Renvoyer un message de succès
                $request->session()->flash('etat', 'Vous êtes maintenant inscrit à ce cours.');
                return redirect()->route('home');
            } else {
                // Renvoyer un message d'erreur si l'utilisateur est déjà inscrit à ce cours
                $request->session()->flash('error', 'Vous êtes déjà inscrit à ce cours.');
                return redirect()->route('formations');
            }
        } else {
            // Renvoyer un message d'erreur si le cours n'existe pas
            $request->session()->flash('error', 'Ce cours n\'existe pas.');
            return redirect()->route('home');
        }
    } else {
        // Renvoyer un message d'erreur si l'utilisateur n'est pas un étudiant
        $request->session()->flash('error', 'Vous devez être un étudiant pour vous inscrire à un cours.');
        return redirect()->route('home');
    }
}

//retourne la vue pour s'inscrire a un cours
public function inscriptionCoursform($id)
{
  $cours = Cours::find($id);
  return view('etudiant.InscriptionEtu',["cours"=>$cours]) ;
}

//fonction pour qu'un etudiant de desinscris a un cours
public function desinscriptionCours(Request $request, $id) {
    $user = Auth::user(); // Récupération de l'utilisateur connecté
    $cours = Cours::find($id); // Récupération du cours correspondant à l'id
    $type = $user->type; // Récupération du type de l'utilisateur connecté (étudiant, enseignant ou admin)
    
    // Vérification si l'utilisateur est bien inscrit au cours
    if(!$cours->etudiants->contains($user)) {
        $request->session()->flash('error', 'Vous n\'êtes pas inscrit à ce cours.');
        return redirect()->route('formations');
    }
  
    // Suppression de la relation entre le cours et l'utilisateur
    $cours->etudiants()->detach($user);
    $request->session()->flash('etat', 'Vous avez été désinscrit du cours "' . $cours->intitule . '".');
    return redirect()->route('home');
}


  //retourne la vue pour s'inscrire a un cours
public function desinscriptionCoursform($id)
{
  $cours = Cours::find($id);
  return view('etudiant.DesinscriptionEtu',["cours"=>$cours]) ;
}

//liste des cours  d'un etudiant ausquel il est inscrit
public function listeCoursInscrits()
{
    $user = Auth::user();
    $coursInscrits = $user->cours;
    return view('etudiant.ListeCoursInscritEtu', ["coursInscrits" => $coursInscrits]);
}


  public function rechercherCoursFiltrer(Request $request ,$formation_id) {

    $validated = $request->validate([
        'recherche'=> 'nullable|alpha_spaces|max:50',
]);

    $formation = Formations::find($formation_id);
    $cours = Cours::where("formation_id", $formation->id)->where("intitule", "like", $validated["recherche"])->get();

 
        // Si aucun paramètre de recherche n'est passé, afficher tous les cours de la formation

    return view('etudiant.coursEtu', ['formation' => $formation, 'cours' => $cours]);
  }


  public function listeCoursResponsable()
{
    $cours = Cours::whereHas("enseignants", function($query) {
        $query->where("users.id", "=", Auth::user()->id);
    })->get();

    return view('enseignant.listeCoursResponsable', ['cours' => $cours]);
}

public function creerSeanceCours(Request $request, $cours_id)
{
    // Validation des données de la requête
    $validated = $request->validate([
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
    ]);

    // Recherche du cours associé à l'ID fourni
    $cours = Cours::find($cours_id);

    // Création d'une nouvelle séance de cours pour ce cours
    $seance = new Plannings();
    $seance->cours_id = $cours->id;
    $seance->date_debut = $validated['date_debut'];
    $seance->date_fin = $validated['date_fin'];
    $seance->save();
    $request->session()->flash('etat','Nouvelle seance creer !');
    // Redirection vers la page du cours avec un message de confirmation
    return redirect()->route('home');
}

public function creerSeanceForm($cours_id)
{
    // Recherche du cours associé à l'ID fourni
    $cours = Cours::find($cours_id);

    // Renvoyer la vue de création d'une nouvelle séance de cours pour ce cours
    return view('enseignant.AddSeanceProf', ['cours' => $cours]);
}

public function modifierSeanceCours(Request $request, $seance_id)
{
    // Recherche de la séance de cours associée à l'ID fourni
    $seance = Plannings::find($seance_id);

    // Vérification que la séance existe
    if (!$seance) {
        $request->session()->flash('error','La séance n\'existe pas !');
        return redirect()->back();
    }

    // Validation des données de la requête
    $validated = $request->validate([
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
    ]);

    // Mise à jour des informations de la séance de cours
    $seance->date_debut = $validated['date_debut'];
    $seance->date_fin = $validated['date_fin'];
    $seance->save();
    $request->session()->flash('etat','La séance a été modifiée !');

    // Redirection vers la page du cours avec un message de confirmation
    return redirect()->route('home');
}


public function editerSeanceForm($seance_id)
{
    // Récupération de la séance de cours associée à l'ID fourni
    $seance = Plannings::find($seance_id);

    // Vérification que la séance existe
    if (!$seance) {
        // Séance inexistante, on redirige vers la page précédente avec un message d'erreur
        return redirect()->back()->with('error', 'Séance inexistante !');
    }

    // Envoi des données à la vue
    return view('enseignant.ModifySeanceProf', ['seance' => $seance]);
}

// Affichage du formulaire de confirmation de suppression d'une séance de cours
public function supprimerSeanceForm($seance_id)
{
    // Récupération de la séance de cours associée à l'ID fourni
    $seance = Plannings::find($seance_id);

    // Envoi des données à la vue
    return view('enseignant.DeleteSeanceProf', ['seance' => $seance]);
}

// Suppression d'une séance de cours
public function supprimerSeanceCours(Request $request, $seance_id)
{
    // Recherche de la séance de cours associée à l'ID fourni
    $seance = Plannings::find($seance_id);

    // Vérification que la séance existe
    if (!$seance) {
        $request->session()->flash('error','Séance inexistante !');
        return redirect()->route('responsable');
    }

    // Suppression de la séance de cours
    $seance->delete();
    $request->session()->flash('etat','Séance supprimée !');

    // Redirection vers la page du cours avec un message de confirmation
    return redirect()->route('home');
}




}
