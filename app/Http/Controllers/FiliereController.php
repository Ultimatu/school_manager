<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFiliereRequest;
use App\Http\Requests\UpdateFiliereRequest;
use App\Models\AnneeScolaire;
use App\Models\Filiere;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        return view('components.pages.filiere.list', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filiere = new Filiere();
        return view('components.pages.filiere.form', compact('filiere'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFiliereRequest $request)
    {
        $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/filieres'), $imageName);
            $request->image = $imageName;

        }
        Filiere::create($request->all());
        return redirect()->route('filiere.index')->with('success', 'Nouvelle filière ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        return view('components.pages.filiere.show', compact('filiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        return view('components.pages.filiere.form', compact('filiere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFiliereRequest $request, Filiere $filiere)
    {
        $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/filieres'), $imageName);
            $request->image = $imageName;

        }
        $filiere->update($request->all());
        return redirect()->route('filiere.index')->with('success', 'Filière modifiée avec succès');
    }

    /**
     * Change the status of the specified resource in storage.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus($id): \Illuminate\Http\JsonResponse
    {
        $filiere = Filiere::find($id);
        $filiere->status = !$filiere->status;
        $filiere->save();
        return response()->json(['success' => 'Status changé avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        return redirect()->route('filiere.index')->with('success', 'Filière supprimée avec succès');
    }
}
