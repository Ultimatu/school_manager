<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\CarInscription;
use App\Models\CarInscriptionVersement;
use App\Models\CiteInscription;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\DetailsPayement;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\PaymentScolarite;
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
        return view('parents.index');
    }


    public function parentProfile(){
        return view('parents.profile');
    }

    public function parentEtudiants(){
        return view('parents.etudiant');
    }
}
