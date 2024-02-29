<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrajetRequest;
use App\Http\Requests\UpdateTrajetRequest;
use App\Models\AnneeScolaire;
use App\Models\Trajet;

class TrajetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trajets = Trajet::all();
        return view('components.pages.trajets.index', compact('trajets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trajet = new Trajet();
        return view('components.pages.trajets.form', compact('trajet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrajetRequest $request)
    {

        $request->validated();
        //transormer requette waypoints en json
        $trajet = Trajet::create($request->all());
        return redirect()->route('trajets.index')->with('success', 'Trajet ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trajet $trajet)
    {
        return view('components.pages.trajets.show', compact('trajet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trajet $trajet)
    {
        return view('components.pages.trajets.form', compact('trajet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrajetRequest $request, Trajet $trajet)
    {
        $request->validated();
        $trajet->update($request->all());
        return redirect()->route('trajets.index')->with('success', 'Trajet modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trajet $trajet)
    {
        $trajet->delete();
        return redirect()->route('trajets.index')->with('success', 'Trajet supprimé avec succès');
    }
}
