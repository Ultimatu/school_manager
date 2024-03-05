@extends('layouts.app')

@section('title', 'Liste des évaluations')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Évaluations</li>
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
                        <h4 class="card-title-2">Liste des évaluations</h4>
                        @if (auth()->user()->isProfesseur())
                            <p class="card-category">Liste des évaluations enregistrées</p>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('evaluations.create') }}" class="btn btn-primary float-right">
                                        <i class="ri-add-line"></i>
                                        Ajouter une évaluation</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Classe & Filère
                                    </th>
                                    <th>
                                        Cours
                                    </th>
                                    <th>
                                        Durée
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    @if (auth()->user()->isEtudiant())
                                        <th class="text-center bg-primary text-white">
                                            Votre note
                                        </th>
                                    @endif
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($evaluations as $evaluation)
                                        <tr>
                                            <td>
                                                {{ $evaluation->id }}
                                            </td>
                                            <td>
                                                {{ $evaluation->classeCours->classe->name }} -
                                                {{ $evaluation->classeCours->classe->filiere->name }}
                                            </td>
                                            <td>
                                                {{ $evaluation->classeCours->cours->name }}
                                            </td>
                                            <td>
                                                {{ $evaluation->duree }}
                                            </td>
                                            <td>
                                                {{ $evaluation->date }}
                                            </td>
                                            @if (auth()->user()->isEtudiant())
                                                @php
                                                    $note = $evaluation->notes
                                                        ->where('etudiant_id', auth()->user()->etudiant->id)
                                                        ->first();
                                                @endphp
                                                @if ($note)
                                                    <td class="text-center bg-primary text-white">
                                                        {{ $note->note }}
                                                    </td>
                                                @else
                                                    <td class="text-center bg-danger text-white">
                                                        Pas encore note enregistrée
                                                    </td>
                                                @endif
                                            @endif
                                            <td class="td-actions d-flex justify-content-around gap-2">
                                                @if (!auth()->user()->isEtudiant())
                                                    <a href="{{ route('evaluations.show', $evaluation->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="ri-eye-line"></i>
                                                        Voir
                                                    </a>
                                                @elseif (auth()->user()->isEtudiant() && $evaluation->notes->count() > 0)
                                                    {{-- reclamation --}}
                                                    <a href="{{ route('reclamations.createForEv', $evaluation->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="ri-pencil-line"></i>
                                                        Faire une réclamation
                                                    </a>
                                                @endif
                                                @if (auth()->user()->isProfesseur())
                                                    <a href="{{ route('evaluations.edit', $evaluation->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="ri-pencil-line"></i>
                                                        Modifier
                                                    </a>
                                                    <form action="{{ route('evaluations.destroy', $evaluation->id) }}"
                                                        method="post" id="delete-form-{{ $evaluation->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $evaluation->id }})">
                                                            <i class="ri-delete-bin-line"></i>
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                @endif
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
    {{-- end content --}}
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
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
