<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCiteInscriptionRequest;
use App\Http\Requests\UpdateCiteInscriptionRequest;
use App\Models\AnneeScolaire;
use App\Models\CiteInscription;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Request;

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
        return view('components.pages.citee.inscription.form', compact('citeInscription', 'etudiants'));

    }

    public function createBy(Etudiant $etudiant){
        $citeInscription = new CiteInscription();
        $citeInscription->etudiant_id = $etudiant->id;
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        return view('components.pages.citee.inscription.form', compact('citeInscription', 'etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCiteInscriptionRequest $request)
    {
        $request->validated();
        $citeInscription = CiteInscription::create($request->all());
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
        return view('components.pages.citee.inscription.form', compact('citeInscription', 'etudiants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCiteInscriptionRequest $request, CiteInscription $citeInscription)
    {
        $request->validated();
        $citeInscription->update($request->all());
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
        return view('components.pages.citee.inscriptions.form_add', compact('inscription'));
    }


    public function storeVersement(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:car_inscriptions,id',
            'versements' => 'required|numeric',
        ]);
        $versement = CiteInscription::find($request->id);

        //verifier si le montant total est atteint
        if ($this->isPaid($versement->versements, $versement->total_amount)) {
            return redirect()->route('citeInscriptions.index')->with('error', 'Le montant total est déjà atteint');
        }
        //ajouter le versement sur le versement existant en array
        $versement->versements = $versement->versements . ';' . $request->versements;

        if ($this->isPaid($versement->versements, $versement->total_amount)) {
            $versement->is_paid = true;
        }
        $versement->save();
        return redirect()->route('citeInscriptions.index')->with('success', 'Versement ajouté avec succès');
    }

    public function destroyVersement($inscription, $versement)
    {
        $inscription = CiteInscription::find($inscription);
        $versements = explode(';', $inscription->versements);
        //supprimer un versement
        unset($versements[$versement]);
        $inscription->versements = implode(';', $versements);
        $inscription->is_paid = $this->isPaid($inscription->versements, $inscription->total_amount);
        $inscription->save();
        return redirect()->route('citeInscriptions.index')->with('success', 'Versement supprimé avec succès');
    }



    private function getVersement($versements)
    {
        $versements = explode(';', $versements);
        $versements = array_map(function ($versement) {
            return floatval($versement);
        }, $versements);
        return array_sum($versements);
    }

    private function isPaid($versements, $total_amount)
    {
        $versements = $this->getVersement($versements);
        return $versements >= $total_amount;
    }
}
