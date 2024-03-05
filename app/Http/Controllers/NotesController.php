<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
use App\Models\AnneeScolaire;
use App\Models\ClasseCours;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Notes;
use App\Models\Professeur;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Notes::currentYear();
        if (auth()->user()->isEtudiant()){
            $notes = Notes::where('annee_scolaire', AnneeScolaire::valideYear())->where('etudiant_id', auth()->user()->etudiant->id)->get();
        }
        return view('components.pages.notes.list', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Evaluation $evaluation)
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $notes = new Notes();
        $notes->evaluation_id = $evaluation->id;
        $professeur = Professeur::where('user_id', Auth::user()->id)->first();
        $etudiants = Etudiant::where('classe_id', $evaluation->classeCours->classe_id)->get();
        //selectionner les etudiants qui n'ont pas de notes pour cette évaluation
        $etudiants = $etudiants->filter(function ($etudiant) use ($evaluation) {
            return !$etudiant->notes->contains('evaluation_id', $evaluation->id);
        });
        return view('components.pages.evaluation.notes.form', compact('notes', 'etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotesRequest $request)
    {
        $request->validated();
        $note = Notes::create($request->all());
        return redirect()->route('notes.create', $note->evaluation_id)->with('success', 'Note créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        return view('componenets.pages.notes.show', compact('notes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $etudiants = Etudiant::where('classe_id', $notes->classeCours->classe_id)->get();
        return view('components.pages.notes.form', compact('notes', 'etudiants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotesRequest $request, Notes $notes)
    {
        $request->validated();
        $notes->update($request->all());
        return redirect()->route('notes.index')->with('success', 'Note modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $notes)
    {
        if (!auth()->user()->isProfesseur()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $notes->delete();
        return redirect()->route('notes.index')->with('success', 'Note supprimée avec succès');
    }



    public function addNotes(ClasseCours $classeCours)
    {
        $notes = new Notes();
        $notes->professeur_id = Professeur::where('user_id', Auth::user()->id)->first()->id;
        $notes->classe_cours_id = $classeCours->id;
        $etudiants = Etudiant::where('classe_id', $classeCours->classe_id)->get();
        return view('components.pages.notes.form', compact('notes', 'etudiants'));
    }

    public function downloadFile(ClasseCours $classeCours){
        // Créer le fichier CSV
        $filename = $this->createCSV($classeCours);
        // Télécharger le fichier
        return ;
    }




    private function createCSV(ClasseCours $classeCours){
        // Nom du fichier CSV
        $filename = 'notes_'.$classeCours->classe->name.'_'.$classeCours->cours->name.'_'.$classeCours->professeur->first_name.'_'.$classeCours->professeur->last_name.'.csv';
    
        // Création d'un nouveau classeur
        $spreadsheet = new Spreadsheet();
    
        // Sélection de la feuille de calcul active
        $sheet = $spreadsheet->getActiveSheet();
    
        // Définition des en-têtes de colonne
        $sheet->setCellValue('A1', 'Matricule');
        $sheet->setCellValue('B1', 'Nom');
        $sheet->setCellValue('C1', 'Prénom');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Note');    
        // Verrouiller toutes les colonnes sauf la colonne des notes (colonne E)
        for ($col = 'A'; $col <= 'D'; $col++) {
            $sheet->getStyle($col . '1:' . $col . $sheet->getHighestRow())->getProtection()->setLocked(true);
        } 
        // Activer la protection de la feuille de calcul pour empêcher la modification des cellules verrouillées
        $sheet->getProtection()->setSheet(true);
    
        // Générer le fichier CSV
        $writer = new Csv($spreadsheet);
        $writer->save($filename);
    
        return $filename;
    }
}
