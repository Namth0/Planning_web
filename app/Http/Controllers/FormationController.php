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
}
