<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfesseurRequest;
use App\Http\Requests\UpdateProfesseurRequest;
use App\Mail\AccountActivatedMail;
use App\Models\Professeur;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeurs = Professeur::all();
        return view('components.pages.profs.list', compact('professeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professeur = new Professeur();
        return view('components.pages.profs.form', compact('professeur'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfesseurRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->back()->with('error', 'Cet email est déjà utilisé');
        }

        $request->validated();
        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->matricule);
        $user->role_auth = 'professeur';
        $user->save();

        $professeur = new Professeur();
        $professeur->first_name = $request->first_name;
        $professeur->last_name = $request->last_name;
        $professeur->email = $request->email;
        $professeur->phone = $request->phone;
        $professeur->address = $request->address;
        $professeur->matricule = $request->matricule;
        $professeur->specialities = $request->specialities;
        $professeur->user_id = $user->id;
        $professeur->is_available = $request->is_available;
        $professeur->save();

        if (env('MAIL_SERVICE_STATE') == 'on') {
            Mail::to($request->email)->send(new AccountActivatedMail('professeur', $professeur));
        }

        return redirect()->route('professeur.index')->with('success', 'Nouveau professeur ajouté avec succès');


    }

    /**
     * Display the specified resource.
     */
    public function show(Professeur $professeur)
    {
        return view('components.pages.profs.show', compact('professeur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professeur $professeur)
    {
        return view('components.pages.profs.form', compact('professeur'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfesseurRequest $request, Professeur $professeur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professeur $professeur)
    {
        $user = User::find($professeur->user_id);
        $user->delete();
        $professeur->delete();
        return redirect()->route('professeur.index')->with('success', 'Professeur supprimé avec succès');
    }
}