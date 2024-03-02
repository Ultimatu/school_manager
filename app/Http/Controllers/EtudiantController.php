<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Mail\AccountActivatedMail;
use App\Models\Classe;
use App\Models\DetailsPayement;
use App\Models\Etudiant;
use App\Models\Parents;
use App\Models\PaymentScolarite;
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
        if (auth()->user()->isProfesseur()) {
            $etudiants = Etudiant::profStudents(auth()->user()->professeur->id);
        }
        return view('components.pages.etudiants.list', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiant = new Etudiant();
        $classes = Classe::all();
        return view('components.pages.etudiants.form', compact('etudiant', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        //validate request
        $request->validated();
        //create user with role etudiant
        $password = User::generatePassword("ETUDIANT");
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => \bcrypt($password),
            'role_auth' => 'etudiant',
            'phone' => $request->phone,
            'annee_scolaire'=>$request->annee_scolaire
        ]);
        //create etudiant
        $request->merge(['user_id' => $user->id, 'password' => \bcrypt($password)]);
        $etudiant = Etudiant::create($request->all());

        $paymentScolarite = PaymentScolarite::create([
            'etudiant_id' => $etudiant->id,
            'amount' => $request->amount,
            'is_paid' => $request->is_paid,
            'date'=> now(),
            'annee_scolaire' => $request->annee_scolaire,
        ]);
        $versement = DetailsPayement::create([
            'payment_scolarite_id' => $paymentScolarite->id,
            'amount' => $request->versement_amount,
            'date' => now(),
        ]);


        if (env('MAIL_SERVICE_STATE') == 'on') {
            Mail::to($request->email)->send(new AccountActivatedMail('etudiant', $user, $password, "created"));
        }

        if ($request->has('add_parent')) {
            return redirect()->route('parents.create', ['etudiant' => $etudiant->id]);
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
        return view('components.pages.etudiants.form', compact('etudiant', 'classes'));
    }

    public function addParent(Etudiant $etudiant)
    {
        $parents = Parents::all();
        return view('components.pages.etudiants.add-parent', compact('etudiant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        //validate request
        $request->validated();
        //update user
        $password = User::generatePassword("ETUDIANT");
        $user =$etudiant->user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => \bcrypt($password)
        ]);

        //update etudiant
        $etudiant->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => \bcrypt($password),
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

        $paymentScolarite = PaymentScolarite::where('etudiant_id', $etudiant->id)->first();
        $paymentScolarite->update([
            'amount' => $request->amount,
            'is_paid' => $request->is_paid,
            'date'=> now(),
            'annee_scolaire' => $request->annee_scolaire,
        ]);

        $versement = DetailsPayement::where('payment_scolarite_id', $paymentScolarite->id)->first();
        $versement->update([
            'amount' => $request->versement_amount,
            'date' => now(),
        ]);
        if (env('MAIL_SERVICE_STATE') == 'on') {
            Mail::to($request->email)->send(new AccountActivatedMail('etudiant', $user, $password, "updated"));
        }

        return redirect()->route('etudiant.show', $etudiant->id)->with('success', 'Etudiant modifié avec succès');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $user = User::find($etudiant->user_id);
        $etudiant->delete();
        $user->delete();
        return redirect()->route('etudiant.index')->with('success', 'Etudiant supprimé avec succès');
    }
}
