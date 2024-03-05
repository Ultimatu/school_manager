@extends('layouts.app')

@section('title', $notes->exists ? 'Modifier une note' : 'Ajouter une note')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">Notes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $notes->exists ? 'Modifier' : 'Ajouter' }}</li>
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
                        <h4 class="card-title , card-title-2">{{ $notes->exists ? 'Modifier' : 'Ajouter' }} une note</h4>
                        @if (!$notes->exists)
                            <strong class="text-danger"> Vous avez la liste des etudiants qui n'ont pas de notes dans
                                l'evaluation selectionnée</strong>
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($etudiants->count() > 0)
                            {{-- afficher le nombre d'etudiants qui n'ont pas de notes --}}
                            <div class="alert alert-info">
                                @if ($etudiants->count() == 1)
                                    <strong>Il reste un etudiant qui n'a pas de note dans cette évaluation</strong>
                                @elseif ($etudiants->count()>0  && $etudiants->first()->classe->etudiants->count() === $etudiants->count())
                                    <strong>Vous n'avez pas encore saisi de notes pour aucun etudiant de cette évaluation</strong>
                                @else
                                    <strong>Il reste {{ $etudiants->count() }} etudiants qui n'ont pas de note dans cette
                                        évaluation</strong>
                                @endif
                            </div>
                            <form action="{{ $notes->exists ? route('notes.update', $notes) : route('notes.store') }}"
                                method="post">
                                @csrf
                                @if ($notes->exists)
                                    @method('put')
                                @endif
                                <input type="hidden" name="evaluation_id" value="{{ $notes->evaluation_id }}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group bmd-form-group">
                                            <label for="evaluation_id" class="bmd-label-floating">Etudiant</label>
                                            <select name="etudiant_id" id="etudiant_id"
                                                class="form-control @error('etudiant_id') is-invalid @enderror">
                                                @foreach ($etudiants as $etudiant)
                                                    <option value="{{ $etudiant->id }}"
                                                        {{ $etudiant->id == old('etudiant_id', $notes->etudiant_id) ? 'selected' : '' }}>
                                                        {{ $etudiant->first_name }} {{ $etudiant->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('etudiant_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 mb-3">
                                        <div class="form-group bmd-form-group">
                                            <label for="note" class="bmd-label-floating">Note</label>
                                            <input type="text" name="note" id="note"
                                                class="form-control @error('note') is-invalid @enderror"
                                                value="{{ old('note', $notes->note) }}">
                                            @error('note')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group bmd-form-group">
                                            <label for="observation" class="bmd-label-floating">Observation</label>
                                            <input type="text" name="observation" id="observation"
                                                class="form-control @error('observation') is-invalid @enderror"
                                                value="{{ old('observation', $notes->observation) }}">
                                            @error('observation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
                                <div class="clearfix"></div>
                            </form>
                        @else
                            <div class="alert alert-success">
                                <strong>Vous avez déjà saisi les notes pour tous les etudiants de cette évaluation</strong>
                            </div>
                            <a class="btn btn-outline-success" href="{{ route('evaluations.show', $notes->evaluation_id) }}">Voir les notes</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#etudiant_id').select2({
                placeholder: 'Selectionner un etudiant',
            });
        });
    </script>
@endpush
