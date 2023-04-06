<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Formations;
use App\Providers\RouteServiceProvider;
use App\Providers\AppServiceProvider;
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
                'intitule'=> 'required|alpha_spaces|max:50',
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
    // retourne la vue de configuration
    public function indexConfig()
    {
        $usr = User::where('type', null)->orderBy('created_at')->get();
      
        
        return view('admin.gestionUtilisateur', ['users' => $usr]);
    }

    //fonction qui modifie le type d'un utilisateur ( etudiant ou enseignant )
    public function modifyType(Request $request, $id){
        //change le statut du type 
        $user = Auth::user();
        if( $user->type == "etudiant"|| $user->type == "enseignant" ) {
            return redirect ("/");
        }
        $target = User::find($id);
    if ($target == null) {
        $request->session()->flash("error", 'Impossible de cibler l id ');
        return redirect("/gestion");
    }
    $request->validate([
        'type' => 'required|in:etudiant,enseignant'
    ]);
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
}
