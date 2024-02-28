<?php

namespace App\Livewire\Etudiant;

use Livewire\Component;

class ListEtuditant extends Component
{

    public $etudiants;

    public function mount()
    {
        $this->etudiants = \App\Models\Etudiant::all();
    }
    public function render()
    {
        return view('components.pages.etudiants.list');
    }


    //filtre
    public function filterByClasse($classe_id)
    {
        $this->etudiants = \App\Models\Etudiant::where('classe_id', $classe_id)->get();
    }

    public function filterByAnneeScolaire($annee_scolaire)
    {
        $this->etudiants = \App\Models\Etudiant::where('annee_scolaire', $annee_scolaire)->get();
    }

    public function filterByStatus($status)
    {
        $this->etudiants = \App\Models\Etudiant::where('status', $status)->get();
    }

    public function filterBySexe($sexe)
    {
        $this->etudiants = \App\Models\Etudiant::where('gender', $sexe)->get();
    }


    public function filterByNationality($nationality)
    {
        $this->etudiants = \App\Models\Etudiant::where('nationality', $nationality)->get();
    }

}
