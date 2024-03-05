<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReclamantionRequest;
use App\Http\Requests\UpdateReclamantionRequest;
use App\Models\Evaluation;
use App\Models\Examen;
use App\Models\Notification;
use App\Models\Reclamantion;

class ReclamantionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isEtudiant()) {
            $reclamantionsPending = Reclamantion::pending()->where('etudiant_id', auth()->user()->etudiant->id)->get();
            $reclamantionsResolved = Reclamantion::resolved()->where('etudiant_id', auth()->user()->etudiant->id)->get();
        } elseif (auth()->user()->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        } elseif (auth()->user()->isProfesseur()) {
            //evaluation id se trouve dans Reclamation, professeur_id se trouve dans Evaluation
            $reclamantionsPending = Reclamantion::pending()->whereHas('evaluation', function ($query) {
                $query->where('professeur_id', auth()->user()->professeur->id);
            })->get();
            $reclamantionsResolved = Reclamantion::resolved()->whereHas('evaluation', function ($query) {
                $query->where('professeur_id', auth()->user()->professeur->id);
            })->get();
        }
        return view('components.pages.reclamation.index', compact('reclamantionsPending', 'reclamantionsResolved'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createForEv(Evaluation $evaluation)
    {
        if (!auth()->user()->isEtudiant()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $reclamation = new Reclamantion();
        $reclamation->evaluation_id = $evaluation->id;
        $reclamation->etudiant_id = auth()->user()->etudiant->id;
        return view('components.pages.reclamation.form_eva', compact('reclamation'));
    }

    public function createForEx(Examen $examen)
    {
        if (!auth()->user()->isEtudiant()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $reclamation = new Reclamantion();
        $reclamation->etudiant_id = auth()->user()->etudiant->id;
        $reclamation->examen_id = $examen->id;
        $reclamation->is_exam = true;
        return view('components.pages.reclamation.form_exam', compact('reclamation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReclamantionRequest $request)
    {
        $request->validated();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/reclamations'), $fileName);
            $request->merge(['file' => "uploads/reclamations/$fileName"]);
        }
        if ($request->is_exam === 1) {
            $reclamation = new Reclamantion();
            $reclamation->etudiant_id = auth()->user()->etudiant->id;
            $reclamation->examen_id = $request->examen_id;
            $reclamation->is_exam = true;
            $reclamation->message = $request->message;
            $reclamation->file = $request->file;
            $reclamation->status = $request->status;
            $reclamation->objet = $request->objet;
            $reclamation->date = $request->date;
            $reclamation->save();
        } else {
            $request->examen_id = null;
            $reclamation = new Reclamantion();
            $reclamation->etudiant_id = auth()->user()->etudiant->id;
            $reclamation->evaluation_id = $request->evaluation_id;
            $reclamation->is_exam = false;
            $reclamation->message = $request->message;
            $reclamation->file = $request->file;
            $reclamation->status = $request->status;
            $reclamation->objet = $request->objet;
            $reclamation->date = $request->date;
            $reclamation->save();
        }
        //notification
        $notification = new Notification();
        if ($reclamation->is_exam) {
            $examen = $reclamation->examen;
            $professeur = $examen->professeur_id;
            $notification->message = "Un étudiant a réclamé pour l'examen de " . $examen->classeCours->cours->name;
            $notification->link = route('reclamations.show', $reclamation->id);
            $notification->sender_id = auth()->user()->id;
            $notification->receiver_id = $professeur;
            $notification->status = 'unread';
            $notification->save();
        } else {
            $evaluation = $reclamation->evaluation;
            $professeur = $evaluation->classeCours->professeur;
            $notification->message = "Un étudiant a réclamé pour l'évaluation de " . $evaluation->classeCours->cours->name;
            $notification->link = route('reclamations.show', $reclamation->id);
            $notification->sender_id = auth()->user()->id;
            $notification->receiver_id = $professeur->user_id;
            $notification->status = 'unread';
            $notification->save();
        }
        return redirect()->route('reclamations.index')->with('success', 'Réclamation créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reclamantion $reclamantion)
    {
        $notification = Notification::where('link', route('reclamations.show', $reclamantion->id))->where('receiver_id', auth()->user()->id)->first();
        if ($notification) {
            $notification->status = 'read';
            $notification->is_read = true;
            $notification->save();
        }
        return view('components.pages.reclamation.show', compact('reclamantion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editEx(Reclamantion $reclamation)
    {

        if (!auth()->user()->isEtudiant()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }

        return view('components.pages.reclamation.form_exam', compact('reclamation'));
    }

    public function editEv(Reclamantion $reclamation)
    {
        if (!auth()->user()->isEtudiant()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        return view('components.pages.reclamation.form_eva', compact('reclamation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReclamantionRequest $request, Reclamantion $reclamantion)
    {
        $request->validated();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/reclamations'), $fileName);
            $request->merge(['file' => "uploads/reclamations/$fileName"]);
        }
        if ($request->is_exam === 1) {
            $reclamantion->etudiant_id = auth()->user()->etudiant->id;
            $reclamantion->examen_id = $request->examen_id;
            $reclamantion->is_exam = true;
            $reclamantion->message = $request->message;
            $reclamantion->file = $request->file;
            $reclamantion->status = $request->status;
            $reclamantion->objet = $request->objet;
            $reclamantion->date = $request->date;
            $reclamantion->save();
        } else {
            $request->examen_id = null;
            $reclamantion->etudiant_id = auth()->user()->etudiant->id;
            $reclamantion->evaluation_id = $request->evaluation_id;
            $reclamantion->is_exam = false;
            $reclamantion->message = $request->message;
            $reclamantion->file = $request->file;
            $reclamantion->status = $request->status;
            $reclamantion->objet = $request->objet;
            $reclamantion->date = $request->date;
            $reclamantion->save();
        }
        $reclamantion->update($request->all());
        $notification = new Notification();
        if ($reclamantion->is_exam) {
            $examen = $reclamantion->examen;
            $professeur = $examen->professeur_id;
            $notification->message = "Un étudiant a réclamé pour l'examen de " . $examen->classeCours->cours->name;
            $notification->link = route('reclamations.show', $reclamantion->id);
            $notification->sender_id = auth()->user()->id;
            $notification->receiver_id = $professeur;
            $notification->status = 'unread';
            $notification->save();
        } else {
            $evaluation = $reclamantion->evaluation;
            $professeur = $evaluation->classeCours->professeur;
            $notification->message = "Un étudiant a réclamé pour l'évaluation de " . $evaluation->classeCours->cours->name;
            $notification->link = route('reclamations.show', $reclamantion->id);
            $notification->sender_id = auth()->user()->id;
            $notification->receiver_id = $professeur->user_id;
            $notification->status = 'unread';
            $notification->save();
        }
        return redirect()->route('reclamations.index')->with('success', 'Réclamation modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reclamantion $reclamantion)
    {
        if (!auth()->user()->isEtudiant()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $reclamantion->delete();
        return redirect()->route('reclamations.index')->with('success', 'Réclamation supprimée avec succès');
    }
}
