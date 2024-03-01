@extends('layouts.app')


@section('title',  "Details du chauffeur")



@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('chauffeurs.index') }}">Chauffeurs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Details du chauffeur</h4>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('chauffeurs.edit', $chauffeur->id) }}" class="btn btn-primary float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier le chauffeur</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Details du chauffeur enregistré</p>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($chauffeur->avatar ?? 'u') }}" alt="avatar" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <p>Nom & prenom: <strong>{{ $chauffeur->first_name }} {{ $chauffeur->last_name }}</strong></p>
                                <p>Telephone: <strong>{{ $chauffeur->phone }}</strong></p>
                                <p>Adresse: <strong>{{ $chauffeur->address }}</strong></p>
                                <p>Statut: <strong>{{ $chauffeur->status }}</strong></p>
                                @if ($chauffeur->car)
                                    <p>Voiture: <strong>
                                        <a href="{{ route('cars.show', $chauffeur->car->id) }}">
                                            {{ $chauffeur->car->matricule }}
                                        </a>
                                    </strong></p>
                                @endif
                                @if ($chauffeur->trajet)
                                    <p>Trajet: <strong>
                                        <a href="{{ route('trajets.show', $chauffeur->trajet->id) }}">
                                            {{ $chauffeur->trajet->name }}
                                        </a>
                                    </strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
       
    </script>