@extends('layouts.app')


@section('title', $chauffeur->id ? 'Modifier le chauffeur' : 'Ajouter un chauffeur')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('chauffeurs.index') }}">Chauffeurs</a></li>
                    <li class="breadcrumb item active" aria-current="page">{{ $chauffeur->id ? 'Modifier' : 'Ajouter' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card">
                    <div class="card-chauffeur card-chauffeur-primary">
                        <h4 class="card-title mt-0">{{ $chauffeur->id ? 'Modifier le chauffeur' : 'Ajouter un chauffeur' }}
                        </h4>
                        <p class="card-category">
                            {{ $chauffeur->id ? 'Modifier les informations du chauffeur' : 'Ajouter un nouveau chauffeur' }}
                        </p>
                    </div>
                    {{-- 'first_name',
                            'last_name',
                            'phone',
                            'address',
                            'avatar',
                            'status',
                            'car_id',
                            'trajet_id',
                             --}}

                    <div class="card-body">
                        <form
                            action="{{ $chauffeur->id ? route('chauffeurs.update', $chauffeur->id) : route('chauffeurs.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($chauffeur->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="first_name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ old('first_name', $chauffeur->first_name) }}">
                                        @error('first_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="last_name" class="bmd-label-floating">Prénom</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ old('last_name', $chauffeur->last_name) }}">
                                        @error('last_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="phone" class="bmd-label-floating">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone', $chauffeur->phone) }}">
                                        @error('phone')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="address" class="bmd-label-floating">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address', $chauffeur->address) }}">
                                        @error('address')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="avatar" class="bmd-label-floating">Photo</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                        @error('avatar')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="status" class="bmd-label-floating">Statut</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="disponible"
                                                {{ old('status', $chauffeur->status) == 'disponible' ? 'selected' : '' }}>
                                                Disponible</option>
                                            <option value="indisponible"
                                                {{ old('status', $chauffeur->status) == 'indisponible' ? 'selected' : '' }}>
                                                Indisponible</option>
                                        </select>
                                        @error('status')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="car_id" class="bmd-label-floating">Voiture</label>
                                        <select name="car_id" id="car_id" class="form-control">
                                            <option value="">Selectionner une voiture</option>
                                            @foreach ($cars as $car)
                                                <option value="{{ $car->id }}"
                                                    {{ old('car_id', $chauffeur->car_id) == $car->id ? 'selected' : '' }}>
                                                    {{ $car->matricule }}</option>
                                            @endforeach
                                        </select>
                                        @error('car_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="trajet_id" class="bmd-label-floating">Trajet</label>
                                        <select name="trajet_id" id="trajet_id" class="form-control">
                                            <option value="">Selectionner un trajet</option>
                                            @foreach ($trajets as $trajet)
                                                <option value="{{ $trajet->id }}"
                                                    {{ old('trajet_id', $chauffeur->trajet_id) == $trajet->id ? 'selected' : '' }}>
                                                    {{ $trajet->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('trajet_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-outline-primary mb-3">{{ $chauffeur->id ? 'Modifier' : 'Ajouter' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#car_id").select2();
        $('#trajet_id').select2();
        $('#status').select2();
    </script>
@endpush
