<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarInscriptionRequest;
use App\Http\Requests\UpdateCarInscriptionRequest;
use App\Models\AnneeScolaire;
use App\Models\CarInscription;
use App\Models\CarInscriptionVersement;
use App\Models\Etudiant;
use App\Models\Trajet;
use Illuminate\Http\Request;

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
        $inscription = new CarInscription();
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        $trajets = Trajet::all();

        return view('components.pages.cars.inscriptions.form', compact('inscription', 'etudiants', 'trajets'));

    }
    public function createBy(Etudiant $etudiant)
    {
        $inscription = new CarInscription();
        $inscription->etudiant_id = $etudiant->id;
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        $trajets = Trajet::all();
        return view('components.pages.cars.inscriptions.form', compact('inscription', 'etudiants', 'trajets'));
    }

    public function addVersement(CarInscription $inscription)
    {
        $versements = $this->getVersement($inscription->versements);
        //verifiy is user is_paid
        if ($inscription->is_paid){
            return redirect()->back()->with('warning', 'Cet étudiant a déjà soldé pour le car');
        }elseif($this->isPaid($versements, $inscription->total_amount)){
            $inscription->is_paid = true;
            $inscription->save();
            return redirect()->back()->with('warning', 'Cet étudiant a déjà soldé pour le car');
        }

        return view('components.pages.cars.inscriptions.form_add', compact('inscription', 'versements'));
    }


    public function storeVersement(Request $request, CarInscription $inscription)
    {
        $request->validate([
            'versement' => 'required|numeric',
            'date_versement' => 'required|date'
        ]);
        if ($inscription->is_paid){
            return redirect()->back()->with('warning', 'Cet étudiant a déjà soldé pour le car');
        }
        $versements = $this->getVersement($inscription->versements);
        //verifier si le montant total est atteint
        if ($this->isPaid($versements, $inscription->total_amount)) {
            $inscription->is_paid = true;
            $inscription->save();
            return redirect()->route('car_inscriptions.index')->with('warning', 'Le montant total est déjà atteint');
        }
        CarInscriptionVersement::create([
            'car_inscription_id' => $inscription->id,
            'versement' => $request->versement,
            'date_versement' => $request->date_versement
        ]);
       $versements = $this->getVersement($inscription->versements);
        
        if ($this->isPaid($versements, $inscription->total_amount)) {
            $inscription->is_paid = true;
        }
        $inscription->versements = $versements;
        return redirect()->route('car_inscriptions.index')->with('success', 'Versement ajouté avec succès');
    }

    public function destroyVersement(CarInscriptionVersement $versement)
    {
        $inscription = CarInscription::find($versement->car_inscription_id);
        $versement->delete();
        $versements = $this->getVersement($inscription->versements);
        if ($this->isPaid($versements, $inscription->total_amount)) {
            $inscription->is_paid = true;
        }
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
        $versement = CarInscriptionVersement::create([
            'car_inscription_id' => $car_inscription->id,
            'versement' => $request->versements,
            'date_versement' => now()
        ]);
        return redirect()->route('car_inscriptions.index')->with('success', 'Etudiant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarInscription $car_inscription)
    {
        $inscription = $car_inscription;
        return view('components.pages.cars.inscriptions.show', compact('inscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarInscription $car_inscription)
    {
        $inscription = $car_inscription;
        return view('components.pages.cars.inscriptions.form', compact('inscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarInscriptionRequest $request, CarInscription $car_inscription)
    {
        $request->validated();
        $car_inscription->update($request->all());
        $versement = CarInscriptionVersement::where('car_inscription_id', $car_inscription->id)->first();
        $versement->update([
            'versement' => $request->versements,
            'date_versement' => now()
        ]);
        return redirect()->route('car_inscriptions.index')->with('success', 'Etudiant modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarInscription $car_inscription)
    {
        $car_inscription->delete();
        return redirect()->route('car_inscriptions.index')->with('success', 'Etudiant supprimé avec succès');
    }

    private function getVersement($versements)
    {
        return $versements->sum('versement');
    }   
   
    private function isPaid($versements, $total_amount)
    {
        return $versements >= $total_amount;
    }


}
