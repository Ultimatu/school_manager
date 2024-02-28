@extends('layouts.app')


@section('title', $anneeScolaire->id ? 'Modifier une année' : 'Ajouter une année')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('years.index') }}">Années</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $anneeScolaire->id ? 'Modifier' : 'Ajouter' }}
                    </li>
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
                        <h4 class="card-title text-center">{{ $anneeScolaire->id ? 'Modifier' : 'Ajouter' }} une année</h4>
                        <p class="card-category">Ajouter une année scolaire</p>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $anneeScolaire->id ? route('years.update', $anneeScolaire) : route('years.store') }}"
                            method="POST">
                            @csrf
                            @if ($anneeScolaire->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label for="annee_scolaire" class="bmd-label-floating">Année scolaire</label>
                                        <input type="text" class="form-control" id="annee_scolaire" name="annee_scolaire"
                                            value="{{ old('annee_scolaire', $anneeScolaire->annee_scolaire) }}"
                                            placeholder="Ex: 2021-2022" pattern="^\d{4}-\d{4}$" required>
                                        @error('annee_scolaire')
                                            <div class="text-danger  d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="debut" class="bmd-label-floating">Date de début</label>
                                        <input type="date" class="form-control" id="debut" name="debut"
                                            value="{{ old('debut', $anneeScolaire->debut) }}" required>
                                        @error('debut')
                                            <div class="text-danger  d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="fin" class="bmd-label-floating">Date de fin</label>
                                        <input type="date" class="form-control" id="fin" name="fin"
                                            value="{{ old('fin', $anneeScolaire->fin) }}" required>
                                        @error('fin')
                                            <div class="text-danger  d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="status" class="bmd-label-floating">Statut</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="en cours"
                                                {{ $anneeScolaire->status === 'en cours' ? 'selected' : '' }}>Année en
                                                cours</option>
                                            <option value="terminée"
                                                {{ $anneeScolaire->status === 'terminée' ? 'selected' : '' }}>Finie
                                            </option>
                                            <option value="à venir"
                                                {{ $anneeScolaire->status === 'à venir' ? 'selected' : '' }}>Année à venir
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger  d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- check button pour savoir si c'est déja terminé is_finish --}}
                                <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center">
                                    <div class="form-check form-switch">
                                            <input type="checkbox" name="is_finish" data-id="{{ $anneeScolaire->id }}" role="switch"
                                                class="js-switch form-check-input fs-2"
                                                {{ $anneeScolaire->status === 'en cours' ? 'checked' : '' }}>
                                        <label class="form-check form-switch" for="is_finish">Année terminée</label>
                                        @error('is_finish')
                                            <div class="text-danger  d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-1">
                                    <button type="submit"
                                        class="btn btn-primary w-100">{{ $anneeScolaire->id ? 'Modifier' : 'Ajouter' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')

    <script>
        //select2
        $(document).ready(function() {
            $('#status').select2();
            $('button[type="submit"]').click(function() {
                $('#form').submit();
            });
        });

    </script>

@endpush
