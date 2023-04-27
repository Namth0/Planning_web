<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ActionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/home','home');

/*
|--------------------------------------------------------------------------
| Accueil
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class,'formRegister'])
    ->name('register');
Route::post('/register', [RegisterController::class,'register']);

Route::get('/login', [AuthenticatedSessionController::class,'showForm'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);

Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::post('/add', [FormationController::class, 'createFormations']);
    Route::get('/add', [FormationController::class, 'addFormationsForm'])->name('add');
    Route::get('/config', [FormationController::class, 'indexConfig'])->name('index')->name('config');
    Route::get('/cours', [FormationController::class, 'CoursForm'])->name('cours');
    Route::get('/formation',[FormationController::class,'FormationsForm'])->name('formation');
    Route::get('/type/{id}', [FormationController::class, 'TypeForm'])->name('type');
    Route::post('/type/{id}', [FormationController::class,'modifyType']);
    Route::post('/addCours',[FormationController::class,'createCourses']);
    Route::get('/addCours',[FormationController::class,'addCoursForm'])->name('addCours');
    Route::post('/associer',[ActionController::class,'associerProf']);
    Route::get('/associer',[ActionController::class,'AssocierForm'])->name("associer");
    Route::get('/modifyFormation/{id}', [ActionController::class, 'modifyFormationsForm'])->name('modifyFormation');
    Route::post('/modifyFormation/{id}', [ActionController::class,'modifyFormations']);
    Route::get('/deleteFormation/{id}', [ActionController::class, 'suppForm'])->name('deleteFormation');
    Route::post('/deleteFormation/{id}', [ActionController::class,'deleteFormation']);
    Route::post('/rechercher', [FormationController::class,'rechercheParIntitule']);
    Route::get('/rechercher', [FormationController::class,'rechercheParIntitule'])->name('rechercher');
    Route::get('/modifyCours/{id}', [FormationController::class, 'modifyCoursForm'])->name('modifyCours');
    Route::post('/modifyCours/{id}', [FormationController::class,'modifyCours']);
    Route::get('/deleteCours/{id}', [FormationController::class, 'deleteCoursForm'])->name('deleteCours');
    Route::post('/deleteCours/{id}', [FormationController::class,'deleteCours']);
    Route::get('/ProfAndCours/',[FormationController::class,'getCoursEnseignants'])->name('ProfAndCours');
    Route::get('/creerUser', [RegisterController::class,'formRegisterUser']) ->name('creerUser');
    Route::post('/creerUser', [RegisterController::class,'RegisterUserAdmin']);
    Route::get('/modifyAll/{id}', [ActionController::class, 'UpdateUserForm'])->name('modifyAll');
    Route::post('/modifyAll/{id}', [ActionController::class,'updateUser']);
    Route::get('/deleteUser/{id}', [ActionController::class, 'deleteUserForm'])->name('deleteUser');
    Route::post('/deleteUser/{id}', [ActionController::class,'deleteUser']);


});

/*
|--------------------------------------------------------------------------
| Etudiant
|--------------------------------------------------------------------------
*/
Route::get('/accountEtu',[ActionController::class,'PasswordFormEtu'])->name('accountEtu');
Route::post('/accountEtu',[ActionController::class,'UpdatePasswordEtu']);
Route::get('/modify-nom-prenom-etu',[ActionController::class,'nameFormEtu'])->name('modify-nom-prenom-etu');
Route::post('/modify-nom-prenom-etu',[ActionController::class,'modifyNameEtu']);
Route::get('/formations', [FormationController::class, 'listeCoursFormation'])->name('formations');
Route::post('/InscriptionEtu/{id}/',[ActionController::class,'inscriptionCours'])->name('InscriptionEtu');
Route::get('/InscriptionEtu/{id}/', [ActionController::class, 'inscriptionCoursform'])->name('InscriptionEtu');
Route::post('/DesinscriptionEtu/{id}/',[ActionController::class,'desinscriptionCours'])->name('DesinscriptionEtu');
Route::get('/DesinscriptionEtu/{id}/', [ActionController::class, 'desinscriptionCoursform'])->name('DesinscriptionEtu');
Route::get('/courses',[ActionController::class,'listeCoursInscrits'])->name('courses');
Route::post('/formations/{formation_id}', [ActionController::class, 'rechercherCoursFiltrer'])->name('formations');
Route::get('/perCoursEtu', [ActionController::class,'listeCoursEtudiantParCours'])->name('perCourseEtu');
Route::get('/perSemaineEtu', [ActionController::class,'listeCoursParSemaineEtu'])->name('perSemaineEtu');




/*
|--------------------------------------------------------------------------
| Enseignant
|--------------------------------------------------------------------------
*/
Route::get('/accountProf',[ActionController::class,'PasswordFormProf'])->name('accountProf');
Route::post('/accountProf',[ActionController::class,'UpdatePasswordProf']);
Route::get('/modify-nom-prenom',[ActionController::class,'nameFormProf'])->name('modify-nom-prenom');
Route::post('/modify-nom-prenom',[ActionController::class,'modifyNameProf']);
Route::get('/responsable',[ActionController::class,'listeCoursResponsable'])->name('responsable');
Route::post('/seance/{id}/',[ActionController::class,'creerSeanceCours'])->name('seance');
Route::get('/seance/{id}/', [ActionController::class, 'creerSeanceForm'])->name('seance');
Route::post('/modifySeance/{id}/',[ActionController::class,'modifierSeanceCours'])->name('modifySeance');
Route::get('/modifySeance/{id}/', [ActionController::class, 'editerSeanceForm'])->name('modifySeance');
Route::put('/modifySeance/{id}', [ActionController::class,'modifierSeanceCours'])->name('modifySeance');
Route::get('/deleteSeance/{id}/', [ActionController::class, 'supprimerSeanceForm'])->name('modifySeance');
Route::post('/deleteSeance/{id}', [ActionController::class,'supprimerSeanceCours'])->name('modifySeance');
Route::get('/perCours', [ActionController::class,'listeCoursResponsableParCours'])->name('perCours');
Route::get('/perSemaine', [ActionController::class,'listeCoursParSemaine'])->name('perSemaine');


