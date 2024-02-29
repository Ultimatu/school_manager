@extends('layouts.app-error')

@section('title', '419')

@section('content')
<div class="col-lg-5 d-flex flex-column align-items-center">
    <h1 class="error-number">419</h1>
    <h2 class="error-title">Page Expirée</h2>
    <p class="error-text">Oopps. Vous avez essayé de soumettre un formulaire qui a expiré. si cela persise, veuillez contacter l'administrateur.</p>
    <a href="{{url('/')}}" class="btn btn-primary btn-error">Retour à l'accueil</a>
  </div><!-- col -->
  <div class="col-8 col-lg-6 mb-5 mb-lg-0">
    <object type="image/svg+xml" data="{{asset('assets/svg/server_down.svg')}}" class="w-100"></object>
  </div><!-- col -->
@endsection
