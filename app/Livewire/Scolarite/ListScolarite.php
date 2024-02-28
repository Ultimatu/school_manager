<?php

namespace App\Livewire\Scolarite;

use Livewire\Component;

class ListScolarite extends Component
{
    public $etudiants;
    public $scolarites;

    public function mount()
    {
        $this->etudiants = \App\Models\Etudiant::all();
        $this->scolarites = \App\Models\AnneeScolaire::all();
    }
    public function render()
    {
        return view('components.pages.scolarite.list');
    }

    //filtre
    public function filterPaid()
    {
        $this->scolarites = \App\Models\PaymentScolarite::where('is_paid', true)->get();
    }
}
