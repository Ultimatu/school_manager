<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;
use App\Models\Cours;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::all();
        return view('components.pages.cours.list', compact('cours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cours = new Cours();
        return view('components.pages.cours.form', compact('cours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursRequest $request)
    {
        $request->validated();
        Cours::create($request->all());
        if ($request->has('add_another')) {
            return redirect()->route('cours.create')->with('success', 'Nouveau cours ajouté avec succès');
        }
        return redirect()->route('cours.index')->with('success', 'Nouveau cours ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cours)
    {
        return view('components.pages.cours.show', compact('cours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        return view('components.pages.cours.form', compact('cours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursRequest $request, Cours $cours)
    {
        $request->validated();
        $cours->update($request->all());
        return redirect()->route('cours.index')->with('success', 'Cours modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        $cours->delete();
        return redirect()->route('cours.index')->with('success', 'Cours supprimé avec succès');
    }
}
