<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use App\Models\EmploiDuTemps;
use App\Models\Evenement;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Evenement::all();
        return view('components.pages.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event = new Evenement();
        return view('components.pages.events.form', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvenementRequest $request)
    {
        $request->validated();
        //verifier s'il n'y a pas de conflit d'evenement
        $evenement = Evenement::where('date_heure_debut', '<', $request->date_time_fin)
            ->where('date_time_fin', '>', $request->date_heure_debut)
            ->get();
        if ($evenement->count() > 0 && $request->expectsJson()){
            return response()->json(['message' => 'Il y a déjà un événement à cette date']);
        }
        else if ($evenement->count() > 0){
            return back()->with('error', 'Il y a déjà un événement à cette date')->withInput();
        }
        //verifier si c'est dans une salle et si la salle est disponible
        if ($request->salle_id){
            $evenement = EmploiDuTemps::where('salle_id', $request->salle_id)
                ->where('start_date_time', '<', $request->end_date_time)
                ->where('end_date_time', '>', $request->start_date_time)
                ->get();
            if ($evenement->count() > 0 && $request->expectsJson()){
                return response()->json(['error' => 'La salle est déjà occupée', 'evenement' => $evenement]);
            }
            else if ($evenement->count() > 0){
                return back()->with('error', 'La salle est déjà occupée')->withInput();
            }
        }

        $evenement = Evenement::create($request->all());
        if ($request->expectsJson()){
            return response()->json(['message' => 'Evenement créé avec succès']);
        }
        return back()->with('success', 'Evenement créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        return view('components.pages.events.show', compact('evenement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement)
    {
        $event = $evenement;
        return view('components.pages.events.form', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvenementRequest $request, Evenement $evenement)
    {
        $request->validated();
        $evenement->update($request->all());
        if ($request->expectsJson()){
            return response()->json(['message' => 'Evenement modifié avec succès']);
        }
        return back()->with('success', 'Evenement modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        if (request()->expectsJson()){
            return response()->json(['message' => 'Evenement supprimé avec succès']);
        }
        return back()->with('success', 'Evenement supprimé avec succès');
    }
}
