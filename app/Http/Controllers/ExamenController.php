<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamenRequest;
use App\Http\Requests\UpdateExamenRequest;
use App\Models\ClasseCours;
use App\Models\EmploiDuTemps;
use App\Models\Examen;
use App\Models\Salle;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examens = Examen::all();
        if (request()->expectsJson()) {
            return response()->json(['data' => $examens], 200);
        }
        return view('components.pages.examens.index', compact('examens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $examen = new Examen();
        $classeCours = ClasseCours::where('is_available', 1)->get();
        $salles = Salle::where('is_available', 1)->get();
        return view('components.pages.examens.form', compact('examen', 'classeCours', 'salles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamenRequest $request)
    {
        $validatedData = $request->validated();

        if ($this->isSalleOccupied($validatedData)) {
            return $this->handleOccupiedSalle($request);
        }

        if ($this->isCoursOccupied($validatedData)) {
            return $this->handleOccupiedCours($request);
        }

        if ($this->isClasseOccupied($validatedData)) {
            return $this->handleOccupiedClasse($request);
        }

        if ($this->isEmploiDuTempsOccupied($validatedData)) {
            return $this->handleOccupiedEmploiDuTemps($request);
        }

        Examen::create($validatedData);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Examen ajouté avec succès'], 200);
        }

        return redirect()->route('examens.index')->with('success', 'Examen ajouté avec succès');


    }

    /**
     * Display the specified resource.
     */
    public function show(Examen $examen)
    {
        return view('components.pages.examens.show', compact('examen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Examen $examen)
    {
        $classeCours = ClasseCours::where('is_available', 1)->get();
        $salles = Salle::where('is_available', 1)->get();
        return view('components.pages.examens.form', compact('examen', 'classeCours', 'salles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamenRequest $request, Examen $examen)
    {
        $request->validated();
        //insertion
        $examen->update($request->all());
        //redirection
        return redirect()->route('examens.index')->with('success', 'Examen modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Examen $examen)
    {
        $examen->delete();
        if (request()->expectsJson()) {
            return response()->json(['success' => 'Examen supprimé avec succès'], 200);
        }
        return redirect()->route('examens.index')->with('success', 'Examen supprimé avec succès');
    }

    /**
     * Get all the examens for a classe.
     */
    public function getAll($id){
        $examens = Examen::where('classe_id', $id)->get();
        $examens->load('classeCours', 'salle', 'classe', 'classeCours.cours');
        return response()->json(['data' => $examens], 200);
    }


    //*================================================================================================
    //* PRIVATE FUNCTIONS


    /**
     * Check if the salle is occupied.
     * @param  array<string, mixed>  $validatedData
     * @return bool
     */
    private function isSalleOccupied($validatedData)
    {
        return Examen::where('salle_id', $validatedData['salle_id'])
            ->where('day', $validatedData['day'])
            ->where('start_date_time', '<', $validatedData['start_date_time'])
            ->where('end_date_time', '>', $validatedData['start_date_time'])
            ->orWhere('start_date_time', '<', $validatedData['end_date_time'])
            ->where('end_date_time', '>', $validatedData['end_date_time'])
            ->exists();
    }


    /**
     * Check if the cours is occupied.
     * @param  array<string, mixed>  $validatedData
     * @return bool
     */
    private function isCoursOccupied($validatedData)
    {
        return Examen::where('classe_cours_id', $validatedData['classe_cours_id'])
            ->where('day', $validatedData['day'])
            ->where('start_date_time', '<', $validatedData['start_date_time'])
            ->where('end_date_time', '>', $validatedData['start_date_time'])
            ->orWhere('start_date_time', '<', $validatedData['end_date_time'])
            ->where('end_date_time', '>', $validatedData['end_date_time'])
            ->exists();
    }

    /**
     * Check if the classe is occupied.
     * @param  array<string, mixed>  $validatedData
     * @return bool
     */
    private function isClasseOccupied($validatedData)
    {
        return Examen::where('classe_id', $validatedData['classe_id'])
            ->where('day', $validatedData['day'])
            ->where('start_date_time', '<', $validatedData['start_date_time'])
            ->where('end_date_time', '>', $validatedData['start_date_time'])
            ->orWhere('start_date_time', '<', $validatedData['end_date_time'])
            ->where('end_date_time', '>', $validatedData['end_date_time'])
            ->exists();
    }

    /**
     * Check if the emploi du temps is occupied.
     * @param  array<string, mixed>  $validatedData
     * @return bool
     */
    private function isEmploiDuTempsOccupied($validatedData)
    {
        return EmploiDuTemps::where('salle_id', $validatedData['salle_id'])
            ->where('day', $validatedData['day'])
            ->where('start_date_time', '<', $validatedData['end_date_time'])
            ->where('end_date_time', '>', $validatedData['start_date_time'])
            ->exists();
    }

    /**
     * Handle the occupied salle.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function handleOccupiedSalle($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'La salle est déjà occupée'], 422);
        }

        return redirect()->back()->with('error', 'La salle est déjà occupée')->withInput();
    }

    /**
     * Handle the occupied cours.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function handleOccupiedCours($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'il y a déjà un examen pour ce cours'], 422);
        }

        return redirect()->back()->with('error', 'Le cours est déjà occupé')->withInput();
    }

    /**
     * Handle the occupied classe.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function handleOccupiedClasse($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'La classe est déjà occupée'], 422);
        }

        return redirect()->back()->with('error', 'La classe est déjà occupée')->withInput();
    }

    /**
     * Handle the occupied emploi du temps.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function handleOccupiedEmploiDuTemps($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'La salle est déjà occupée'], 422);
        }

        return redirect()->back()->with('error', 'La salle est déjà occupée')->withInput();
    }


    //*================================================================================================
}
