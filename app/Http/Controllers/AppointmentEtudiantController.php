<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentEtudiantRequest;
use App\Http\Requests\UpdateAppointmentEtudiantRequest;
use App\Models\Appointment;
use App\Models\AppointmentEtudiant;

class AppointmentEtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isEtudiant()){
            $appointments = auth()->user()->etudiant->appointments;
            return view('components.pages.emmargement.index', compact('appointments'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Appointment $appointment)
    {
        $etudiants = $appointment->classe->etudiants;
        $appointmentEtudiant = new AppointmentEtudiant();
        $appointmentEtudiant->appointment_id = $appointment->id;
        return view('components.pages.emmargement.form', compact('appointmentEtudiant', 'etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentEtudiantRequest $request)
    {
        $validatedData = $request->validated();
        $appointment = Appointment::find($validatedData['appointment_id']);
        $etudiants = $appointment->classe->etudiants;

        if ($validatedData['selected_are_present'] == true){
            //add all etudiants in appointment but precise if they are present or not depending if they id are in the array
            foreach ($etudiants as $etudiant){
                $appointmentEtudiant = new AppointmentEtudiant();
                $appointmentEtudiant->etudiant_id = $etudiant->id;
                $appointmentEtudiant->appointment_id = $validatedData['appointment_id'];
                $appointmentEtudiant->is_present = in_array($etudiant->id, $validatedData['etudiant_ids']);
                $appointmentEtudiant->save();
            }
        }
        else{
            foreach ($etudiants as $etudiant){
                $appointmentEtudiant = new AppointmentEtudiant();
                $appointmentEtudiant->etudiant_id = $etudiant->id;
                $appointmentEtudiant->appointment_id = $validatedData['appointment_id'];
                $appointmentEtudiant->is_present = !in_array($etudiant->id, $validatedData['etudiant_ids']);
                $appointmentEtudiant->save();
            }
        }

        return redirect()->route('appointment.index')->with('success', 'Liste de presence émmargée avec succès');
      
    }

    /**
     * Display the specified resource.
     */
    public function show(AppointmentEtudiant $appointmentEtudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppointmentEtudiant $appointmentEtudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentEtudiantRequest $request, AppointmentEtudiant $appointmentEtudiant)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentEtudiant $appointmentEtudiant)
    {
        //
    }
}
