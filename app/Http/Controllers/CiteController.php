<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCiteRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Models\Cite;

class CiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cites = Cite::all();
        return view('components.pages.citee.index', compact('cites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cite = new Cite();
        return view('components.pages.citee.form', compact('cite'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCiteRequest $request)
    {
        $request->validated();
        $cite = Cite::create($request->all());
        return redirect()->route('cites.index')->with('success', 'Cite ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cite $cite)
    {
        return view('components.pages.citee.show', compact('cite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cite $cite)
    {
        return view('components.pages.citee.form', compact('cite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCiteRequest $request, Cite $cite)
    {
        $request->validated();
        $cite->update($request->all());
        return redirect()->route('cites.index')->with('success', 'Cite modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cite $cite)
    {
        $cite->delete();
        return redirect()->route('cites.index')->with('success', 'Cite supprimée avec succès');
    }
}
