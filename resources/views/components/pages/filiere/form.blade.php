@extends('layouts.app')

@section('title', $filiere->id ? 'Modifier filière' : 'Nouvelle filière')

@section('content')

    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('filiere.index') }}">Filières</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $filiere->id ? 'Modifier filière' : 'Nouvelle filière' }}</li>
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
                        <h4 class="card-title mt-0">{{ $filiere->id ? 'Modifier filière' : 'Nouvelle filière' }}</h4>
                        <p class="card-category">
                            {{ $filiere->id ? 'Modifier les informations de la filière' : 'Ajouter les informations de la filière' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $filiere->id ? route('filiere.update', $filiere->id) : route('filiere.store') }}"
                            id="form" enctype="multipart/form-data">
                            @csrf
                            @if ($filiere->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$filiere->id}}">
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $filiere->name) }}" placeholder="Nom de la filière">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="status" class="bmd-label-floating form-label">Statut</label>
                                        <select name="status" id="status" class="form-control form-select">
                                            {{-- <option value="0" {{ $filiere->status === 0 ? 'selected' : '' }}>Inactif
                                            </option> --}}
                                            <option value="1" {{ $filiere->status === 1 ? 'selected' : '' }}>Actif
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="description" class="bmd-label-floating">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description', $filiere->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="image" class="bmd-label-floating">Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="annee_scolaire" class="bmd-label-floating">Année Scolaire</label>
                                        <input type="text" class="form-control" id="annee_scolaire" name="annee_scolaire"
                                            value="{{ old('annee_scolaire', $filiere->annee_scolaire) }}"
                                            placeholder="Entrez l'année scolaire Ex: 2023-2024" required minlength="9" maxlength="9" pattern="^\d{4}-\d{4}$">
                                        @error('annee_scolaire')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                {{ $filiere->id ? 'Modifier' : 'Ajouter' }}</button>
                            <a href="{{ route('filiere.index') }}" class="btn btn-danger mt-1">Annuler</a>
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
