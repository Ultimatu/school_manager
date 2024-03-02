@extends('layouts.app')


@section('title', $citeInscription->id ? 'Modifier une inscription' : 'Ajouter une inscription')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('citeInscriptions.index') }}">Inscriptions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $citeInscription->id ? 'Modifier' : 'Ajouter' }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">
                            {{ $citeInscription->id ? 'Modifier une inscription' : 'Ajouter une inscription' }}</h4>
                        <p class="card-category">
                            {{ $citeInscription->id ? 'Modifier une inscription' : 'Ajouter une inscription' }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $citeInscription->id ? route('citeInscriptions.update', $citeInscription->id) : route('citeInscriptions.store') }}">
                            @csrf
                            @if ($citeInscription->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="etudiant_id" class="bmd-label-floating">Etudiant</label>
                                        <select name="etudiant_id" id="etudiant_id" class="form-control">
                                            @foreach ($etudiants as $etudiant)
                                                <option value="{{ $etudiant->id }}"
                                                    {{ old('etudiant_id', $citeInscription->etudiant_id) == $etudiant->id ? 'selected' : '' }}>
                                                    {{ $etudiant->first_name }} {{ $etudiant->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('etudiant_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="chambre_id" class="bmd-label-floating">Chambez</label>
                                        <select name="chambre_id" id="chambre_id" class="form-control">
                                            @foreach ($chambres as $chambre)
                                                <option value="{{ $chambre->id }}"
                                                    {{ old('chambre_id', $citeInscription->chambre_id) == $chambre->id ? 'selected' : '' }}>
                                                    {{ $chambre->name.' de la cité '. $chambre->cite->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('chambre_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    {{-- montant de l'inscriptions --}}
                                    <div class="form-group bmd-form-group">
                                        <label for="total_amount" class="bmd-label-floating">Montant de
                                            l'inscription</label>
                                        <input type="number" name="total_amount" id="total_amount"
                                            value="{{ old('total_amount', $citeInscription->total_amount) }}"
                                            class="form-control">
                                        @error('total_amount')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    {{-- montant versé --}}
                                    <div class="form-group bmd-form-group">
                                        <label for="versements" class="bmd-label-floating">Montant versé</label>
                                        <input type="number" name="versements" id="versements"
                                            value="{{ old('versements', $citeInscription->versements) }}" class="form-control">
                                        @error('versements')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-primary pull-right w-100">{{ $citeInscription->id ? 'Modifier' : 'Ajouter' }}</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('#etudiant_id').select2();
        $('#chambre_id').select2();
    </script>
@endpush
