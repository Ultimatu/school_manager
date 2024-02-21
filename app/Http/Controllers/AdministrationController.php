<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdministrationRequest;
use App\Http\Requests\UpdateAdministrationRequest;
use App\Models\Administration;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $administration = new Administration();
        return view('components.pages.administration.form', compact('administration'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdministrationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Administration $administration)
    {
        return view('components.pages.administration.show', compact('administration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administration $administration)
    {
        return view('components.pages.administration.form', compact('administration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministrationRequest $request, Administration $administration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administration $administration)
    {
        $administration->delete();
        return redirect()->route('administration.index');
    }
}
