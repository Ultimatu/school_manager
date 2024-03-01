@extends('layouts.app')


@section('title', $inscription->id ? 'Modifier une inscription' : 'Ajouter une inscription')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('car_inscriptions.index') }}">Inscriptions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $inscription->id ? 'Modifier' : 'Ajouter' }}
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
                            {{ $inscription->id ? 'Modifier une facture' : 'Ajouter une facture' }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('car_inscriptions.storeVersement', $inscription) }}">
                            @csrf
                            {{-- @if ($inscription->id)
                                @method('PUT')
                            @endif --}}
                        <input type="hidden" name="etudiant_id" value="{{ $inscription->etudiant_id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="etudiant_id" class="bmd-label-floating">Etudiant</label>
                                        <select name="etudiant_id" id="etudiant_id" class="form-control">
                                            @foreach ($etudiants as $etudiant)
                                                <option value="{{ $etudiant->id }}"
                                                    {{ old('etudiant_id', $inscription->etudiant_id) == $etudiant->id ? 'selected' : '' }}>
                                                    {{ $etudiant->first_name }} {{ $etudiant->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('etudiant_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="trajet_id" class="bmd-label-floating">Trajet</label>
                                        <select name="trajet_id" id="trajet_id" class="form-control">
                                            @foreach ($trajets as $trajet)
                                                <option value="{{ $trajet->id }}"
                                                    {{ old('trajet_id', $inscription->trajet_id) == $trajet->id ? 'selected' : '' }}>
                                                    {{ $trajet->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('trajet_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- montant de l'inscriptions --}}
                                    <div class="form-group bmd-form-group">
                                        <label for="total_amount" class="bmd-label-floating">Montant de
                                            l'inscription</label>
                                        <input type="number" name="total_amount" id="total_amount"
                                            value="{{ old('total_amount', $inscription->total_amount) }}"
                                            class="form-control">
                                        @error('total_amount')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- montant versé --}}
                                    <div class="form-group bmd-form-group">
                                        <label for="versements" class="bmd-label-floating">Montant versé</label>
                                        <input type="number" name="versements" id="versements"
                                            value="{{ old('versements', $inscription->versements) }}" class="form-control">
                                        @error('versements')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-primary pull-right w-100">{{ $inscription->id ? 'Modifier' : 'Ajouter' }}</button>
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
        $('#trajet_id').select2();
    </script>
@endpush
