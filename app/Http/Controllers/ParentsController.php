<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParentsRequest;
use App\Http\Requests\UpdateParentsRequest;
use App\Models\Etudiant;
use App\Models\Parents;
use App\Models\User;

class ParentsController extends Controller
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
    public function create(Etudiant $etudiant)
    {
        $parent = new Parents();
        $parents = Parents::all();
        return view('components.pages.etudiant.add_parent', compact('etudiant', 'parent', 'parents'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParentsRequest $request)
    {
        if ($request->has('parent_id')){
            $parent = Parents::find($request->parent_id);
            $parent->etudiants_ids = $parent->etudiants_ids . ';' . $request->etudiant_id;
            $parent->save();

            return redirect()->route('etudiant.show', $parent->etudiant_id)->with('success', 'Parent ajouté avec succès');
        }

        $request->validated();
        $etudiant = Etudiant::find($request->etudiant_id);
        $parent = new Parents();
        $parent->first_name = $request->first_name;
        $parent->last_name = $request->last_name;
        $parent->email = $request->email;
        $parent->phone = $request->phone;
        $parent->address = $request->address;
        $parent->profession = $request->profession;
        $parent->etudiants_ids = $request->etudiant_id;
        $parent->type = $request->type;
        $parent->is_legal_tutor = $request->is_legal_tutor;

        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->phone);
        $user->role_auth = 'parent';
        $user->save();

        $parent->user_id = $user->id;
        $parent->save();



        return redirect()->route('etudiant.show', $etudiant->id)->with('success', 'Nouveau parent ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Parents $parents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parents $parents)
    {
        return view('components.pages.etudiant.add_parent', compact('parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParentsRequest $request, Parents $parents)
    {
         //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parents $parents)
    {
        $parents->delete();
        $user = User::find($parents->user_id);
        $user->delete();
        $parents->delete();
        return redirect()->route('etudiant.show', $parents->etudiant_id)->with('success', 'Parent supprimé avec succès');
    }
}
