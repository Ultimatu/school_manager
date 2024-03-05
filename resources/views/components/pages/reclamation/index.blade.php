@extends('layouts.app')


@section('title', 'Liste des réclamations')



@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Réclamations</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end breadcrumb --}}

    {{-- content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center">Liste des réclamations en attente</h4>
                        <p class="card-category">Liste des réclamations enregistrées qui sont en attente de traitement</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    @if (auth()->user()->isEtudiant())
                                        <th>
                                            Professeur
                                        </th>
                                    @endif
                                    @if (auth()->user()->isProfesseur())
                                        <th>
                                            Étudiant
                                        </th>
                                        <th>
                                            Classe & Filière
                                        </th>
                                    @endif
                                    <th>
                                        Type (Examen, Evaluation)
                                    </th>
                                    <th>
                                        message
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($reclamantionsPending as $reclamantion)
                                        <tr>
                                            <td>
                                                {{ $reclamantion->id }}
                                            </td>
                                            @if (auth()->user()->isEtudiant())
                                                <td>
                                                    {{ $reclamantion->evaluation->professeur->first_name }}
                                                    {{ $reclamantion->evaluation->professeur->last_name }}
                                                </td>
                                            @endif
                                            @if (auth()->user()->isProfesseur())
                                                <td>
                                                    {{ $reclamantion->etudiant->first_name }}
                                                    {{ $reclamantion->etudiant->last_name }}
                                                </td>
                                                <td>
                                                    {{ $reclamantion->evaluation->classeCours->classe->name }} -
                                                    {{ $reclamantion->evaluation->classeCours->classe->filiere->name }}
                                                </td>
                                            @endif
                                            <td>
                                                @if ($reclamantion->is_exam)
                                                    <span class="badge badge-pill bg-danger">Examen</span>
                                                @else
                                                    <span class="badge badge-pill bg-warning">Evaluation</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $reclamantion->message }}
                                            </td>
                                            <td>
                                                {{ $reclamantion->date }}
                                            </td>
                                            <td class="td-actions d-flex justify-content-around gap-2">
                                                <a href="{{ route('reclamations.show', $reclamantion->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="ri-eye-line"></i>
                                                    Voir
                                                </a>
                                                @if (auth()->user()->isProfesseur())
                                                    {{-- repondre --}}
                                                    <a href="{{ route('reclamations.response.create', $reclamantion->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="ri-pencil-line"></i>
                                                        Répondre
                                                    </a>
                                                @endif
                                                @if (auth()->user()->isEtudiant())
                                                    {{-- modifier --}}
                                                    @if ($reclamantion->is_exam)
                                                        <a href="{{ route('reclamations.editEx', $reclamantion->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="ri-pencil-line"></i>
                                                            Modifier
                                                        </a>
                                                    @else
                                                        <a href="{{ route('reclamations.editEv', $reclamantion->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="ri-pencil-line"></i>
                                                            Modifier
                                                        </a>
                                                    @endif
                                                    {{-- supprimer --}}
                                                    <form action="{{ route('reclamations.destroy', $reclamantion->id) }}"
                                                        method="post" id="delete-form-{{ $reclamantion->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="deleteItem({{ $reclamantion->id }})">
                                                            <i class="ri-delete-bin-line"></i>
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Aucune réclamation en attente
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($reclamantionsResolved->count() > 0)
            <div class="row mt-1">
                <div class="col-12">
                    <div class="card card-plain">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-center">Liste des réclamations traitées</h4>
                            <p class="card-category">Liste des réclamations enregistrées qui sont déjà traitées</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="">
                                        <th>
                                            ID
                                        </th>
                                        @if (auth()->user()->isEtudiant())
                                            <th>
                                                Professeur
                                            </th>
                                        @endif
                                        @if (auth()->user()->isProfesseur())
                                            <th>
                                                Étudiant
                                            </th>
                                            <th>
                                                Classe & Filière
                                            </th>
                                        @endif
                                        <th>
                                            Type (Examen, Evaluation)
                                        </th>
                                        <th>
                                            message
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        @forelse ($reclamantionsResolved as $reclamantion)
                                            <tr>
                                                <td>
                                                    {{ $reclamantion->id }}
                                                </td>
                                                @if (auth()->user()->isEtudiant())
                                                    <td>
                                                        {{ $reclamantion->evaluation->professeur->first_name }}
                                                        {{ $reclamantion->evaluation->professeur->last_name }}
                                                    </td>
                                                @endif
                                                @if (auth()->user()->isProfesseur())
                                                    <td>
                                                        {{ $reclamantion->etudiant->first_name }}
                                                        {{ $reclamantion->etudiant->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $reclamantion->evaluation->classeCours->classe->name }} -
                                                        {{ $reclamantion->evaluation->classeCours->classe->filiere->name }}
                                                    </td>
                                                @endif
                                                <td>
                                                    @if ($reclamantion->is_exam)
                                                        <span class="badge badge-pill bg-danger">Examen</span>
                                                    @else
                                                        <span class="badge badge-pill bg-warning">Evaluation</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $reclamantion->message }}
                                                </td>
                                                <td>
                                                    {{ $reclamantion->date }}
                                                </td>
                                                <td class="td-actions d-flex justify-content-around gap-2">
                                                    <a href="{{ route('reclamations.show', ['reclamantion' => $reclamantion->id]) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="ri-eye-line"></i>
                                                        Voir
                                                    </a>
                                                    @if (auth()->user()->isEtudiant())
                                                        {{-- supprimer --}}
                                                        <form
                                                            action="{{ route('reclamations.destroy', $reclamantion->id) }}"
                                                            method="post" id="delete-form-{{ $reclamantion->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="deleteItem({{ $reclamantion->id }})">
                                                                <i class="ri-delete-bin-line"></i>
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Aucune réclamation en traitée
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- end content --}}
@endsection


@push('scripts')
    <script>
        function deleteItem(id) {
            let form = document.getElementById('delete-form-' + id);
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6a6a6a',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
@endpush
