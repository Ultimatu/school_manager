<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParentsRequest;
use App\Http\Requests\UpdateParentsRequest;
use App\Models\AnneeScolaire;
use App\Models\Etudiant;
use App\Models\ParentChilds;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = Parents::where('annee_scolaire', AnneeScolaire::valideYear())->get();
        if (auth()->user()->isEtudiant()){
            $etudiant = Etudiant::where('user_id', auth()->user()->id)->first();
            $parents = ParentChilds::where('etudiant_id', $etudiant->id)->get()->map(function ($parent){
                return Parents::find($parent->parent_id);
            });
        }
        return view('components.pages.parent.list', [
            'parents' => $parents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Etudiant $etudiant)
    {
        $parent = new Parents();
        return view('components.pages.etudiants.parent.form', compact('etudiant', 'parent'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParentsRequest $request)
    {
        if ($request->has('parent_id')){
            $parent = Parents::find($request->parent_id);
            $child = ParentChilds::create([
                'parent_id'=>$parent->id,
                'etudiant_id'=>$request->etudiant_id
            ]);

            return redirect()->route('etudiant.show', $request->etudiant_id)->with('success', 'Parent ajouté avec succès');
        }

        $request->validated();
        $etudiant = Etudiant::find($request->etudiant_id);
        $parent = new Parents();
        $parent->first_name = $request->first_name;
        $parent->last_name = $request->last_name;
        $parent->phone = $request->phone;
        $parent->email = $request->email;
        $parent->address = $request->address;
        $parent->profession = $request->profession;
        $parent->type = $request->type;
        $parent->is_legal_tutor = $request->is_legal_tutor;
        $parent->status = 'active';
        $parent->annee_scolaire = $etudiant->annee_scolaire;

        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt('parent');
        $user->role_auth = 'parent';
        $user->save();


        $parent->user_id = $user->id;
        $parent->save();

        $child = ParentChilds::create([
            'parent_id'=>$parent->id,
            'etudiant_id'=>$etudiant->id
        ]);


        return redirect()->route('etudiant.show', $etudiant->id)->with('success', 'Nouveau parent ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Parents $parents)
    {
        return view('components.pages.parent.show', compact('parents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parents $parents)
    {
        $parent = $parents;
        return view('components.pages.etudiants.parent.form', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParentsRequest $request, Parents $parents)
    {
        $request->validated();
        $user = User::find($parents->user_id);
        $user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt('parent'),
            'role_auth' => 'parent',
            'phone' => $request->phone,
        ]);
        $parents->update($request->all());
        return redirect()->route('etudiant.show', $parents->etudiant_id)->with('success', 'Parent modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parents $parents)
    {
        $user = User::find($parents->user_id);
        $user->delete();
        $parents->delete();
        return redirect()->route('etudiant.show', $parents->etudiant_id)->with('success', 'Parent supprimé avec succès');
    }
}
