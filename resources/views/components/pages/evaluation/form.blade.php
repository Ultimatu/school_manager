@extends('layouts.app')

@section('title', $evaluation->id ? 'Modifier une évaluation' : 'Ajouter une évaluation')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Évaluations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $evaluation->id ? 'Modifier' : 'Ajouter' }}</li>
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
                        <h4 class="card-title-2">{{ $evaluation->id ? 'Modifier' : 'Ajouter' }} une évaluation</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $evaluation->id ? route('evaluations.update', $evaluation) : route('evaluations.store') }}"
                            method="post">
                            @csrf
                            @if ($evaluation->id)
                                @method('put')
                            @endif
                            <input type="hidden" name="professeur_id" value="{{ $evaluation->professeur_id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="classe_cours_id" class="bmd-label-floating">Classe & Cours</label>
                                        <select name="classe_cours_id" id="classe_cours_id"
                                            class="form-control @error('classe_cours_id') is-invalid @enderror">
                                            @foreach ($classeCours as $classeCour)
                                                <option value="{{ $classeCour->id }}"
                                                    {{ $classeCour->id == old('classe_cours_id', $evaluation->classe_cours_id) ? 'selected' : '' }}>
                                                    {{ $classeCour->classe->name }} -
                                                    {{ $classeCour->classe->filiere->name }} -
                                                    {{ $classeCour->cours->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('classe-cours_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="duree" class="bmd-label-floating">Durée</label>
                                        <input type="text" name="duree" id="duree"
                                            class="form-control @error('duree') is-invalid @enderror"
                                            value="{{ old('duree', $evaluation->duree) }}">
                                        @error('duree')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- SUJET --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="sujet" class="bmd-label-floating">Sujet</label>
                                        <input type="text" name="sujet" id="sujet"
                                            class="form-control @error('sujet') is-invalid @enderror"
                                            value="{{ old('sujet', $evaluation->sujet) }}">
                                        @error('sujet')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="date" class="bmd-label-floating">Date</label>
                                        <input type="date" name="date" id="date"
                                            class="form-control @error('date') is-invalid @enderror"
                                            value="{{ old('date', $evaluation->date) }}">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="coefficient" class="bmd-label-floating">Coefficient (Ex: si 1 alors la
                                            note est multipliée par 1)</label>
                                        <select name="coefficient" id="coefficient"
                                            class="form-control @error('coefficient') is-invalid @enderror">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $i == old('coefficient', $evaluation->coefficient) ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('coefficient')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    {{-- max_note --}}
                                    <div class="form-group bmd-form-group">
                                        <label for="max_note" class="bmd-label-floating">Notée sur</label>
                                        <select name="max_note" id="max_note"
                                            class="form-control @error('max_note') is-invalid @enderror">
                                            {{-- 10 and 20 options --}}
                                            <option value="10"
                                                {{ 10 == old('max_note', $evaluation->max_note) ? 'selected' : '' }}>
                                                10</option>
                                            <option value="20"
                                                {{ 20 == old('max_note', $evaluation->max_note) ? 'selected' : '' }}>
                                                20</option>
                                        </select>
                                        @error('max_note')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-{{ $evaluation->id ? 'warning' : 'primary' }} w-100 mt-1">{{ $evaluation->id ? 'Modifier' : 'Ajouter' }}</button>
                            <div class="clearfix"></div>
                        </form>
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
            $('#classe_cours_id').select2({
                placeholder: 'Sélectionner la classe & un cours',
            });
            $('#coefficient').select2({
                placeholder: 'Sélectionner le coefficient',
            });
            $('#max_note').select2({
                placeholder: 'Sélectionner la note maximale',
            });
            
        });
    </script>
@endpush
