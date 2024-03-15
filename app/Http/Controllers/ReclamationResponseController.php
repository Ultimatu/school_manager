<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReclamationResponseRequest;
use App\Http\Requests\UpdateReclamationResponseRequest;
use App\Models\Notification;
use App\Models\Reclamantion;
use App\Models\ReclamationResponse;

class ReclamationResponseController extends Controller
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
    public function create(Reclamantion $reclamation)
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $notification = Notification::where('link', route('reclamations.show', $reclamation->id))->where('receiver_id', auth()->user()->id)->first();
        if ($notification) {
            $notification->status = 'read';
            $notification->is_read = true;
            $notification->save();
        }
        $reclamationResponse = new ReclamationResponse();
        $reclamationResponse->reclamantion_id = $reclamation->id;
        return view('components.pages.reclamation.response.form', compact('reclamationResponse'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReclamationResponseRequest $request)
    {
        $request->validated();
        if ($request->hasFile('piece_jointe')) {
            $file = $request->file('piece_jointe');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/reclamations'), $fileName);
            $request->merge(['piece_jointe' => "uploads/reclamations/$fileName"]);
        }
        $reclamationResponse = ReclamationResponse::create($request->all());
        $reclamationResponse->reclamantion->update(['status' => 'resolved']);
        Notification::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $reclamationResponse->reclamantion->etudiant->user_id,
            'message' => 'Votre réclamation a été résolue',
            'status' => 'unread',
            'icon' => 'ri-checkbox-circle-fill',
            'link' => route('reclamations.show', $reclamationResponse->reclamantion->id),
            'is_read' => false
        ]);
        return redirect()->route('reclamations.index')->with('success', 'Réponse créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReclamationResponse $reclamationResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReclamationResponse $reclamationResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReclamationResponseRequest $request, ReclamationResponse $reclamationResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReclamationResponse $reclamationResponse)
    {
        //
    }
}
