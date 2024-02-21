<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateBulletinRequest;
use App\Models\Bulletin;

class BulletinController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBulletinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bulletin $bulletin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bulletin $bulletin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBulletinRequest $request, Bulletin $bulletin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulletin $bulletin)
    {
        //
    }
}
