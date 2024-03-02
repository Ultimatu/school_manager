<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseCoursRequest;
use App\Http\Requests\UpdateClasseCoursRequest;
use App\Models\Classe;
use App\Models\ClasseCours;
use App\Models\Cours;
use App\Models\Professeur;

class ClasseCoursController extends Controller
{

    public function index()
    {
        $classeCours = ClasseCours::all();
        if (auth()->user()->isProfesseur()){
            $classeCours = ClasseCours::where('professeur_id', auth()->user()->professeur->id)->get();
        }elseif(auth()->user()->isEtudiant()){
            $classeCours = ClasseCours::where('classe_id', auth()->user()->etudiant->classe_id)->get();
        }
        return view('components.pages.classe.cours.list', compact('classeCours'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Classe $classe)
    {
        $classeCours = new ClasseCours();
        $classeCours->classe_id = $classe->id;
        $cours = Cours::where('is_available', 1)->get();
        $professors = Professeur::all();
        $classes = Classe::where('status', 1)->get();

        return view('components.pages.classe.classe_cours', compact('classeCours', 'cours', 'professors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseCoursRequest $request)
    {
        $request->validated();
        ClasseCours::create($request->all());
        return redirect()->route('classe.show', $request->classe_id)->with('success', 'Nouveau cours ajouté avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClasseCours $classeCours)
    {
        $cours = Cours::where('is_available', 1)->get();
        $classes = Classe::where('status', 1)->get();
        $professeurs = Professeur::all();
        return view('components.pages.classe.classe_cours', compact('classeCours', 'cours', 'professeurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseCoursRequest $request, ClasseCours $classeCours)
    {
        $request->validated();
        $classeCours->update($request->all());
        return redirect()->route('classe.show', $classeCours->classe_id)->with('success', 'Cours modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClasseCours $classeCours)
    {
        $classeCours->delete();
        return redirect()->route('classe.show', $classeCours->classe_id)->with('success', 'Cours supprimé avec succès');
    }
}
