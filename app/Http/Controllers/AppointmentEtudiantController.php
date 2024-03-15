<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentEtudiantRequest;
use App\Http\Requests\UpdateAppointmentEtudiantRequest;
use App\Models\Appointment;
use App\Models\AppointmentEtudiant;
use App\Models\Notification;
use Illuminate\Http\Request;

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
                Notification::create([
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $etudiant->user_id,
                    'message' => 'Vous avez été marqué présent au cours de '.$appointment->classeCourse->cours->name.' du '.$appointment->start_date,
                    'status' => 'unread',
                    'icon' => 'ri-checkbox-circle-fill',
                    'link' => route('appointment.show', $validatedData['appointment_id']),
                    'is_read' => false
                ]);
            }
        }
        else{
            foreach ($etudiants as $etudiant){
                $appointmentEtudiant = new AppointmentEtudiant();
                $appointmentEtudiant->etudiant_id = $etudiant->id;
                $appointmentEtudiant->appointment_id = $validatedData['appointment_id'];
                $appointmentEtudiant->is_present = !in_array($etudiant->id, $validatedData['etudiant_ids']);
                $appointmentEtudiant->save();
                Notification::create([
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $etudiant->user_id,
                    'message' => 'Vous avez été marqué absent au cours de '.$appointment->classeCourse->cours->name.' du '.$appointment->start_date,
                    'status' => 'unread',
                    'icon' => 'ri-error-warning-fill',
                    'link' => route('appointment.show', $validatedData['appointment_id']),
                    'is_read' => false
                ]);
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
        $validatedData = $request->validated();
        $appointmentEtudiant->update($validatedData);
        Notification::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $appointmentEtudiant->etudiant->user_id,
            'message' => 'Votre status de présence au cours de '.$appointmentEtudiant->appointment->classeCourse->cours->name.' du '.$appointmentEtudiant->appointment->start_date.' a été modifié',
            'status' => 'unread',
            'icon' => 'ri-checkbox-circle-fill',
            'link' => route('appointment.show', $appointmentEtudiant->appointment_id),
            'is_read' => false
        ]);
        return redirect()->route('appointment.show', $appointmentEtudiant->appointment_id)->with('success', 'Liste de presence modifiée avec succès');
    }

    public function storeAllPresent(Request $request, Appointment $appointment)
    {
        $etudiants = $appointment->classe->etudiants;
        foreach ($etudiants as $etudiant){
            $appointmentEtudiant = new AppointmentEtudiant();
            $appointmentEtudiant->etudiant_id = $etudiant->id;
            $appointmentEtudiant->appointment_id = $appointment->id;
            $appointmentEtudiant->is_present = true;
            $appointmentEtudiant->save();
            Notification::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $etudiant->user_id,
                'message' => 'Vous avez été marqué présent au cours de '.$appointment->classeCourse->cours->name.' du '.$appointment->start_date,
                'status' => 'unread',
                'icon' => 'ri-checkbox-circle-fill',
                'link' => route('appointment.show', $appointment->id),
                'is_read' => false
            ]);
        }
        return redirect()->route('appointment.show', $appointment->id)->with('success', 'Liste de presence émmargée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentEtudiant $appointmentEtudiant)
    {
        $appointmentEtudiant->delete();
        return redirect()->route('appointment.index')->with('success', 'Liste de presence supprimée avec succès');
    }


    public function changeStatus(Request $request)
    {
        $appointmentEtudiant = AppointmentEtudiant::find($request->appointment_id);
        $appointmentEtudiant->is_present = !$appointmentEtudiant->is_present;
        $appointmentEtudiant->save();
        Notification::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $appointmentEtudiant->etudiant->user_id,
            'message' => 'Votre status de présence au cours de '.$appointmentEtudiant->appointment->classeCourse->cours->name.' du '.$appointmentEtudiant->appointment->start_date.' a été modifié',
            'status' => 'unread',
            'icon' => 'ri-checkbox-circle-fill',
            'link' => route('appointment.show', $appointmentEtudiant->appointment_id),
            'is_read' => false
        ]);
        return response()->json(['success' => 'Status modifié avec succès', 'is_present' => $appointmentEtudiant->is_present], 200);
    }
}
