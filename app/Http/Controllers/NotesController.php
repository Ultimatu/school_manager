<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
use App\Models\AnneeScolaire;
use App\Models\ClasseCours;
use App\Models\Etudiant;
use App\Models\Notes;
use App\Models\Professeur;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Notes::currentYear();
        $professeur = Professeur::where('user_id', Auth::user()->id)->first();
        return view('components.pages.notes.list', compact('notes', 'professeur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ClasseCours $classeCours)
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $notes = new Notes();
        $notes->classe_cours_id = $classeCours->id;
        $professeur = Professeur::where('user_id', Auth::user()->id)->first();
        $notes->professeur_id = $professeur->id;
        $etudiants = Etudiant::where('classe_id', $classeCours->classe_id)->get();
        return view('components.pages.notes.form', compact('notes', 'etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotesRequest $request)
    {
        $request->validated();
        $note = Notes::create($request->all());
        return redirect()->route('notes.index')->with('success', 'Note ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        return view('componenets.pages.notes.show', compact('notes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $etudiants = Etudiant::where('classe_id', $notes->classeCours->classe_id)->get();
        return view('components.pages.notes.form', compact('notes', 'etudiants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotesRequest $request, Notes $notes)
    {
        $request->validated();
        $notes->update($request->all());
        return redirect()->route('notes.index')->with('success', 'Note modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $notes)
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }

        $notes->delete();
        return redirect()->route('notes.index')->with('success', 'Note supprimée avec succès');
    }
}
