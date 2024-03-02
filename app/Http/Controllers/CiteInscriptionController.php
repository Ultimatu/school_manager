<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCiteInscriptionRequest;
use App\Http\Requests\UpdateCiteInscriptionRequest;
use App\Models\AnneeScolaire;
use App\Models\Chambre;
use App\Models\CiteInscription;
use App\Models\CiteInscriptionVersement;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class CiteInscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citeInscriptions = CiteInscription::all();
        return view('components.pages.citee.inscription.index', compact('citeInscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $citeInscription = new CiteInscription();
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        $chambres = Chambre::disponible();
        if ($chambres->count() === 0 && Chambre::count() > 0){
            return redirect()->back()->with('warning', 'Alerte!!!, Toutes les chambres enregistrées sont occupées à capacité maximale');
        }
        elseif ($chambres->count() === 0 && Chambre::count() === 0){
            return redirect()->back()->with('warning', 'Alerte!!!, Il n\' y a pas de chambres disponible');
        }
        return view('components.pages.citee.inscription.form', compact('citeInscription', 'etudiants', 'chambres'));
    }

    public function createBy(Etudiant $etudiant){
        $citeInscription = new CiteInscription();
        $citeInscription->etudiant_id = $etudiant->id;
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        $chambres = Chambre::disponible();
        if ($chambres->count() === 0){
            return redirect()->back()->with('warning', 'Alerte!!!, Toutes les chambres enregistrées sont occupées à capacité maximale');
        }
        return view('components.pages.citee.inscription.form', compact('citeInscription', 'etudiants', 'chambres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCiteInscriptionRequest $request)
    {
        $request->validated();
        //verifier si l'espace de la chambre est disponible
        $chambre = Chambre::find($request->chambre_id);
        if ($chambre->is_occupied || $chambre->capacity <= $chambre->occupants()->count()) {
            return redirect()->route('citeInscriptions.index')->with('error', 'La chambre est déjà occupée')->withInput();
        }
        $citeInscription = CiteInscription::create($request->all());
        //mettre à jour le statut de la chambre
        if ($chambre->occupants()->count() >= $chambre->capacity) {
            $chambre->is_occupied = true;
            $chambre->save();
        }
        $versement = CiteInscriptionVersement::create([
            'car_inscription_id' => $citeInscription->id,
            'versement' => $request->versements,
            'date_versement' => now()
        ]);

        return redirect()->route('citeInscriptions.index')->with('success', 'Inscription ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(CiteInscription $citeInscription)
    {
        return view('components.pages.citee.inscription.show', compact('citeInscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CiteInscription $citeInscription)
    {
        $chambres = Chambre::disponible();
        return view('components.pages.citee.inscription.form', compact('citeInscription', 'etudiants', 'chambres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCiteInscriptionRequest $request, CiteInscription $citeInscription)
    {
        $request->validated();
        //verifier si l'espace de la chambre est disponible
        $chambre = Chambre::find($request->chambre_id);
        if ($chambre->is_occupied || $chambre->capacity <= $chambre->occupants()->count()) {
            return redirect()->route('citeInscriptions.index')->with('error', 'La chambre est déjà occupée')->withInput();
        }
        $citeInscription->update($request->all());
        //mettre à jour le statut de la chambre
        if ($chambre->occupants()->count() >= $chambre->capacity) {
            $chambre->is_occupied = true;
            $chambre->save();
        }
        $versement = CiteInscriptionVersement::where('cite_inscription_id', $citeInscription->id)->first();
        $versement->update([
            'versement' => $request->versements,
            'date_versement' => now()
        ]);
        return redirect()->route('citeInscriptions.index')->with('success', 'Inscription modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CiteInscription $citeInscription)
    {
        $citeInscription->delete();
        return redirect()->route('citeInscriptions.index')->with('success', 'Inscription supprimée avec succès');
    }

    public function addVersement(CiteInscription $inscription)
    {
        //verifiy is user is_paid
        $versements = $this->getVersement($inscription->versements);
        if ($inscription->is_paid){
            return redirect()->back()->with('warning', 'Cet étudiant a déjà soldé pour le car');
        }elseif($this->isPaid($versements, $inscription->total_amount)){
            $inscription->is_paid = true;
            $inscription->save();
            return redirect()->back()->with('warning', 'Cet étudiant a déjà soldé pour le car');
        }

        return view('components.pages.cars.inscriptions.form_add', compact('inscription', 'versements'));
    }


    public function storeVersement(Request $request, CiteInscription $inscription)
    {
        $request->validate([
            'versement' => 'required|numeric',
            'date_versement' => 'required|date'
        ]);
        if ($inscription->is_paid){
            return redirect()->back()->with('warning', 'Cet étudiant a déjà soldé pour la cité');
        }
        $versements = $this->getVersement($inscription->versements);
        //verifier si le montant total est atteint
        if ($this->isPaid($versements, $inscription->total_amount)) {
            $inscription->is_paid = true;
            $inscription->save();
            return redirect()->route('car_inscriptions.index')->with('warning', 'Le montant total est déjà atteint');
        }
        CiteInscriptionVersement::create([
            'car_inscription_id' => $inscription->id,
            'versement' => $request->versement,
            'date_versement' => $request->date_versement
        ]);
       $versements = $this->getVersement($inscription->versements);
        
        if ($this->isPaid($versements, $inscription->total_amount)) {
            $inscription->is_paid = true;
        }
        $inscription->versements = $versements;
        return redirect()->route('car_inscriptions.index')->with('success', 'Versement ajouté avec succès');
    }

    public function destroyVersement(CiteInscriptionVersement $versement)
    {
        $inscription = CiteInscription::find($versement->cite_inscription_id);
        $versement->delete();
        $versements = $this->getVersement($inscription->versements);
        if ($this->isPaid($versements, $inscription->total_amount)) {
            $inscription->is_paid = true;
        }
        $inscription->save();
        return redirect()->route('citeInscriptions.index')->with('success', 'Versement supprimé avec succès');

    }

    private function getVersement($versements)
    {
        return $versements->sum('versement');
    }   
   
    private function isPaid($versements, $total_amount)
    {
        return $versements >= $total_amount;
    }


    
}
