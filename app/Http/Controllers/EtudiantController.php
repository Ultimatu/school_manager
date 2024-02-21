<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Mail\AccountActivatedMail;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::orderBy('classe_id')->get();
        return view('components.pages.etudiants.list', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiant = new Etudiant();
        $classes = Classe::all();
        return view('components.pages.etudiants.form', compact('etudiant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants|unique:users',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id',
            'student_mat' => 'required|string|max:255',
            'card_id' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'cni' => 'nullable|string|max:255',
            'urgent_phone' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:255',
        ]);
        //create user with role etudiant
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->student_mat),
            'role_auth' => 'etudiant',
            'phone' => $request->phone,
        ]);

        //create etudiant

        $etudiant = Etudiant::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->student_mat),
            'phone' => $request->phone,
            'address' => $request->address,
            'classe_id' => $request->classe_id,
            $request->student_mat,
            'card_id' => $request->card_id,
            'birth_date' => $request->birth_date,
            'birth_place' => $request->birth_place,
            'cin' => $request->cin,
            'user_id' => $user->id,
            'status' => 'active',
            'urgent_phone' => $request->urgent_phone,
        ]);

        if (env('MAIL_SERVICE_STATE') == 'on') {
            Mail::to($request->email)->send(new AccountActivatedMail('etudiant', $etudiant));
        }

        return redirect()->route('etudiant.show', $etudiant->id)->with('success', 'Nouvel étudiant ajouté avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {

        return view('components.pages.etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        $classes = Classe::all();
        return view('components.pages.etudiants.form', compact('etudiant'));
    }

    public function addParent(Etudiant $etudiant)
    {
        $parents = Parents::all();
        return view('components.pages.etudiants.add-parent', compact('etudiant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //validate request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants|unique:users',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id',
            'student_mat' => 'required|string|max:255',
            'card_id' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'cni' => 'nullable|string|max:255',
            'urgent_phone' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:255',
        ]);
        //update user
        $etudiant->user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->student_mat),
        ]);

        //update etudiant
        $etudiant->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->student_mat),
            'phone' => $request->phone,
            'address' => $request->address,
            'classe_id' => $request->classe_id,
            $request->student_mat,
            'card_id' => $request->card_id,
            'birth_date' => $request->birth_date,
            'birth_place' => $request->birth_place,
            'cin' => $request->cin,
            'status' => 'active',
            'urgent_phone' => $request->urgent_phone,
        ]);

        return redirect()->route('etudiant.show', $etudiant->id)->with('success', 'Etudiant modifié avec succès');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiant.index')->with('success', 'Etudiant supprimé avec succès');
    }
}
