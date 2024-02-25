@extends('layouts.app')

@section('title', 'Detail professeur')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('professeur.index') }}">Professeurs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détail professeur</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Détail professeur </h4>
                        <p class="card-category"> Informations sur le professeur </p>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('professeur.edit', $professeur->id) }}" class="btn btn-warning float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Photo:</strong> <img src="{{ asset($professeur->avatar ?? 'administration/avatar.png') }}" alt="photo" width="100"></p>
                                <p><strong>Matricule:</strong> {{ $professeur->matricule }}</p>
                                <p><strong>Nom:</strong> {{ $professeur->first_name }}</p>
                                <p><strong>Prénom:</strong> {{ $professeur->last_name }}</p>
                                <p><strong>Genre:</strong> {{ $professeur->gender }}</p>
                                <p><strong>Email:</strong> {{ $professeur->email }}</p>
                                <p><strong>Téléphone:</strong> {{ $professeur->phone }}</p>
                                <p><strong>Adresse:</strong> {{ $professeur->address }}</p>
                                <p><strong>Statut:</strong> {{ $professeur->is_available === '1' ? 'Actif' : 'Inactif' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Créé le:</strong> {{ $professeur->created_at->format('d/m/Y') }}</p>
                                <p><strong>Modifié le:</strong> {{ $professeur->updated_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

