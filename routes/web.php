<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentEtudiantController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarInscriptionController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\CiteController;
use App\Http\Controllers\CiteInscriptionController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ClasseCoursController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\DetailsPayementController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ExamenNoteController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\PaymentScolariteController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ReclamantionController;
use App\Http\Controllers\ReclamationResponseController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\TrajetController;
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
    Route::put('update-profile/{key}', [UserController::class, 'update'])->name('profile.update');
    Route::put('change-password', [UserController::class, 'changePassword'])->name('profile.change-password');
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

    //classecours
    Route::get('createclassecours/{classe}', [ClasseCoursController::class, 'create'])->name('classe.createClasseCours');
    Route::post('storeclassecours/{classe}', [ClasseCoursController::class, 'store'])->name('classe.storeClasseCours');
    Route::get('classe/{classe}/classecours', [ClasseCoursController::class, 'index'])->name('classe.classeCours');
    Route::get('classecours/{classeCours}/edit', [ClasseCoursController::class, 'edit'])->name('classe.editClasseCours');
    Route::put('classecours/{classeCours}', [ClasseCoursController::class, 'update'])->name('classe.updateClasseCours');
    Route::delete('classecours/{classeCours}', [ClasseCoursController::class, 'destroy'])->name('classe.destroyClasseCours');
    Route::get('downloadFile/{classeCours}', [NotesController::class, 'downloadFile'])->name('classe.addNote');

    //classe emploi du temps
    Route::get('classe/{classe}/emplois', [ClasseController::class, 'emploie'])->name('classe.createEmploi');
    Route::get('profs/{professeur}/emplois', [ClasseController::class, 'profEmploie'])->name('professeur.emploi');

    //evenements, examen, administration, professeur, etudiant, classe
    Route::resources(
        [
            'evenements' => EvenementController::class,
            'examens' => ExamenController::class,
            'administration'=> AdministrationController::class,
            'etudiant'=> EtudiantController::class,
            'professeur'=> ProfesseurController::class,
            'cars'=> CarController::class,
            'car_inscriptions'=> CarInscriptionController::class,
            'classe'=> ClasseController::class,
            'filiere'=> FiliereController::class,
            'salle'=> SalleController::class,
            'trajets'=> TrajetController::class,
            'chauffeurs'=> ChauffeurController::class,
            'cites'=>CiteController::class,
            'citeInscriptions'=>CiteInscriptionController::class,
            'chambres'=>ChambreController::class,
            'evaluations'=>EvaluationController::class,
        ],
    );
    /**
     * Cours
     */
    Route::get('cours', [CoursController::class, 'index'])->name('cours.index');
    Route::get('cours/create', [CoursController::class, 'create'])->name('cours.create');
    Route::post('cours/store', [CoursController::class, 'store'])->name('cours.store');
    Route::get('cours/{cours}/show', [CoursController::class, 'show'])->name('cours.show');
    Route::get('cours/{cours}/edit', [CoursController::class, 'edit'])->name('cours.edit');
    Route::put('cours/{cours}/update', [CoursController::class, 'update'])->name('cours.update');
    Route::delete('cours/{cours}/delete', [CoursController::class, 'destroy'])->name('cours.destroy');

    Route::get('cite-incriptions_by/{etudiant}', [CiteInscriptionController::class, 'createBy'])->name('citeInscriptions.by_etudiant');
    Route::get('car-incriptions_by/{etudiant}', [CarInscriptionController::class, 'createBy'])->name('car_inscriptions.by_etudiant');

    //parents
    Route::resource('parents', ParentsController::class)->except(['create']);
    Route::get('parents/{etudiant}/create', [ParentsController::class, 'create'])->name('parents.create');


    //EXAMENS NOTES
    Route::get('examens/{examen}/notes', [ExamenNoteController::class, 'index'])->name('examens.notes.index');
    Route::get('examens/{examen}/notes/create', [ExamenNoteController::class, 'create'])->name('examens.notes.create');
    Route::post('examens/{examen}/notes/store', [ExamenNoteController::class, 'store'])->name('examens.notes.store');
    Route::get('examens/{examen}/notes/{examenNote}', [ExamenNoteController::class, 'show'])->name('examens.notes.show');
    Route::get('examens/{examen}/notes/{examenNote}/edit', [ExamenNoteController::class, 'editNote'])->name('examens.notes.edit');
    Route::put('examens/{examen}/notes/{examenNote}', [ExamenNoteController::class, 'update'])->name('examens.notes.update');
    Route::delete('examens/{examen}/notes/{examenNote}', [ExamenNoteController::class, 'destroy'])->name('examens.notes.destroy');

    //Notes
    Route::resource('notes', NotesController::class)->except(['create']);
    Route::get('notes/create/{evaluation}', [NotesController::class, 'create'])->name('notes.create');

    //Appointment Etudiant
    Route::resource('appointment', AppointmentController::class)->except(['create', 'edit', 'store', 'update']);
    Route::get('appointment/{appointment}/etudiants', [AppointmentEtudiantController::class, 'create'])->name('appointment.etudiants.create');
    Route::post('appointment/etudiants', [AppointmentEtudiantController::class, 'store'])->name('appointment.etudiants.store');
    Route::post('appointment/{appointment}/all_are_present', [AppointmentEtudiantController::class, 'storeAllPresent'])->name('appointment.etudiants.all_present');

    //Reclamations
    Route::get('reclamations', [ReclamantionController::class, 'index'])->name('reclamations.index');
    Route::get('reclamations/{reclamantion}', [ReclamantionController::class, 'show'])->name('reclamations.show');
    Route::get('reclamations/create/{evaluation}', [ReclamantionController::class, 'createForEv'])->name('reclamations.createForEv');
    Route::get('reclamations/create/{examen}', [ReclamantionController::class, 'createForEx'])->name('reclamations.createForEx');
    Route::get('reclamations/{reclamation}/edit-examen', [ReclamantionController::class, 'editEx'])->name('reclamations.editEx');
    Route::get('reclamations/{reclamation}/edit-eva', [ReclamantionController::class, 'editEv'])->name('reclamations.editEv');
    Route::post('reclamations/store', [ReclamantionController::class, 'store'])->name('reclamations.store');
    Route::put('reclamations/{reclamantion}', [ReclamantionController::class, 'update'])->name('reclamations.update');
    Route::delete('reclamations/{reclamantion}', [ReclamantionController::class, 'destroy'])->name('reclamations.destroy');
     
    //Response
    Route::get('reclamations/{reclamation}/response', [ReclamationResponseController::class, 'create'])->name('reclamations.response.create');
    Route::post('reclamations/response', [ReclamationResponseController::class, 'store'])->name('reclamations.response.store');

    //by incription
    Route::get('cars_inscription/{inscription}/etudiants', [CarInscriptionController::class, 'addVersement'])->name('car_inscriptions.addVersement');
    Route::post('cars/inscription/{inscription}/etudiants', [CarInscriptionController::class, 'storeVersement'])->name('car_inscriptions.storeVersement');
    Route::delete('cars/inscription/{versement}', [CarInscriptionController::class, 'destroyVersement'])->name('car_inscriptions.destroyVersement');

    Route::get('cites/inscription/{inscription}/etudiants', [CiteInscriptionController::class, 'addVersement'])->name('citeInscriptions.addVersement');
    Route::post('cites/inscription/{inscription}/etudiants', [CiteInscriptionController::class, 'storeVersement'])->name('citeInscriptions.storeVersement');
    Route::delete('cites/inscription/{versement}', [CiteInscriptionController::class, 'destroyVersement'])->name('citeInscriptions.destroyVersement');


    Route::post('validate-account', [AuthController::class, 'activateAccount'])->name('validate-account');

    //

    Route::get('parent-dashboard', [MainController::class, 'parentDashboard'])->name('parent-dashboard');
    Route::get('parent-students', [MainController::class, 'parentEtudiants'])->name('parent-students');
    Route::get('parent-etudiant-show/{etudiant}', [MainController::class, 'parentEtudiant'])->name('parent-etudiant-show');
    Route::get('parent-etudiant-emploi/{etudiant}', [MainController::class, 'parentEtudiantEmploi'])->name('parent-etudiant-emploi');
    


    /**
     * LOGOUT
     */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

});

Route::get('t', function(){
    event(new \App\Events\SendMessage());
});


Route::fallback(function () {
    return view('components.errors.404');
});










