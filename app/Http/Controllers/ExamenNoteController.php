<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamenNoteRequest;
use App\Http\Requests\UpdateExamenNoteRequest;
use App\Models\AnneeScolaire;
use App\Models\Examen;
use App\Models\ExamenNote;

class ExamenNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examenNotes = ExamenNote::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        return view('components.pages.examens.notes.index', compact('examenNotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Examen $examen)
    {
        $examenNote = new ExamenNote();
        $examenNote->examen_id = $examen->id;
        $examenNote->annee_scolaire = $examen->annee_scolaire;

        return view('components.pages.examens.notes.form', compact('examenNote', 'examen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamenNoteRequest $request)
    {
        $validatedData = $request->validated();
        ExamenNote::create($validatedData);
        return redirect()->route('examens.show', $validatedData['examen_id'])->with('success', 'Note ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamenNote $examenNote)
    {
        return view('components.pages.examens.notes.show', compact('examenNote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamenNote $examenNote)
    {
        return view('components.pages.examens.notes.form', compact('examenNote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamenNoteRequest $request, ExamenNote $examenNote)
    {
        $validatedData = $request->validated();
        $examenNote->update($validatedData);
        return redirect()->route('examens.show', $examenNote->examen_id)->with('success', 'Note modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamenNote $examenNote)
    {
        $examenNote->delete();
        return redirect()->route('examens.show', $examenNote->examen_id)->with('success', 'Note supprimée avec succès');
    }
}
