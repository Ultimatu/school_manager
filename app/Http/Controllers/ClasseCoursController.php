<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseCoursRequest;
use App\Http\Requests\UpdateClasseCoursRequest;
use App\Models\Classe;
use App\Models\ClasseCours;
use App\Models\Cours;

class ClasseCoursController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Classe $classe)
    {
        $classeCours = new ClasseCours();
        $cours = Cours::where('is_available', 1)->get();
        return view('components.pages.classe.classe_cours', compact('classeCours', 'classe', 'cours'));
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
        return view('components.pages.classe.classe_cours', compact('classeCours', 'cours'));
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
