@extends('layouts.app')



@section('title', 'Détails de l\'examen')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('examens.index') }}">Examens</a></li>
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
                        @if (auth()->user()->isProfesseur())
                            <div class="row">
                                {{-- ajouter des notes --}}
                                <div class="col-md-12">
                                    <a href="{{ route('examens.notes.create', ['examen' => $examen->id]) }}"
                                        class="btn btn-primary float-right">
                                        <i class="ri-add-line fs-2"></i>
                                        Ajouter des notes</a>
                                </div>
                            </div>
                        @endif
                        <h4 class="card-title text-center">Détails de l'examen</h4>
                        <p class="card-category">Détails de l'examen enregistré</p>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Classe: {{ $examen->classe->name }} {{ $examen->classe->level }}</p>
                        <p class="text-center">Cours: {{ $examen->classeCours->cours->ame }}</p>
                        <p class="text-center">Salle: {{ $examen->salle->name }}</p>
                        <p class="text-center">Jour de la semaine: {{ $examen->day }}</p>
                        <p class="text-center">Date & Heure de début: {{ $examen->start_date_time }}</p>
                        <p class="text-center">Date & Heure de fin: {{ $examen->end_date_time }}</p>
                        @if (auth()->user()->isCreator())
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('examens.edit', $examen) }}" class="btn btn-primary float-right">
                                        <i class="ri-pencil-line"></i>
                                        Modifier</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
