<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\AnneeScolaire;
use App\Models\Appointment;
use App\Models\ClasseCours;
use App\Models\EmploiDuTemps;
use App\Models\Notification;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isEtudiant()){
            $appointments = Appointment::where('classe_id', auth()->user()->etudiant->classe_id)->get();
        }
        elseif(auth()->user()->isProfesseur()){
            $appointments = Appointment::where('professeur_id', auth()->user()->professeur->id)->orderBy('id', 'desc')->get();
        }
        else{
            $appointments = Appointment::orderBy('id', 'desc')->get();
        }
        return view('components.pages.emmargement.index', compact('appointments'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointment = new Appointment();
        $ClasseCours = ClasseCours::all();
        //pour valide year et ordonnees par last in last out 
        $emplois = EmploiDuTemps::where('professeur_id', auth()->user()->professeur->id)->orderBy('id', 'desc')->get();
        return view('components.pages.emmargement.form', compact('appointment', 'ClasseCours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $validatedData = $request->validated();
        $appointment = Appointment::create($validatedData);
        return redirect()->route('appointment.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        if (auth()->user()->isEtudiant()){
            $notification = Notification::where('receiver_id', auth()->user()->id)->where('link', route('appointment.show', $appointment->id))->first();
            if ($notification){
                $notification->update(['is_read'=>true, 'status'=>'read']);
            }
        }
        return view('components.pages.emmargement.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $ClasseCours = ClasseCours::all();
        return view('components.pages.emmargement.form', compact('appointment', 'ClasseCours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $validatedData = $request->validated();
        $appointment->update($validatedData);
        return redirect()->route('appointment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointment.index');
    }
}
