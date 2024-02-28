<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnneeScolaireRequest;
use App\Http\Requests\UpdateAnneeScolaireRequest;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Request;

class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anneeScolaires = AnneeScolaire::all();
        return view('components.pages.years.list', compact('anneeScolaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anneeScolaire = new AnneeScolaire();
        return view('components.pages.years.form', compact('anneeScolaire'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnneeScolaireRequest $request)
    {
        $request->validated();
        //verfier qu'il n'y a pas d'année scolaire en cours
        $anneeScolaire = AnneeScolaire::where('status', 'en cours')->first();
        if ($anneeScolaire &&  $request->status === 'en cours'){
            return redirect()->back()->withInput()->with('error', 'Il existe déjà une année scolaire en cours '. $anneeScolaire->annee_scolaire);
        }
        AnneeScolaire::create($request->all());
        return redirect()->route('years.index')->with('success', 'Année scolaire ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnneeScolaire $anneeScolaire)
    {
        return view('components.pages.years.show', compact('anneeScolaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnneeScolaire $anneeScolaire)
    {
        return view('components.pages.years.form', compact('anneeScolaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnneeScolaireRequest $request, AnneeScolaire $anneeScolaire)
    {
        $request->validated();
        //verfier qu'il n'y a pas d'année scolaire en cours
        $anneeScolair = AnneeScolaire::where('status', 'en cours')->first();
        if ($anneeScolair && $anneeScolaire->id !== $anneeScolair->id && $request->status === 'en cours'){
            return redirect()->back()->withInput()->with('error', 'Il existe déjà une année scolaire en cours '. $anneeScolaire->annee_scolaire);
        }
        $anneeScolaire->update($request->all());
        return redirect()->route('years.index')->with('success', 'Année scolaire modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeScolaire $anneeScolaire)
    {
        $anneeScolaire->delete();
        return redirect()->route('years.index')->with('success', 'Année scolaire supprimée avec succès');
    }


    /**
     * Change the status of the specified resource.
     */
    public function changeStatus(Request $request, AnneeScolaire $anneeScolaire)
    {
        $status = $request->status;
        if ($status === 'en cours'){
            $annee = AnneeScolaire::where('status', 'en cours')->first();
            if ($annee && $annee->id !== $anneeScolaire->id){
                return response()->json(['error' => 'Il existe déjà une année scolaire en cours, veuillez la désactiver avant de continuer'], 400);
            }

        }
        $anneeScolaire->status = $status;
        $anneeScolaire->save();
        return response()->json(['success' => 'Status de l\'année scolaire modifié avec succès'], 200);
    }
}
