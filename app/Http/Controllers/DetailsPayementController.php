<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetailsPayementRequest;
use App\Http\Requests\UpdateDetailsPayementRequest;
use App\Models\AnneeScolaire;
use App\Models\DetailsPayement;
use App\Models\PaymentScolarite;

class DetailsPayementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //les versements où l'année scolaire est en cours
        $currentYear = AnneeScolaire::where('status', 'en cours')->first();
        $versements = DetailsPayement::whereHas('paymentScolarite', function ($query){
            $query->where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire);
        })->get();
        return view('components.pages.versements.list', compact('versements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $scolarites = PaymentScolarite::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->where('is_paid', 0)->get();
        $versement = new DetailsPayement();
        return view('components.pages.versements.form', compact('versement', 'scolarites'));
    }

    public function createByEtudiant(PaymentScolarite $paymentScolarite)
    {
        $versement = new DetailsPayement();
        $scolarite = $paymentScolarite;
        return view('components.pages.versements.form_by', compact('versement', 'scolarite'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDetailsPayementRequest $request)
    {
        $request->validated();
        $versement = DetailsPayement::create($request->all());
        return redirect()->route('versement.index')->with('success', 'Versement ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailsPayement $detailsPayement)
    {
        return view('components.pages.versements.show', compact('detailsPayement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailsPayement $detailsPayement)
    {
        $scolarites = PaymentScolarite::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->where('is_paid', 0)->get();
        $versement = $detailsPayement;
        return view('components.pages.versements.form', compact('versement', 'scolarites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailsPayementRequest $request, DetailsPayement $detailsPayement)
    {
        $request->validated();
        $detailsPayement->update($request->all());
        return redirect()->route('versement.index')->with('success', 'Versement modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailsPayement $detailsPayement)
    {
        //verifier si le parent a pour statut is_paid = 1
        if($detailsPayement->paymentScolarite->is_paid === 1){
           //changer le statut de is_paid à 0
            $detailsPayement->paymentScolarite->update(['is_paid' => 0]);
        }
        $detailsPayement->delete();
        return redirect()->route('versement.index')->with('success', 'Versement supprimé avec succès');
    }
}
