<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChambreRequest;
use App\Http\Requests\UpdateChambreRequest;
use App\Models\Chambre;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chambres = Chambre::all();
        return view('components.pages.chambres.index', compact('chambres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chambre = new Chambre();
        return view('components.pages.chambres.form', compact('chambre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChambreRequest $request)
    {
        $request->validated();
        $chambre = Chambre::create($request->all());
        return redirect()->route('chambres.index')->with('success', 'Chambre ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chambre $chambre)
    {
        return view('components.pages.chambres.show', compact('chambre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chambre $chambre)
    {
        return view('components.pages.chambres.form', compact('chambre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChambreRequest $request, Chambre $chambre)
    {
        $request->validated();
        $chambre->update($request->all());
        return redirect()->route('chambres.index')->with('success', 'Chambre modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chambre $chambre)
    {
        $chambre->delete();
        return redirect()->route('chambres.index')->with('success', 'Chambre supprimée avec succès');
    }
}
