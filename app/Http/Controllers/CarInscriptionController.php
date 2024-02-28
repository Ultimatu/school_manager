<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarInscriptionRequest;
use App\Http\Requests\UpdateCarInscriptionRequest;
use App\Models\AnneeScolaire;
use App\Models\CarInscription;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Request;

class CarInscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('components.pages.cars.inscriptions.list', [
            'inscriptions' => CarInscription::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $car_inscription = new CarInscription();
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        return view('components.pages.cars.inscriptions.form', compact('inscriptions', 'etudiants'));

    }

    public function addVersement(CarInscription $inscription)
    {
        return view('components.pages.cars.inscriptions.form_add', compact('inscription'));
    }


    public function storeVersement(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:car_inscriptions,id',
            'versements' => 'required|numeric',
        ]);
        $versement = CarInscription::find($request->id);

        //verifier si le montant total est atteint

        if ($this->isPaid($versement->versements, $versement->total_amount)) {
            return redirect()->route('car_inscriptions.index')->with('error', 'Le montant total est déjà atteint');
        }
        //ajouter le versement sur le versement existant en array
        $versement->versements = $versement->versements . ';' . $request->versements;

        if ($this->isPaid($versement->versements, $versement->total_amount)) {
            $versement->is_paid = true;
        }
        $versement->save();
        return redirect()->route('car_inscriptions.index')->with('success', 'Versement ajouté avec succès');
    }

    public function destroyVersement($inscription, $versement)
    {
        $inscription = CarInscription::find($inscription);
        $versements = explode(';', $inscription->versements);
        //supprimer un versement
        unset($versements[$versement]);
        $inscription->versements = implode(';', $versements);
        $inscription->save();
        return redirect()->route('car_inscriptions.index')->with('success', 'Versement supprimé avec succès');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarInscriptionRequest $request)
    {
        $request->validated();
        $car_inscription = CarInscription::create($request->all());
        return redirect()->route('car_inscriptions.index')->with('success', 'Etudiant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarInscription $carInscription)
    {
        return view('components.pages.cars.inscriptions.show', compact('inscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarInscription $carInscription)
    {

        return view('components.pages.cars.inscriptions.form', compact('inscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarInscriptionRequest $request, CarInscription $carInscription)
    {
        $request->validated();
        $carInscription->update($request->all());
        return redirect()->route('car_inscriptions.index')->with('success', 'Etudiant modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarInscription $carInscription)
    {
        $carInscription->delete();
        return redirect()->route('car_inscriptions.index')->with('success', 'Etudiant supprimé avec succès');
    }


    private function getVersement($versements)
    {
        $versements = explode(';', $versements);
        $versements = array_map(function ($versement) {
            return floatval($versement);
        }, $versements);
        return array_sum($versements);
    }

    private function isPaid($versements, $total_amount)
    {
        $versements = $this->getVersement($versements);
        return $versements >= $total_amount;
    }


}
