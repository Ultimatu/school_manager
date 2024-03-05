<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\ClasseCours;
use App\Models\Evaluation;
use App\Models\Notes;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        if (auth()->user()->isProfesseur()) {
            $evaluations = auth()->user()->professeur->evalutations;
        } elseif (auth()->user()->isAdmin()) {
            $evaluations = Evaluation::all();
        }elseif (auth()->user()->isEtudiant()) {
            $evaluations = Evaluation::whereBelongsTo(auth()->user()->etudiant->classe->classeCours)->get();
        }
        return view('components.pages.evaluation.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->route('evaluations.index')->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action');
        }   
        $evaluation = new Evaluation();
        $classeCours = ClasseCours::where('professor_id', auth()->user()->professeur->id)->get();
        $evaluation->professeur_id = auth()->user()->professeur->id;
        return view('components.pages.evaluation.form', compact('evaluation', 'classeCours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $evaluation = Evaluation::create($request->all());
        return redirect()->route('evaluations.index')->with('success', 'Evaluation créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation): \Illuminate\Contracts\View\View
    {
        return view('components.pages.evaluation.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->route('evaluations.index')->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
        $classeCours = ClasseCours::where('professor_id', auth()->user()->professeur->id)->get();
        return view('components.pages.evaluation.form', compact('evaluation', 'classeCours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        $evaluation->update($request->validated());
        return redirect()->route('evaluations.index')->with('success', 'Evaluation modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation): \Illuminate\Http\RedirectResponse
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->route('evaluations.index')->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
        $evaluation->delete();
        return redirect()->route('evaluations.index')->with('success', 'Evaluation supprimée avec succès');
    }
}
