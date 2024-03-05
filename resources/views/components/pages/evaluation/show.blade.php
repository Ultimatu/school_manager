@extends('layouts.app')

@section('title', 'Détails de l\'évaluation')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Évaluations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
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
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center">Détails de l'évaluation</h4>
                        {{-- add Note button --}}
                        @if (auth()->user()->isProfesseur())
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('notes.create', $evaluation->id) }}"
                                        class="btn btn-primary float-right">
                                        <i class="ri-add-line"></i>
                                        Ajouter les notes
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <p>
                            <i class="ri-information-fill"></i>
                            <strong>Classe & Filière:</strong>
                            {{ $evaluation->classeCours->classe->name }} -
                            {{ $evaluation->classeCours->classe->filiere->name }}
                        </p>
                        <p>
                            <i class="ri-book-2-fill"></i>
                            <strong>Cours:</strong>
                            {{ $evaluation->classeCours->cours->name }}
                        </p>
                        <p>
                            <i class="ri-calendar-event-fill"></i>
                            <strong>Durée:</strong>
                            {{ $evaluation->duree }}
                        </p>
                        <p>
                            <i class="ri-calendar-event-fill"></i>
                            <strong>Date:</strong>
                            {{ $evaluation->date }}
                        </p>
                    </div>
                    <div class="card-footer">
                        @if (auth()->user()->isProfesseur())
                            <div class="d-flex justify-content-start gap-2">
                                <a href="{{ route('evaluations.edit', $evaluation->id) }}"
                                    class="btn btn-primary float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier
                                </a>
                                <form action="{{ route('evaluations.destroy', $evaluation) }}" method="post"
                                    id="delete-form">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="confirmDel()">
                                        <i class="ri-delete-bin-line"></i>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- les notes --}}
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center">Les notes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Etudiant
                                    </th>
                                    <th>
                                        Note
                                    </th>
                                    <th>
                                        Coéfficient
                                    </th>
                                    @if (auth()->user()->isProfesseur())
                                        <th class="text-center">
                                            Actions
                                        </th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($evaluation->notes as $note)
                                        <tr>
                                            <td>
                                                {{ $note->id }}
                                            </td>
                                            <td>
                                                {{ $note->etudiant->first_name . ' ' . $note->etudiant->last_name }}
                                            </td>
                                            <td>
                                                {{ $note->note }} / {{ $evaluation->max_note }}
                                            </td>
                                            <td>
                                                {{ $evaluation->coefficient }}
                                            </td>
                                            @if (auth()->user()->isProfesseur())
                                                <td class="td-actions d-flex justify-content-around gap-3">
                                                    <a href="{{ route('notes.edit', $note) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="ri-pencil-line"></i>
                                                        Modifier
                                                    </a>
                                                    <form action="{{ route('notes.destroy', $note) }}" method="post"
                                                        id="delete-form-{{ $note->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $note->id }})">
                                                            <i class="ri-delete-bin-line"></i>
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end les notes --}}
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

        function confirmDel() {
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
                    document.getElementById('delete-form').submit();
                }
            })
        }
    </script>
@endpush
