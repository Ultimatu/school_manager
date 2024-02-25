@extends('layouts.app')

@section('title', $classe->id ? 'Modifier classe' : 'Ajouter classe')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('classe.index') }}">Classe</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $classe->id ? 'Modifier classe' : 'Ajouter classe' }}</li>
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
                        <h4 class="card-title mt-0">{{ $classe->id ? 'Modifier classe' : 'Ajouter classe' }}</h4>
                        <p class="card-category">
                            {{ $classe->id ? 'Modifier les informations de la classe' : 'Ajouter les informations de la classe' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $classe->id ? route('classe.update', $classe->id) : route('classe.store') }}" id="form">
                            @csrf
                            @if ($classe->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$classe->id}}">
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $classe->name) }}" placeholder="Nom de la classe">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="status" class="bmd-label-floating">Statut</label>
                                        <select name="status" id="status" class="form-control">
                                            {{-- <option value="0" {{ $classe->status === 0 ? 'selected' : '' }}>Inactif
                                            </option> --}}
                                            <option value="1" selected>Actif
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
                                        <label for="level" class="bmd-label-floating">Niveau</label>
                                        <input type="text" class="form-control" id="level" name="level"
                                            value="{{ old('level', $classe->level) }}" placeholder="Niveau de la classe">
                                        @error('level')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="year" class="bmd-label-floating">Année Scolaire</label>
                                        <input type="text" class="form-control" id="year" name="year"
                                            value="{{ old('year', $classe->year) }}"
                                            placeholder="Entrez l'année scolaire Ex: 2023-2024" minlength="9"
                                            maxlength="9" pattern="^\d{4}-\d{4}$">
                                        @error('year')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="branch" class="bmd-label-floating">Filière</label>
                                        <select name="filiere_id" id="branch" class="form-control">
                                            <option value="">Selectionner une filière</option>
                                            @foreach ($filieres as $filiere)
                                                <option value="{{ $filiere->id }}"
                                                    {{ $filiere->id == $classe->filiere_id ? 'selected' : '' }}>
                                                    {{ $filiere->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('filiere_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="credit" class="bmd-label-floating">Crédits</label>
                                        <input type="number" class="form-control" id="credits" name="credits"
                                            value="{{ old('credits', $classe->credits) }}"
                                            placeholder="Entrez le nombre de crédits"  max="60" min="50">
                                        @error('credits')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="button"
                                class="btn btn-{{ $classe->id ? 'warning' : 'primary' }} pull-right w-100 mt-3">
                                {{ $classe->id ? 'Modifier' : 'Ajouter' }}</button>

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
        $('#branch').select2();
        $('#status').select2();

        $('button[type="button"]').click(function() {
            $('#form').submit();
        });
    });
</script>
@endpush
