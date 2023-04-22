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

    

    // retourne la vue de configuration
    public function indexConfig()
    {
        $usr = User::where('type', null)->orderBy('created_at')->get();
      
        
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

}
