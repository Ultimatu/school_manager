@extends('layouts.app')


@section('title', 'Liste des notes')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notes</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Liste des notes</h4>
                        @if (!auth()->user()->isEtudiant())
                            <p class="card-category">Liste des notes enregistrées</p>
                        @else
                            <p class="card-category">Liste de vos notes enregistrées</p>

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
                                        Matière
                                    </th>
                                    <th>
                                        Note
                                    </th>
                                    <th>
                                        Coefficient
                                    </th>
                                    @if (!auth()->user()->isEtudiant())
                                        <th>
                                            Etudiant & classe
                                        </th>
                                    @endif
                                    @if (auth()->user()->isProfesseur())
                                        <th>
                                            Actions
                                        </th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td>
                                                {{ $note->id }}
                                            </td>
                                            <td>
                                                {{ $note->etudiant->classe->classeCours->cours->name }}
                                            </td>
                                            <td>
                                                {{ $note->note }}
                                            </td>
                                            @if (!auth()->user()->isEtudiant())
                                            <td>
                                                {{$note->etudiant->student_mat.' - '.$note->etudiant->first_name. ' '. $note->etudiant->last_name }} - {{  $note->etudiant->classe->name. ' '.  $note->etudiant->classe->filiere->name}}
                                            </td>
                                            @endif

                                            @if (auth()->user()->isProfesseur())
                                                <td>
                                                    <a href="{{ route('notes.show', $note) }}"
                                                        class="btn btn-outline-primary">
                                                        <i class="ri-eye-line"></i>
                                                        Voir la note</a>
                                                    <a href="{{ route('notes.edit', $note) }}"
                                                        class="btn btn-outline-primary">
                                                        <i class="ri-edit-line"></i>
                                                        Modifier la note</a>
                                                    <form method="POST" action="{{ route('notes.destroy', $note) }}"
                                                        id="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger"
                                                            onclick="confirmDelete()">
                                                            <i class="ri-delete-bin-line"></i>
                                                            Supprimer la note</button>
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
            </div>
        </div>
    </div>
@endsection
