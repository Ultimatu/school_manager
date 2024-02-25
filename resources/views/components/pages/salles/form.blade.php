@extends('layouts.app')

@section('title', $salle->id ? 'Modifier une salle' : 'Ajouter une salle')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('salle.index') }}">Salle</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $salle->id ? 'Modifier une salle' : 'Ajouter une salle' }}</li>
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
                        <h4 class="card-title mt-0">{{ $salle->id ? 'Modifier la salle' : 'Ajouter une salle' }}</h4>
                        <p class="card-category">
                            {{ $salle->id ? 'Modifier les informations de la salle' : 'Ajouter les informations de lasalle' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $salle->id ? route('salle.update', $salle->id) : route('salle.store') }}" id="form">
                            @csrf
                            @if ($salle->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$salle->id}}">
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $salle->name) }}" placeholder="Nom de la salle">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="is_available" class="bmd-label-floating">Statut</label>
                                        <select name="is_available" id="is_available" class="form-control">
                                            {{-- <option value="0" {{ $salle->is_available === 0 ? 'selected' : '' }}>Inactif
                                            </option> --}}
                                            <option value="1" selected>Disponible
                                            </option>
                                        </select>
                                        @error('is_available')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="location" class="bmd-label-floating">Emplacement</label>
                                        <input type="text" name="location" id="location" placeholder="Entrez l'emplacement de la salle" value="{{ old('location', $salle->location) }}" class="form-control">
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="capacity" class="bmd-label-floating">Capacitée</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Entrez la capacité de la salle" value="{{old('capacity', $salle->capacity)}}">
                                        @error('capacity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="type" class="bmd-label-floating">Type de salle</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="salle informatique" {{ $salle->type === 'salle informatique' ? 'selected' : '' }}>Salle informatique
                                            </option>
                                            <option value="salle de cours" {{ $salle->type === 'salle de cours' ? 'selected' : '' }}>Salle de cours
                                            </option>
                                            <option value="laboratoire" {{ $salle->type === 'laboratoire' ? 'selected' : '' }}>Laboratoire
                                            </option>
                                            <option value="salle de reunion" {{ $salle->type === 'salle de reunion' ? 'selected' : '' }}>Salle de réunion
                                            </option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3 d-flex justify-content-around">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line"></i>
                                        {{ $salle->id ? 'Modifier' : 'Ajouter' }}</button>
                                    <a href="{{ route('salle.index') }}" class="btn btn-danger">
                                        <i class="ri-arrow-go-back-fill"></i>
                                        Retour</a>
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
    $(document).ready(function(){
        $('#is_available').select2();
        $('#type').select2();
    });
</script>

@endpush




