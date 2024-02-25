<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\StoreEmploiDuTempsRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Classe;
use App\Models\ClasseCours;
use App\Models\EmploiDuTemps;
use App\Models\Filiere;
use App\Models\Professeur;
use App\Models\Salle;

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
        return view('components.pages.classe.form', compact('classe', 'filieres'));
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
        $filieres = Filiere::where('status', 1)->get();
        return view('components.pages.classe.form', compact('classe', 'filieres'));
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
     * Change the status of the specified resource in storage.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus($id)
    {
        $classe = Classe::find($id);
        $classe->status = !$classe->status;
        $classe->save();
        return response()->json(['success' => 'Status changé avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('classe.index')->with('success', 'Classe supprimée avec succès');
    }

    //*================================================================================================
     //* EMPLOI DU TEMPS


    public function emploie(Classe $classe)
     {
        $emplois = EmploiDuTemps::where('classe_id', $classe->id)->get();
        $classeCours = ClasseCours::where('classe_id', $classe->id)->where('is_available', 1)->get();
        $professeurs = Professeur::where('is_available', 1)->get();
        $salles = Salle::where('is_available', 1)->get();
        return view('components.pages.classe.emploi.index', compact('emplois', 'classe', 'classeCours', 'professeurs', 'salles'));
    }

    public function getAll($id){

        $emplois = EmploiDuTemps::where('classe_id', $id)->get();
        return response()->json($emplois);
    }


    /**
     * Store a newly created resource in storage.
     * @param StoreEmploiDuTempsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeEmploi(StoreEmploiDuTempsRequest $request){
        $request->validated();
        //verifier si la salle est disponible
        $emploiDuTemps = EmploiDuTemps::where('salle_id', $request->salle_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return response()->json(['error' => 'La salle est déjà occupée']);
        }

        //verifier si le professeur est disponible
        $emploiDuTemps = EmploiDuTemps::where('professeur_id', $request->professeur_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return response()->json(['error' => 'Le professeur est déjà occupé']);
        }

        //verifier si la classe est disponible
        $emploiDuTemps = EmploiDuTemps::where('classe_id', $request->classe_id)
            ->where('day', $request->day)
            ->where('start_date_time', '<', $request->end_date_time)
            ->where('end_date_time', '>', $request->start_date_time)
            ->get();
        if ($emploiDuTemps->count() > 0){
            return  response()->json(['error' => 'La classe est déjà occupée']);
        }

        EmploiDuTemps::create($request->all());
        $emplois = EmploiDuTemps::where('classe_id', $request->classe_id)->get();
        return response()->json(['success' => 'Emploi du temps ajouté avec succès', 'emplois' => $emplois]);
    }


    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyEmploi($id)
    {
        $emploi = EmploiDuTemps::find($id);
        $classe_id = $emploi->classe_id;
        $emploi->delete();
        $emplois = EmploiDuTemps::where('classe_id', $classe_id)->get();
        return response()->json(['success' => 'Emploi du temps supprimé avec succès', 'emplois' => $emplois]);
    }

}
