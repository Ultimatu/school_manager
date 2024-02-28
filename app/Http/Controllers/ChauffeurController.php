<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChauffeurRequest;
use App\Http\Requests\UpdateChauffeurRequest;
use App\Models\Chauffeur;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chauffeurs = Chauffeur::all();
        return view('components.pages.chauffeurs.index', compact('chauffeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chauffeur = new Chauffeur();
        return view('components.pages.chauffeurs.form', compact('chauffeur'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChauffeurRequest $request)
    {
        $request->validated();
        $chauffeur = Chauffeur::create($request->all());
        return redirect()->route('chauffeurs.index')->with('success', 'Chauffeur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chauffeur $chauffeur)
    {
        return view('components.pages.chauffeurs.show', compact('chauffeur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chauffeur $chauffeur)
    {
        return view('components.pages.chauffeurs.form', compact('chauffeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChauffeurRequest $request, Chauffeur $chauffeur)
    {
        $request->validated();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('images/chauffeurs'), $name);
            $request->avatar = "images/chauffeurs/$name";
        }

        $chauffeur->update($request->all());
        return redirect()->route('chauffeurs.index')->with('success', 'Chauffeur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chauffeur $chauffeur)
    {
        if ($chauffeur->avatar) {
            unlink(public_path($chauffeur->avatar));
        }
        $chauffeur->delete();
        return redirect()->route('chauffeurs.index')->with('success', 'Chauffeur supprimé avec succès');
    }
}
