@extends('layouts.app')


@section('title', 'Détails de l\'année')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('years.index') }}">Années</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title-text-center">Détails de l'année</h4>
                        <p class="card-category">Détails de l'année scolaire</p>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Année scolaire: {{ $anneeScolaire->annee_scolaire }}</p>
                        <p class="text-center">Date de début: {{ $anneeScolaire->debut }}</p>
                        <p class="text-center">Date de fin: {{ $anneeScolaire->fin }}</p>
                        <p class="text-center">Statut: {{ $anneeScolaire->statut }}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('years.edit', $anneeScolaire) }}" class="btn btn-primary float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
