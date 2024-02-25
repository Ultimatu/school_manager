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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/cours'), $image_name);
            $request->merge(['image' => "images/cours/$image_name"]);
        }
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/cours'), $image_name);
            $request->merge(['image' => "images/cours/$image_name"]);
        }
        $cours->update($request->all());
        return redirect()->route('cours.index')->with('success', 'Cours modifié avec succès');
    }

    /**
     * Change the status of the specified resource in storage.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus($id){
        $cours = Cours::find($id);
        $cours->is_available = !$cours->is_available;
        $cours->save();
        return response()->json(['message'=>'cours status changed successfully']);
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
