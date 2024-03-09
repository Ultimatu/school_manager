@extends('layouts.app')

@section('title', 'Liste des etudiants')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
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
                        @if (!auth()->user()->isProfesseur())
                            <p class="card-category">Liste des etudiants enregistrés</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('etudiant.create') }}" class="btn btn-primary float-right">
                                        <i class="ri-add-line"></i>
                                        Ajouter un etudiant</a>
                                </div>
                            </div>
                        @endif
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
                                    @if (!auth()->user()->isProfesseur())
                                        <th>
                                            Montant scolarité
                                        </th>
                                    @endif
                                    <th>
                                        Email & téléphone
                                    </th>
                                    @if (!auth()->user()->isProfesseur())
                                        <th>
                                            Scolarité
                                        </th>
                                    @endif
                                    <th>
                                        Action
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($etudiants as $etudiant)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($etudiant->avatar ?? 'users/avatar.png') }}"
                                                    alt="avatar" class="img-fluid" width="50">
                                            </td>
                                            <td>
                                                {{ $etudiant->student_mat }}
                                            </td>
                                            <td>
                                                {{ $etudiant->first_name }} {{ $etudiant->last_name }}
                                            </td>
                                            <td>
                                                {{ $etudiant->gender }}
                                            </td>
                                            <td>
                                                {{ $etudiant->classe->name }} - {{ $etudiant->classe->filiere->name }}
                                            </td>
                                            <td>
                                                {{ $etudiant->birth_date }} - {{ $etudiant->birth_place }}
                                            </td>
                                            @if (!auth()->user()->isProfesseur())
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $etudiant->scolarite->amount }} FCFA
                                                    </span>
                                                </td>
                                            @endif
                                            <td>
                                                {{ $etudiant->email . '  ' . $etudiant->phone }}
                                            </td>
                                            @if (!auth()->user()->isProfesseur())
                                                @php
                                                    dd($etudiant->scolarite->is_paid);
                                                @endphp
                                                <td>
                                                    @if ($etudiant->scolarite->is_paid === 1)
                                                        <span class="badge bg-success">Soldé</span>
                                                    @else
                                                        <span class="badge bg-danger">Non soldé</span>
                                                    @endif
                                                </td>
                                            @endif
                                            <td class="d-flex justify-content-around align-items-center gap-2">
                                                <a href="{{ route('etudiant.show', $etudiant->id) }}" class="btn btn-info">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                @if (!auth()->user()->isProfesseur())
                                                    <a href="{{ route('etudiant.edit', $etudiant->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    <form action="{{ route('etudiant.destroy', $etudiant->id) }}"
                                                        method="post" class="d-inline"
                                                        id="delete-form-{{ $etudiant->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $etudiant->id }})">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($etudiants->count() === 0)
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                Aucun etudiant enregistré
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Etes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endpush
