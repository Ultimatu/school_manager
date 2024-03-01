<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Professeur;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard(){
        $nbretudiant=Etudiant::count();
        $nbrprof=Professeur::count();
        $nbrfiliere=Filiere::count();

        // $nbetudiant=Etudiant::count();
        return view('components.apps.dashboard',[
            'nbretudiant'=>$nbretudiant,
            'nbrprof'=>$nbrprof,
            'nbrfiliere'=>$nbrfiliere,

        ]);
    }
}
