@extends('layouts.app')


@section('title', $cite->id ? 'Modifier citée' : 'Ajouter citée')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cites.index') }}">Citées</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $cite->id ? 'Modifier' : 'Ajouter' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}
    {{-- 'name',
        'status',
        'capacity',
        'description',
        'type',
        'address', --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">{{ $cite->id ? 'Modifier' : 'Ajouter' }} un bâtiment</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ $cite->id ? route('cites.update', $cite) : route('cites.store') }}">
                            @csrf
                            @if ($cite->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="name" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $cite->name) }}">
                                        @error('name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="status" class="form-label">Statut</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="disponible"
                                                {{ old('status', $cite->status) == 'disponible' ? 'selected' : '' }}>
                                                Disponible</option>
                                            <option value="indisponible"
                                                {{ old('status', $cite->status) == 'indisponible' ? 'selected' : '' }}>
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
                                        <label for="capacity" class="form-label">Capacité</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity"
                                            value="{{ old('capacity', $cite->capacity) }}">
                                        @error('capacity')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="type" class="form-label">Type</label>
                                        <input type="text" class="form-control" id="type" name="type"
                                            value="{{ old('type', $cite->type) }}">
                                        @error('type')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address', $cite->address) }}">
                                        @error('address')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', $cite->description) }}</textarea>
                                        @error('description')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right w-100">
                                {{ $cite->id ? 'Modifier' : 'Ajouter' }}</button>
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
            $('#status').select2();
        });
    </script>
@endpush
