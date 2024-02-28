<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarInscriptionController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ClasseCoursController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\DetailsPayementController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ExamenNoteController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\PaymentScolariteController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\UserController;
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


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('create', [AuthController::class, 'create'])->name('createPending');
    Route::get('account-pending', [AuthController::class, 'accountPending'])->name('account-pending');

    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('passowrd.forgot');
    Route::post('check-password', [AuthController::class, 'resetPassword'])->name('passowrd.send-reset-link');
    Route::get('reset-password/{token}/{email}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPasswordFormSubmit'])->name('passowrd.reset-action');

});



Route::middleware(['auth'])->group(function () {

    Route::get('my-profile', [UserController::class, 'index'])->name('my-profile');
    //Route::put('my-profile', [UserController::class, 'update'])->name('my-profile.update');
    /**
     * DASHBOARD
     */
    Route::get('dashboard', [MainController::class, 'dashboard'])->name('dashboard');


    /**
     * Annee Scolaire
     */
    Route::get('annee-scolaire', [AnneeScolaireController::class, 'index'])->name('years.index');
    Route::get('annee-scolaire/create', [AnneeScolaireController::class, 'create'])->name('years.create');
    Route::post('annee-scolaire/store', [AnneeScolaireController::class, 'store'])->name('years.store');
    Route::get('annee-scolaire/{anneeScolaire}', [AnneeScolaireController::class, 'show'])->name('years.show');
    Route::get('annee-scolaire/{anneeScolaire}/edit', [AnneeScolaireController::class, 'edit'])->name('years.edit');
    Route::put('annee-scolaire/{anneeScolaire}', [AnneeScolaireController::class, 'update'])->name('years.update');
    Route::delete('annee-scolaire/{anneeScolaire}', [AnneeScolaireController::class, 'destroy'])->name('years.destroy');

    /**
     * Scolarite
     */
    Route::get('scolarite', [PaymentScolariteController::class, 'index'])->name('scolarite.index');
    Route::get('scolarite/create', [PaymentScolariteController::class, 'create'])->name('scolarite.create');
    Route::post('scolarite/store', [PaymentScolariteController::class, 'store'])->name('scolarite.store');
    Route::get('scolarite/{paymentScolarite}', [PaymentScolariteController::class, 'show'])->name('scolarite.show');
    Route::get('scolarite/{paymentScolarite}/edit', [PaymentScolariteController::class, 'edit'])->name('scolarite.edit');
    Route::put('scolarite/{paymentScolarite}', [PaymentScolariteController::class, 'update'])->name('scolarite.update');
    Route::delete('scolarite/{paymentScolarite}', [PaymentScolariteController::class, 'destroy'])->name('scolarite.destroy');

   /**
    * Versements
    */
    Route::get('versements', [DetailsPayementController::class, 'index'])->name('versement.index');
    Route::get('versements/create', [DetailsPayementController::class, 'create'])->name('versement.create');
    Route::get('versements/{paymentScolarite}/create', [DetailsPayementController::class, 'createByEtudiant'])->name('versement.etudiant.create');
    Route::post('versements/store', [DetailsPayementController::class, 'store'])->name('versement.store');
    Route::get('versements/{detailsPayement}', [DetailsPayementController::class, 'show'])->name('versement.show');
    Route::get('versements/{detailsPayement}/edit', [DetailsPayementController::class, 'edit'])->name('versement.edit');
    Route::put('versements/{detailsPayement}', [DetailsPayementController::class, 'update'])->name('versement.update');
    Route::delete('versements/{detailsPayement}', [DetailsPayementController::class, 'destroy'])->name('versement.destroy');



    /**
     * Salles
     */
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

    //classe emploi du temps
    Route::get('classe/{classe}/emplois', [ClasseController::class, 'emploie'])->name('classe.createEmploi');

    //filieres
    Route::get('filiere', [FiliereController::class, 'index'])->name('filiere.index');
    Route::get('filiere/create', [FiliereController::class, 'create'])->name('filiere.create');
    Route::post('filiere/store', [FiliereController::class, 'store'])->name('filiere.store');
    Route::get('filiere/{filiere}', [FiliereController::class, 'show'])->name('filiere.show');
    Route::get('filiere/{filiere}/edit', [FiliereController::class, 'edit'])->name('filiere.edit');
    Route::put('filiere/{filiere}', [FiliereController::class, 'update'])->name('filiere.update');
    Route::delete('filiere/{filiere}', [FiliereController::class, 'destroy'])->name('filiere.destroy');


    //emplois du temps
    // Route::get('emplois', [EmploiDuTempsController::class, 'index'])->name('emplois.index');
    // Route::get('emplois/create', [EmploiDuTempsController::class, 'create'])->name('emplois.create');
    // Route::post('emplois/store', [EmploiDuTempsController::class, 'store'])->name('emplois.store');
    // Route::get('emplois/{emplois}', [EmploiDuTempsController::class, 'show'])->name('emplois.show');
    // Route::get('emplois/{emplois}/edit', [EmploiDuTempsController::class, 'edit'])->name('emplois.edit');
    // Route::put('emplois/{emplois}', [EmploiDuTempsController::class, 'update'])->name('emplois.update');
    // Route::delete('emplois/{emplois}', [EmploiDuTempsController::class, 'destroy'])->name('emplois.destroy');

    //evenements
    Route::get('evenements', [EvenementController::class, 'index'])->name('evenements.index');

    //administration
    Route::get('administration-in', [AdministrationController::class, 'index'])->name('administration.index');
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

    //parents
    Route::get('parents', [ParentsController::class, 'index'])->name('parents.index');
    Route::get('parents/{etudiant}/create', [ParentsController::class, 'create'])->name('parents.create');
    Route::post('parents/store', [ParentsController::class, 'store'])->name('parents.store');
    Route::get('parents/{parents}', [ParentsController::class, 'show'])->name('parents.show');
    Route::get('parents/{parents}/edit', [ParentsController::class, 'edit'])->name('parents.edit');
    Route::put('parents/{parents}', [ParentsController::class, 'update'])->name('parents.update');
    Route::delete('parents/{parents}', [ParentsController::class, 'destroy'])->name('parents.destroy');


    //professeurs
    Route::get('professeurs', [ProfesseurController::class, 'index'])->name('professeur.index');
    Route::get('professeurs/create', [ProfesseurController::class, 'create'])->name('professeur.create');
    Route::post('professeurs/store', [ProfesseurController::class, 'store'])->name('professeur.store');
    Route::get('professeurs/{professeur}', [ProfesseurController::class, 'show'])->name('professeur.show');
    Route::get('professeurs/{professeur}/edit', [ProfesseurController::class, 'edit'])->name('professeur.edit');
    Route::put('professeurs/{professeur}', [ProfesseurController::class, 'update'])->name('professeur.update');
    Route::delete('professeurs/{professeur}', [ProfesseurController::class, 'destroy'])->name('professeur.destroy');

    //EXAMENS
    Route::get('examens', [ExamenController::class, 'index'])->name('examens.index');
    Route::get('examens/create', [ExamenController::class, 'create'])->name('examens.create');
    Route::post('examens/store', [ExamenController::class, 'store'])->name('examens.store');
    Route::get('examens/{examen}', [ExamenController::class, 'show'])->name('examens.show');
    Route::get('examens/{examen}/edit', [ExamenController::class, 'edit'])->name('examens.edit');
    Route::put('examens/{examen}', [ExamenController::class, 'update'])->name('examens.update');
    Route::delete('examens/{examen}', [ExamenController::class, 'destroy'])->name('examens.destroy');

    //EXAMENS NOTES
    Route::get('examens/{examen}/notes', [ExamenNoteController::class, 'index'])->name('examens.notes.index');
    Route::get('examens/{examen}/notes/create', [ExamenNoteController::class, 'create'])->name('examens.notes.create');
    Route::post('examens/{examen}/notes/store', [ExamenNoteController::class, 'store'])->name('examens.notes.store');
    Route::get('examens/{examen}/notes/{examenNote}', [ExamenNoteController::class, 'show'])->name('examens.notes.show');
    Route::get('examens/{examen}/notes/{examenNote}/edit', [ExamenNoteController::class, 'editNote'])->name('examens.notes.edit');
    Route::put('examens/{examen}/notes/{examenNote}', [ExamenNoteController::class, 'update'])->name('examens.notes.update');
    Route::delete('examens/{examen}/notes/{examenNote}', [ExamenNoteController::class, 'destroy'])->name('examens.notes.destroy');


    /**
     * CAR & Transport
     */
    Route::get('cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('cars/store', [CarController::class, 'store'])->name('cars.store');
    Route::get('cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    /**
     * CAR INSCRIPTION
     */
    Route::get('cars/inscription', [CarInscriptionController::class, 'index'])->name('car_inscriptions.index');
    Route::get('cars/inscription/create', [CarInscriptionController::class, 'create'])->name('car_inscriptions.create');
    Route::post('cars/inscription/store', [CarInscriptionController::class, 'store'])->name('car_inscriptions.store');
    Route::get('cars/inscription/{carInscription}', [CarInscriptionController::class, 'show'])->name('car_inscriptions.show');
    Route::get('cars/inscription/{carInscription}/edit', [CarInscriptionController::class, 'edit'])->name('car_inscriptions.edit');
    Route::put('cars/inscription/{carInscription}', [CarInscriptionController::class, 'update'])->name('car_inscriptions.update');
    Route::delete('cars/inscription/{carInscription}', [CarInscriptionController::class, 'destroy'])->name('car_inscriptions.destroy');
    //by incription
    Route::get('cars/inscription/{inscription}/etudiants', [CarInscriptionController::class, 'addVersement'])->name('car_inscriptions.addVersement');
    Route::post('cars/inscription/{inscription}/etudiants', [CarInscriptionController::class, 'storeVersement'])->name('car_inscriptions.storeVersement');
    Route::delete('cars/inscription/{inscription}/{versement}', [CarInscriptionController::class, 'destroyVersement'])->name('car_inscriptions.destroyVersement');





    Route::post('validate-account', [AuthController::class, 'activateAccount'])->name('validate-account');

    /**
     * LOGOUT
     */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

});














