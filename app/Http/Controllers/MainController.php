<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\CarInscription;
use App\Models\CarInscriptionVersement;
use App\Models\CiteInscription;
use App\Models\Classe;
use App\Models\ClasseCours;
use App\Models\Cours;
use App\Models\DetailsPayement;
use App\Models\EmploiDuTemps;
use App\Models\Etudiant;
use App\Models\Examen;
use App\Models\Filiere;
use App\Models\Parents;
use App\Models\PaymentScolarite;
use App\Models\Professeur;
use App\Models\Salle;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard(){
        $filieres = Filiere::where('annee_scolaire', AnneeScolaire::valideYear())->get();
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::valideYear())->get();
        $classes = Classe::where('year', AnneeScolaire::valideYear())->get();
        $cours   = Cours::where('annee_scolaire', AnneeScolaire::valideYear())->get();
        $totalBudget_scolaire = PaymentScolarite::where('annee_scolaire', AnneeScolaire::valideYear())->sum('amount');
        $scolarite = DetailsPayement::where('date', 'like', '%'.date('Y').'%')->get(); 
        $totalBudget_scolaire_paid = $scolarite->sum('amount');
        $totalBudget_scolaire_unpaid = $totalBudget_scolaire - $totalBudget_scolaire_paid;
        $budgetTransport = CarInscription::where('annee_scolaire', AnneeScolaire::valideYear())->sum('total_amount');
        $transport = CarInscription::where('annee_scolaire', AnneeScolaire::valideYear())->get();
        $budgetTransport_paid = $transport->each->versements->sum('amount');
        $budgetTransport_unpaid = $budgetTransport - $budgetTransport_paid;
        $budgetCite = CiteInscription::where('annee_scolaire', AnneeScolaire::valideYear())->sum('total_amount');
        $cite = CiteInscription::where('annee_scolaire', AnneeScolaire::valideYear())->get();
        $budgetCite_paid = $cite->each->versements->sum('amount');
        $budgetCite_unpaid = $budgetCite - $budgetCite_paid;
        $totalBudget = $totalBudget_scolaire + $budgetTransport + $budgetCite;
        if(auth()->user()->isEtudiant()){
            $etudiant = auth()->user()->etudiant;
            $totalScolarite = 0;
            $totalScolaritePaid = 0;
            $car = false;
            $cite = false;
            $totalCar = 0;
            $totalCite = 0;
            $totalCarPaid = 0;
            $totalCitePaid = 0;
            foreach ($etudiants as $etudiant){
                $totalScolarite += $etudiant->scolarite->amount;
                foreach($etudiant->versements() as $verst)
                    $totalScolaritePaid +=$verst->amount;
                if ($etudiant->car){
                    $car = true;
                    $totalCar += $etudiant->car->total_amount;
                    foreach($etudiant->car->versements as $v){
                        $totalCarPaid += $v->versement;
                    }
                }
                if ($etudiant->cite){
                    $cite = true;
                    $totalCite += $etudiant->cite->total_amount;
                    foreach($etudiant->cite->versements as $v){
                        $totalCitePaid += $v->versement;
                    }
                }
            }
            $totalScolariteUnpaid = $totalScolarite - $totalScolaritePaid;
            return view('components.apps.dashboard', compact('etudiants', 'totalScolarite', 'totalScolaritePaid', 'totalScolariteUnpaid', 'car', 'cite', 'totalCarPaid', 'totalCitePaid', 'totalCar', 'totalCite'));
        }
        if (auth()->user()->isParent()){
            return to_route('parent-dashboard');
        }
        if (auth()->user()->isProfesseur()){
            $professeur = auth()->user()->professeur;
            $cours = auth()->user()->professeur->courses;
            $nbrCours = $cours->count();
            $coursTermines = $cours->where('is_done', 1)->count();
            $classeDistinct = $cours->pluck('classe_id')->unique();
            return view('components.apps.dashboard', compact('cours', 'nbrCours', 'coursTermines', 'classeDistinct'));
        }
        return view('components.apps.dashboard', compact('filieres', 'etudiants', 'classes', 'cours', 'totalBudget_scolaire', 'totalBudget_scolaire_paid', 'totalBudget_scolaire_unpaid', 'budgetTransport', 'budgetTransport_paid', 'budgetTransport_unpaid', 'budgetCite', 'budgetCite_paid', 'budgetCite_unpaid', 'totalBudget'));
    }


    public function profile(){
        return view('components.pages.profile.index');
    }


    public function switchYear(AnneeScolaire $anneeScolaire){
        $anneeScolaire->status = 'en cours';
        AnneeScolaire::where('status', 'en cours')->where('id', '!=', $anneeScolaire->id)->update(['status' => 'terminé']);
        $anneeScolaire->save();
        return redirect()->route('dashboard');
    }


    /* =================
     * PARENT FUNCTIONS
     */

    public function parentDashboard(){
        $etudiants = Parents::where('user_id', auth()->user()->id)->first()->etudiants;
        $totalScolarite = 0;
        $totalScolaritePaid = 0;
        $car = false;
        $cite = false;
        $totalCar = 0;
        $totalCite = 0;
        $totalCarPaid = 0;
        $totalCitePaid = 0;
        foreach ($etudiants as $etudiant){
            $totalScolarite += $etudiant->etudiant->scolarite->amount;
            foreach($etudiant->etudiant->versements() as $verst)
                $totalScolaritePaid +=$verst->amount;
            if ($etudiant->etudiant->car){
                $car = true;
                $totalCar += $etudiant->etudiant->car->total_amount;
                foreach($etudiant->etudiant->car->versements as $v){
                    $totalCarPaid += $v->versement;
                }
            }
            if ($etudiant->etudiant->cite){
                $cite = true;
                $totalCite += $etudiant->etudiant->cite->total_amount;
                foreach($etudiant->etudiant->cite->versements as $v){
                    $totalCitePaid += $v->versement;
                }
            }
        }
        $totalScolariteUnpaid = $totalScolarite - $totalScolaritePaid;
        return view('parents.index', compact('etudiants', 'totalScolarite', 'totalScolaritePaid', 'totalScolariteUnpaid', 'car', 'cite', 'totalCarPaid', 'totalCitePaid', 'totalCar', 'totalCite'));
    }


    public function parentProfile(){
        return view('parents.profile');
    }

    public function parentEtudiants(){
        return view('parents.etudiant');
    }

    public function parentEtudiant(Etudiant $etudiant){
        $professeurs = Classe::where('id', $etudiant->classe_id)->first()->professeurs();
        return view('parents.show-etudiant', compact('etudiant', 'professeurs'));
    }

    public function parentEtudiantEmploi(Etudiant $etudiant){
        $classe = $etudiant->classe;
        $emplois = EmploiDuTemps::where('classe_id', $classe->id)->get();
        $classeCours = ClasseCours::where('classe_id', $classe->id)->where('is_available', 1)->get();
        $professeurs = Professeur::where('is_available', 1)->get();
        $salles = Salle::where('is_available', 1)->get();
        $examens = Examen::where('classe_id', $classe->id)->get();
        return view('parents.emploi', compact('etudiant', 'emplois', 'classe', 'classeCours', 'professeurs', 'salles', 'examens'));
    }
}
