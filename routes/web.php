<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ClasseCoursController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SalleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');

Route::post('/create', [AuthController::class, 'create'])->name('create');

Route::get('salles', [SalleController::class, 'index'])->name('salle.index');

Route::get('salles/create', [SalleController::class, 'create'])->name('salle.create');
Route::post('salles/store', [SalleController::class, 'store'])->name('salle.store');
Route::get('salles/{salle}', [SalleController::class, 'show'])->name('salle.show');
Route::get('salles/{salle}/edit', [SalleController::class, 'edit'])->name('salle.edit');
Route::put('salles/{salle}', [SalleController::class, 'update'])->name('salle.update');
Route::delete('salles/{salle}', [SalleController::class, 'destroy'])->name('salle.destroy');

//cours
Route::get('cours', [CoursController::class, 'index'])->name('cours.index');
Route::get('cours/create', [CoursController::class, 'create'])->name('cours.create');
Route::post('cours/store', [CoursController::class, 'store'])->name('cours.store');
Route::get('cours/{cours}', [CoursController::class, 'show'])->name('cours.show');
Route::get('cours/{cours}/edit', [CoursController::class, 'edit'])->name('cours.edit');
Route::put('cours/{cours}', [CoursController::class, 'update'])->name('cours.update');
Route::delete('cours/{cours}', [CoursController::class, 'destroy'])->name('cours.destroy');

//classe
Route::get('classe', [ClasseController::class, 'index'])->name('classe.index');
Route::get('classe/create', [ClasseController::class, 'create'])->name('classe.create');
Route::post('classe/store', [ClasseController::class, 'store'])->name('classe.store');
Route::get('classe/{classe}', [ClasseController::class, 'show'])->name('classe.show');
Route::get('classe/{classe}/edit', [ClasseController::class, 'edit'])->name('classe.edit');
Route::put('classe/{classe}', [ClasseController::class, 'update'])->name('classe.update');
Route::delete('classe/{classe}', [ClasseController::class, 'destroy'])->name('classe.destroy');

//classecours
Route::get('createclassecours/{classe}', [ClasseCoursController::class, 'create'])->name('classe.createClasseCours');
Route::post('storeclassecours/{classe}', [ClasseCoursController::class, 'store'])->name('classe.storeClasseCours');

Route::get('classe/{classe}/classecours', [ClasseCoursController::class, 'index'])->name('classe.classeCours');
Route::get('classecours/{classeCours}/edit', [ClasseCoursController::class, 'edit'])->name('classe.editClasseCours');
Route::put('classecours/{classeCours}', [ClasseCoursController::class, 'update'])->name('classe.updateClasseCours');
Route::delete('classecours/{classeCours}', [ClasseCoursController::class, 'destroy'])->name('classe.destroyClasseCours');

//filieres
Route::get('filiere', [FiliereController::class, 'index'])->name('filiere.index');
Route::get('filiere/create', [FiliereController::class, 'create'])->name('filiere.create');
Route::post('filiere/store', [FiliereController::class, 'store'])->name('filiere.store');
Route::get('filiere/{filiere}', [FiliereController::class, 'show'])->name('filiere.show');
Route::get('filiere/{filiere}/edit', [FiliereController::class, 'edit'])->name('filiere.edit');
Route::put('filiere/{filiere}', [FiliereController::class, 'update'])->name('filiere.update');
Route::delete('filiere/{filiere}', [FiliereController::class, 'destroy'])->name('filiere.destroy');


//emplois du temps
Route::get('emplois', [EmploiDuTempsController::class, 'index'])->name('emplois.index');
Route::get('emplois/create', [EmploiDuTempsController::class, 'create'])->name('emplois.create');
Route::post('emplois/store', [EmploiDuTempsController::class, 'store'])->name('emplois.store');
Route::get('emplois/{emplois}', [EmploiDuTempsController::class, 'show'])->name('emplois.show');
Route::get('emplois/{emplois}/edit', [EmploiDuTempsController::class, 'edit'])->name('emplois.edit');
Route::put('emplois/{emplois}', [EmploiDuTempsController::class, 'update'])->name('emplois.update');
Route::delete('emplois/{emplois}', [EmploiDuTempsController::class, 'destroy'])->name('emplois.destroy');


//administration
Route::get('administration', [AdministrationController::class, 'index'])->name('administration.index');
Route::get('administration/create', [AdministrationController::class, 'create'])->name('administration.create');
Route::post('administration/store', [AdministrationController::class, 'store'])->name('administration.store');
Route::get('administration/{administration}', [AdministrationController::class, 'show'])->name('administration.show');
Route::get('administration/{administration}/edit', [AdministrationController::class, 'edit'])->name('administration.edit');

Route::put('administration/{administration}', [AdministrationController::class, 'update'])->name('administration.update');
Route::delete('administration/{administration}', [AdministrationController::class, 'destroy'])->name('administration.destroy');

//etudiants
Route::get('etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');
Route::get('etudiants/create', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('etudiants/store', [EtudiantController::class, 'store'])->name('etudiant.store');
Route::get('etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');
Route::get('etudiants/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiant.edit');
Route::put('etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
Route::delete('etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');


//professeurs
Route::get('professeurs', [ProfesseurController::class, 'index'])->name('professeur.index');
Route::get('professeurs/create', [ProfesseurController::class, 'create'])->name('professeur.create');
Route::post('professeurs/store', [ProfesseurController::class, 'store'])->name('professeur.store');
Route::get('professeurs/{professeur}', [ProfesseurController::class, 'show'])->name('professeur.show');
Route::get('professeurs/{professeur}/edit', [ProfesseurController::class, 'edit'])->name('professeur.edit');
Route::put('professeurs/{professeur}', [ProfesseurController::class, 'update'])->name('professeur.update');
Route::delete('professeurs/{professeur}', [ProfesseurController::class, 'destroy'])->name('professeur.destroy');







Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');










