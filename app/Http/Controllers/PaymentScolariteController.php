<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentScolariteRequest;
use App\Http\Requests\UpdatePaymentScolariteRequest;
use App\Models\AnneeScolaire;
use App\Models\Etudiant;
use App\Models\PaymentScolarite;

class PaymentScolariteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = AnneeScolaire::where('status', 'en cours')->first();
        $scolarites = PaymentScolarite::where('annee_scolaire', $currentYear->annee_scolaire)->get();
        return view('components.pages.scolarite.list', compact('scolarites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $scolarite = new PaymentScolarite();
        $etudiants = Etudiant::all();
        return view('components.pages.scolarite.form', compact('scolarite', 'etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentScolariteRequest $request)
    {
        $request->validated();
        $scolarite = PaymentScolarite::create($request->all());
        return redirect()->route('scolarite.index')->with('success', 'Paiement ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentScolarite $paymentScolarite)
    {
        return view('components.pages.scolarite.show', compact('paymentScolarite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentScolarite $paymentScolarite)
    {
        return view('components.pages.scolarite.form', compact('paymentScolarite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentScolariteRequest $request, PaymentScolarite $paymentScolarite)
    {
        $request->validated();
        $paymentScolarite->update($request->all());
        return redirect()->route('scolarite.index')->with('success', 'Paiement modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentScolarite $paymentScolarite)
    {
        $paymentScolarite->delete();
        return redirect()->route('scolarite.index')->with('success', 'Paiement supprimé avec succès');
    }
}
