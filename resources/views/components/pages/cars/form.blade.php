@extends('layouts.app')


@section('title', $car->id ? 'Modifier la voiture' : 'Ajouter une voiture')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cars.index') }}">Voitures</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $car->id ? 'Modifier' : 'Ajouter' }}</li>

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
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">{{ $car->id ? 'Modifier la voiture' : 'Ajouter une voiture' }}</h4>
                        <p class="card-category">{{ $car->id ? 'Modifier' : 'Ajouter' }} une voiture</p>
                    </div>
                    <div class="card-body">
                        {{--  'matricule','marque','model','type','status' --}}
                        <form action="{{ $car->id ? route('cars.update', $car->id) : route('cars.store') }}" method="post">
                            @csrf
                            @if ($car->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="matricule" class="bmd-label-floating">Matricule</label>
                                        <input type="text" class="form-control" id="matricule" name="matricule"
                                            value="{{ old('matricule', $car->matricule) }}">
                                            @error('matricule')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="marque" class="bmd-label-floating">Marque</label>
                                        <input type="text" class="form-control" id="marque" name="marque"
                                            value="{{ old('marque', $car->marque) }}">
                                            @error('marque')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="model" class="bmd-label-floating">Model</label>
                                        <input type="text" class="form-control" id="model" name="model"
                                            value="{{ old('model', $car->model) }}">
                                            @error('model')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="type" class="bmd-label-floating">Type</label>
                                         <select name="type" id="type" class="form-control">
                                            <option value="mini-bus" {{ old('type', $car->type) == 'mini-bus' ? 'selected' : '' }}><i class="ri-bus-fill"></i> Mini-bus</option>
                                            <option value="bus" {{ old('type', $car->type) == 'bus' ? 'selected' : '' }}><i class="ri-bus-2-fill"></i> Bus(Car)</option>
                                        </select>
                                            @error('type')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="status" class="bmd-label-floating">Statut</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="disponible" {{ old('status', $car->status) == 'disponible' ? 'selected' : '' }}><i class="ri-checkbox-circle-fill text-success"></i> Disponible</option>
                                            <option value="indisponible" {{ old('status', $car->status) == 'indisponible' ? 'selected' : '' }}><i class="ri-close-circle-fill text-danger"></i> Indisponible</option>
                                        </select>
                                            @error('status')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary w-100 mb-2">{{ $car->id ? 'Modifier' : 'Ajouter' }}</button>
                            <a href="{{ route('cars.index') }}" class="btn btn-danger">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $('#type').select2();
        $('#status').select2();
    </script>
@endpush

