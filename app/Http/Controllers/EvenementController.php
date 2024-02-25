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
        //
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
        if ($evenement->count() > 0){
            return response()->json(['message' => 'Il y a déjà un événement à cette date']);
        }
        //verifier si c'est dans une salle et si la salle est disponible
        if ($request->salle_id){
            $evenement = EmploiDuTemps::where('salle_id', $request->salle_id)
                ->where('start_date_time', '<', $request->end_date_time)
                ->where('end_date_time', '>', $request->start_date_time)
                ->get();
            if ($evenement->count() > 0){
                return response()->json(['error' => 'La salle est déjà occupée', 'evenement' => $evenement]);
            }
        }

        $evenement = new Evenement();
        $evenement->titre = $request->titre;
        $evenement->description = $request->description;
        $evenement->type = $request->type;
        $evenement->classes_ids = $request->classes_ids;
        $evenement->date_heure_debut = $request->date_heure_debut;
        $evenement->date_time_fin = $request->date_time_fin;
        $evenement->send_to_all = $request->send_to_all;
        $evenement->salle_id = $request->salle_id;
        $evenement->only_for_admins = $request->only_for_admins;
        $evenement->only_for_profs = $request->only_for_profs;
        $evenement->save();
        return response()->json(['message' => 'Evenement créé avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvenementRequest $request, Evenement $evenement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return response()->json(['message' => 'Evenement supprimé avec succès']);
    }
}
