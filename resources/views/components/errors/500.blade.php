@extends('layouts.app-error')

@section('title', '500')

@section('content')
<div class="col-lg-5 d-flex flex-column align-items-center">
    <h1 class="error-number">500</h1>
    <h2 class="error-title">Erreur Interne du Serveur</h2>
    <p class="error-text">Oopps. Une erreur interne du serveur s'est produite.</p>
    <a href="{{url('/')}}" class="btn btn-primary btn-error">Retour à l'accueil</a>
  </div><!-- col -->
  <div class="col-8 col-lg-6 mb-5 mb-lg-0">
    <object type="image/svg+xml" data="{{asset('assets/svg/pair_programming.svg')}}" class="w-100"></object>
  </div><!-- col -->
@endsection
