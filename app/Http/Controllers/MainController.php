<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard(){
        $filieres = Filiere::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        $etudiants = Etudiant::where('annee_scolaire', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        $classes = Classe::where('year', AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire)->get();
        $anneeScolaire = AnneeScolaire::where('status', 'en cours')->first();
        return view('components.apps.dashboard');
    }


    public function profile(){
        return view('components.pages.profile.index');
    }


    public function switchYear(AnneeScolaire $anneeScolaire){
        $anneeScolaire->status = 'en cours';
        AnneeScolaire::where('status', 'en cours')->where('id', '!=', $anneeScolaire->id)->update(['status' => 'terminé']);
        $anneeScolaire->save();
        return redirect()->route('dashboard');
    }
}
