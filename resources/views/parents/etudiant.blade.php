@extends('layouts.app-parent')

@section('title', 'Liste des etudiants')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('parent-dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Etudiants</li>
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
                        <h4 class="card-title text-center">Liste des etudiants</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Matricule
                                    </th>
                                    <th>
                                        Nom & Prenom
                                    </th>
                                    <th scope="col">
                                        Sexe
                                    </th>
                                    <th>
                                        Classe & Filiere
                                    </th>
                                    <th>
                                        Date & Lieu de naissance
                                    </th>
                                    <th>
                                        Montant scolarité
                                    </th>
                                    <th>
                                        Email & téléphone
                                    </th>
                                    <th>
                                            Scolarité
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->parent->etudiants as $etudiant)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($etudiant->etudiant->avatar ?? 'users/avatar.png') }}"
                                                    alt="avatar" class="img-fluid" width="50">
                                            </td>
                                            <td>
                                                {{ $etudiant->etudiant->student_mat }}
                                            </td>
                                            <td>
                                                {{ $etudiant->etudiant->first_name }} {{ $etudiant->etudiant->last_name }}
                                            </td>
                                            <td>
                                                {{ $etudiant->etudiant->gender }}
                                            </td>
                                            <td>
                                                {{ $etudiant->etudiant->classe->name }} - {{ $etudiant->etudiant->classe->filiere->name }}
                                            </td>
                                            <td>
                                                {{ $etudiant->etudiant->birth_date }} - {{ $etudiant->etudiant->birth_place }}
                                            </td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $etudiant->etudiant->scolarite->amount }} FCFA
                                                    </span>
                                                </td>
                                            <td>
                                                {{ $etudiant->etudiant->email . '  ' . $etudiant->etudiant->phone }}
                                            </td>
                                                <td>
                                                    @if ($etudiant->etudiant->scolarite->is_paid)
                                                        <span class="badge bg-success">Soldé</span>
                                                    @else
                                                        <span class="badge bg-danger">Non soldé</span>
                                                    @endif
                                                </td>
                                            <td class="d-flex justify-content-center align-items-center gap-2">
                                                <a href="{{ route('parent-etudiant-show', $etudiant->etudiant_id) }}" class="btn btn-info">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
