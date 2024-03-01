@extends('layouts.app')



@section('title', $chambre->id ? 'Modifier chambre' : 'Ajouter chambre')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('chambres.index') }}">Chambres</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $chambre->id ? 'Modifier' : 'Ajouter' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">{{ $chambre->id ? 'Modifier' : 'Ajouter' }} une chambre</h4>
                        <p class="card-category">Ajouter une chambre</p>
                    </div>
                    <div class="card-body">
                        {{-- 'number','type','status','cite_id','is_occupied','location','capacity' --}}
                        <form method="POST"
                            action="{{ $chambre->id ? route('chambres.update', $chambre) : route('chambres.store') }}">
                            @csrf
                            @if ($chambre->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="number" class="bmd-label-floating">Numéro de chambre</label>
                                        <input type="text" class="form-control" id="number" name="number"
                                            value="{{ old('number', $chambre->number) }}">
                                        @error('number')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="type" class="bmd-label-floating">Type de chambre</label>
                                        <input type="text" class="form-control" id="type" name="type"
                                            value="{{ old('type', $chambre->type) }}">
                                        @error('type')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="cite_id" class="bmd-label-floating">Citée de la chambre</label>
                                        <select name="cite_id" id="cite_id" class="form-control">
                                            <option value="">Selectionner une citée</option>
                                            @foreach ($cites as $cite)
                                                <option value="{{ $cite->id }}"
                                                    {{ old('cite_id', $chambre->cite_id) == $cite->id ? 'selected' : '' }}>
                                                    {{ $cite->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cite_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group
                                        bmd-form-group">
                                        <label for="status" class="bmd-label-floating">Status de la chambre</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="disponible"
                                                {{ old('status', $chambre->status) == 1 ? 'selected' : '' }}>Disponible
                                            </option>
                                            <option value="indisponbile"
                                                {{ old('status', $chambre->status) == 0 ? 'selected' : '' }}>Non
                                                disponible</option>
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
                                        <label for="location" class="bmd-label-floating">Localisation</label>
                                        <input type="text" class="form-control" id="location" name="location"
                                            value="{{ old('location', $chambre->location) }}">
                                        @error('location')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="capacity" class="bmd-label-floating">Capacité</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity"
                                            value="{{ old('capacity', $chambre->capacity) }}">
                                        @error('capacity')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-primary">{{ $chambre->id ? 'Modifier' : 'Ajouter' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#cite_id').select2();
            $('#status').select2();
        });
    </script>
@endpush
