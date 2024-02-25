<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalleRequest;
use App\Http\Requests\UpdateSalleRequest;
use App\Models\Salle;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salles = Salle::all();
        return view('components.pages.salles.list', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salle = new Salle();
        return view('components.pages.salles.form', compact('salle'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalleRequest $request)
    {
        $request->validated();
        Salle::create($request->all());
        return redirect()->route('salle.index')->with('success', 'Nouvelle salle ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle)
    {
        return view('components.pages.salles.show', compact('salle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle)
    {
        return view('components.pages.salles.form', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalleRequest $request, Salle $salle)
    {
        $request->validated();
        $salle->update($request->all());
        return redirect()->route('salle.index')->with('success', 'Salle modifiée avec succès');
    }

    /**
     * Change the status of the specified resource in storage.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus($id){
        $cours = Salle::find($id);
        $cours->is_available = !$cours->is_available;
        $cours->save();
        return response()->json(['message'=>'salle status changed successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();
        return redirect()->route('salle.index')->with('success', 'Salle supprimée avec succès');
    }
}
