<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Formations;
use App\Models\Cours;
use App\Providers\RouteServiceProvider;
use App\Providers\AppServiceProvider;
use App\Models\cours_users;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class FormationController extends Controller
{
    // Affiche la vue pour ajouter une formation
    public function addFormationsForm() {
            return view('admin.addFormation');
        }

    // fonction qui ajoute des formations a la bdd 
    public function createFormations(Request $request )
    {
        $validated = $request->validate([
                'intitule'=> 'nullable|alpha_spaces|max:50',
        ]);

        if (DB::table("formations")->where("intitule", "LIKE", $validated ["intitule"])->first() != null){
            // La formation existe deja
        $request->session()->flash('error', 'Impossible la formation existe deja !');
        return redirect()->route('add');
        }

        $f = new Formations();
        $f-> intitule = $validated['intitule'];
        $f->save();

        $request->session()->flash('etat', 'Formation créer !');
        return redirect()->route('home');
    }

    //fonction qui ajoute des cours a la bdd
    public function createCourses(Request $request)
    {
        $validated = $request->validate([
            'intitule'=> 'alpha_spaces|max:50',
            'formation'=>'nullable|integer',
            'user'=>'nullable|integer',
        ]);

        if (DB::table("cours")->where("intitule", "LIKE", $validated ["intitule"])->first() != null){
            // La formation existe deja
        $request->session()->flash('error', 'Impossible le cours existe deja !');
        return redirect()->route('addCours');
        }

        $cours = new Cours();
        $cours->intitule = $validated['intitule'];
        $cours->formation_id = $validated['formation'];
        $cours->user_id = $validated['user'];

        $cours->save();

        $request->session()->flash('etat', 'Cours créer !');
        return redirect()->route('home');
    }

    // affiche la vue d'ajout de cours
    public function addCoursForm(){
        $formations = Formations::all();
        $user = new User;
        $enseignants = $user->enseignants();
        return view('admin.addCours', ["formations" => $formations, "enseignants" => $enseignants]);
    }

public function indexConfig(Request $request)
{
    $type = $request->query('type'); // Récupérer la valeur du paramètre de requête 'type'
    $search = $request->query('search'); // Récupérer la valeur du paramètre de requête 'search'

    $query = User::query();

    // Filtrer les utilisateurs en fonction du type si le paramètre 'type' est présent
    if ($type === 'etudiant') {
        $query->where('type', 'etudiant');
    } elseif ($type === 'enseignant') {
        $query->where('type', 'enseignant');
    }

    // Effectuer la recherche par nom/prénom/login si le paramètre 'search' est présent
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nom', 'LIKE', "%$search%")
                ->orWhere('prenom', 'LIKE', "%$search%")
                ->orWhere('login', 'LIKE', "%$search%");
        });
    }

    // Récupérer les utilisateurs paginés en utilisant la requête construite
    $usr = $query->orderBy('created_at')->simplePaginate(10);

    return view('admin.gestionUtilisateur', ['users' => $usr]);
}



    public function modifyType(Request $request, $id){
        $user = Auth::user();
        if ($user->type == "etudiant" || $user->type == "enseignant") {
            return redirect ("/");
        }
        $target = User::find($id);
        if ($target == null) {
            $request->session()->flash("error", 'Impossible de cibler l id ');
            return redirect("/gestion");
        }
        $formation_id = $target->formation_id;
        if ($formation_id == null) {
            $request->validate([
                'type' => 'required|in:admin,enseignant'
            ]);
        } else {
            $request->validate([
                'type' => 'required|in:etudiant'
            ]);
        }
        $target->type = $request->type;
        $target->save();
        $request->session()->flash("etat", "Modification effectuée.");
        return redirect("/home");
    }
    

    // Affiche le formulaire de changement de type
    public function TypeForm(Request $request, $id){
      
    $target = User::find($id);
    if ($target == null) {
        $request->session()->flash("error", "Impossible de cibler l'utilisateur");
        return redirect("/config");
    }

    if ($target->type != null) {
        $request->session()->flash("error", "L'utilisateur a déjà un type défini.");
        return redirect("/config");
    }
    return view("admin.modifyType", ["users" => $target]);
    }

    //Affiche la vue de tout les cours pour un admin
    public function CoursForm()
    {
        $cours = Cours::simplePaginate(10);
        return view("admin.coursAdmin", ["cours" => $cours]);
    }
    
    //Affiche la vue de tout les foramtions pour un admin
    public function FormationsForm(){
        $formations = Formations::simplePaginate(10);
        return view("admin.FormationsAdmin",["formations"=>$formations]);
    }

    //Affiche la vue des cours d'un étudiant
    public function listeCoursFormation()
    {
        $user = Auth::user();

        // Récupérer la formation de l'étudiant
        $formation = Formations::find($user->formation_id);
        
        // Vérifier que l'utilisateur est inscrit à une formation
        if ($user->formation_id) {
            // Récupérer la liste des cours de la formation
            $cours = Cours::where('formation_id', $user->formation_id)->get();
    
            // Renvoyer la vue avec la liste des cours
            return view('etudiant.coursEtu', ["cours" => $cours,"formation" => $formation]);
        } else {
            // Renvoyer un message d'erreur si l'utilisateur n'est pas inscrit à une formation
            return back()->with('error', 'Vous n\'êtes pas inscrit à une formation.');
        }
    }

    // fonction pour filtrer par intitule
    public function rechercheParIntitule(Request $request)
{
    // Récupérer l'intitulé recherché depuis la requête
    $intitule = $request->input('intitule');

    // Effectuer la recherche dans la base de données
    $resultats = Cours::where('intitule', 'like', '%' . $intitule . '%')->get();

    // Retourner la vue avec les résultats de la recherche
    return view('admin.rechercherAdmin', ['resultats' => $resultats]);
}

// modifier l'intitulé d'une formation
public function modifyCours(Request $request,$id){

    $validated = $request->validate([
        'intitule'=> 'nullable|alpha_spaces|max:50',
]);
    $Cours = Cours::find($id);

    if($Cours === null){
        $request->session()->flash('error','Impossible de modifier le cours car inexistant');
        return redirect()->route('/');
    }

    $Cours->intitule = $validated["intitule"];
    $Cours->save();

    $request->session()->flash('etat','Cours modifié avec succes !');
    return redirect()->route('home');
}

public function modifyCoursForm(Request $request,$id){
    $cours = Cours::find($id);

    if($cours === null){
        $request->session()->flash('error','Impossible de modifier le cours car inexistant');
        return redirect()->route('cours');
    }

    return view('admin.modifyCours',["cours"=>$cours]);
}

public function deleteCours(Request $request, $id)
{
    $cours = Cours::find($id);

    if ($cours === null) {
        $request->session()->flash('error', 'Oops, Une erreur est survenue.');
        return redirect()->route('cours');
    }

    // Supprimer les plannings associés au cours
    $cours->plannings()->delete();

    // Supprimer les relations cours-users associées au cours
    $cours->users()->detach();

    // Supprimer le cours lui-même
    $cours->delete();

    $request->session()->flash('etat', 'Cours supprimé.');
    return redirect()->route('home');
}

// Affiche la vue de suppression d'un cours
public function deleteCoursForm($id){
    $cours = Cours::find($id);
    return view('admin.deleteCours') -> with('cours',$cours);
}
//retourn la liste des enseignant avec leurs cours associés
public function getCoursEnseignants(Request $request)
{
    $enseignants = User::where('type', 'enseignant')->with('coursEnseignant')->get();

    if ($enseignants->isEmpty()) {
        $request->session()->flash('error', 'Aucun enseignant trouvé.');
        return redirect()->back();
    }

    $request->session()->flash('success', 'Liste des cours associés à tous les enseignants récupérée avec succès.');

    return view('admin.listeCoursEnseignant')->with('enseignants', $enseignants);
}

public function gererSeanceForm(Request $request)
{
    $search = $request->query('search');

    // Récupérer les enseignants avec leurs cours
    $enseignants = User::where('type', 'enseignant')->with('cours')->get();

    // Récupérer les cours avec les enseignants et les plannings associés
    $query = Cours::with('enseignants', 'plannings')->orderBy('intitule');

    if ($search) {
        $query->where('intitule', 'LIKE', "%$search%");
    }

    $cours = $query->get();

    if ($enseignants->isEmpty() && $cours->isEmpty()) {
        $request->session()->flash('error', 'Aucun enseignant et aucun cours trouvé.');
        return redirect()->back();
    } elseif ($enseignants->isEmpty()) {
        $request->session()->flash('error', 'Aucun enseignant trouvé.');
    } elseif ($cours->isEmpty()) {
        $request->session()->flash('error', 'Aucun cours trouvé.');
    } else {

    return view('admin.gerer', ['enseignants' => $enseignants, 'cours' => $cours]);
}}






}
