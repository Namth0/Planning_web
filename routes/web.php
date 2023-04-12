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
    Route::get('/type/{id}', [FormationController::class, 'TypeForm'])->name('type');
    Route::post('/type/{id}', [FormationController::class,'modifyType']);
    Route::post('/addCours',[FormationController::class,'createCourses']);
    Route::get('/addCours',[FormationController::class,'addCoursForm'])->name('addCours');
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


/*
|--------------------------------------------------------------------------
| Enseignant
|--------------------------------------------------------------------------
*/
Route::get('/accountProf',[ActionController::class,'PasswordFormProf'])->name('accountProf');
Route::post('/accountProf',[ActionController::class,'UpdatePasswordProf']);
Route::get('/modify-nom-prenom',[ActionController::class,'nameFormProf'])->name('modify-nom-prenom');
Route::post('/modify-nom-prenom',[ActionController::class,'modifyNameProf']);


