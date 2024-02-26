<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmploiDuTempsRequest;
use App\Http\Requests\UpdateEmploiDuTempsRequest;
use App\Models\EmploiDuTemps;

class EmploiDuTempsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emploiDuTemps = EmploiDuTemps::all();
        if (auth()->user()->isEtudiant()){
            $emploiDuTemps = EmploiDuTemps::where('classe_id', auth()->user()->etudiant->classe_id)->get();

        }
        if (auth()->user()->isProfesseur()){
            $emploiDuTemps = EmploiDuTemps::where('professeur_id', auth()->user()->professeur->id)->get();
        }
        return view('components.pages.emplois.list', compact('emploiDuTemps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emploiDuTemps = new EmploiDuTemps();
        return view('components.pages.emplois.form', compact('emploiDuTemps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmploiDuTempsRequest $request)
    {
        $validatedData = $request->validated();
        //verifier si la salle est disponible
        $emploiDuTemps = EmploiDuTemps::where('salle_id', $validatedData['salle_id'])
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return redirect()->back()->with('error', 'La salle est déjà occupée');
        }

        //verifier si le professeur est disponible
        $emploiDuTemps = EmploiDuTemps::where('professeur_id', $request->professeur_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return redirect()->back()->with('error', 'Le professeur est déjà occupé');
        }

        //verifier si la classe est disponible
        $emploiDuTemps = EmploiDuTemps::where('classe_id', $request->classe_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return redirect()->back()->with('error', 'La classe est déjà occupée');
        }

        EmploiDuTemps::create($request->all());
        return redirect()->route('emploiDuTemps.index')->with('success', 'Nouveau emploi du temps ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploiDuTemps $emploiDuTemps)
    {
        return view('components.pages.emplois.show', compact('emploiDuTemps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmploiDuTemps $emploiDuTemps)
    {
        return view('components.pages.emplois.form', compact('emploiDuTemps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmploiDuTempsRequest $request, EmploiDuTemps $emploiDuTemps)
    {
        $request->validated();

        //verifier si la salle est disponible
        $emploiDuTemps = EmploiDuTemps::where('salle_id', $request->salle_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return redirect()->back()->with('error', 'La salle est déjà occupée');
        }

        //verifier si le professeur est disponible
        $emploiDuTemps = EmploiDuTemps::where('professeur_id', $request->professeur_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return redirect()->back()->with('error', 'Le professeur est déjà occupé');
        }

        //verifier si la classe est disponible
        $emploiDuTemps = EmploiDuTemps::where('classe_id', $request->classe_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return redirect()->back()->with('error', 'La classe est déjà occupée');
        }
        $emploiDuTemps->update($request->all());
        return redirect()->route('emploiDuTemps.index')->with('success', 'Emploi du temps modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploiDuTemps $emploiDuTemps)
    {
        $emploiDuTemps->delete();
        return redirect()->route('emploiDuTemps.index')->with('success', 'Emploi du temps supprimé avec succès');
    }
}
