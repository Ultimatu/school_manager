<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Classe;
use App\Models\Filiere;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::all();
        return view('components.pages.classe.list', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classe = new Classe();
        $filieres = Filiere::where('status', 1)->get();
        return view('components.pages.classe.form', compact('classe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        $request->validated();
        Classe::create($request->all());
        return redirect()->route('classe.index')->with('success', 'Nouvele classe ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        return view('components.pages.classe.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        return view('components.pages.classe.form', compact('classe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        $request->validated();
        $classe->update($request->all());
        return redirect()->route('classe.index')->with('success', 'Classe modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('classe.index')->with('success', 'Classe supprimée avec succès');
    }
}
