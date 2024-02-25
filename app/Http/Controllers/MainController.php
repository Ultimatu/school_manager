<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard(){
        return view('components.apps.dashboard');
    }
}
