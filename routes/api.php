<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\SalleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('changeAdmin-state/{id}', [AdministrationController::class, 'changeStatus'])->name('api.administration.change-state');
Route::put('changeClasse-state/{id}', [ClasseController::class,  'changeStatus'])->name('api.classe.change-state');
Route::put('changeFiliere-state/{id}', [FiliereController::class,  'changeStatus'])->name('api.filiere.change-state');
Route::put('changeCours-state/{id}', [CoursController::class, 'changeStatus'])->name('api.cours.changestate');
Route::put('changeSalle-state/{id}', [SalleController::class, 'changeStatus'])->name('api.salle.changestate');


//classe emploi du temps
Route::get('get-emplois/{id}', [ClasseController::class, 'getAll'])->name('api.classe.get-emplois');
Route::post('store-emploi', [ClasseController::class, 'storeEmploi'])->name('api.classe.store-emploi');
Route::delete('destroy-emploi/{id}', [ClasseController::class, 'destroyEmploi'])->name('api.classe.destroy-emploi');

//evenements
Route::post('store-evenement', [EvenementController::class, 'store'])->name('api.evenement.store');
Route::delete('destroy-evenement/{evenement}', [EvenementController::class, 'destroy'])->name('api.evenement.destroy');

//examen
Route::get('get-examens/{id}', [ExamenController::class, 'getAll'])->name('api.examen.get-all');
Route::post('store-examen', [ExamenController::class, 'store'])->name('api.examen.store');
Route::delete('destroy-examen/{examen}', [ExamenController::class, 'destroy'])->name('api.examen.destroy');


//annee
Route::put('changeAnnee-state/{anneeScolaire}', [AnneeScolaireController::class, 'changeStatus'])->name('api.annee-scolaire.change-state');
