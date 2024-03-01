@extends('layouts.app')

@section('title', $professeur->id ? 'Modifier professeur' : 'Ajouter professeur')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('professeur.index') }}">Professeurs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $professeur->id ? 'Modifier professeur' : 'Ajouter professeur' }}</li>
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
                        <h4 class="card-title mt-0">{{ $professeur->id ? 'Modifier professeur' : 'Ajouter professeur' }}
                        </h4>
                        <p class="card-category">
                            {{ $professeur->id ? 'Modifier les informations du professeur' : 'Ajouter un nouveau professeur' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $professeur->id ? route('professeur.update', $professeur->id) : route('professeur.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($professeur->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $professeur->id }}">
                            @endif
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="first_name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ old('first_name') ?? $professeur->first_name }}">
                                        @error('first_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="last_name" class="bmd-label-floating">Prenom</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ old('last_name') ?? $professeur->last_name }}">
                                        @error('last_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="email" class="bmd-label-floating">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') ?? $professeur->email }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="phone" class="bmd-label-floating">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') ?? $professeur->phone }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="address" class="bmd-label-floating">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address') ?? $professeur->address }}">
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="avatar" class="bmd-label-floating">Photo</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                        @error('avatar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($professeur->avatar)
                                        <img src="{{ asset($professeur->avatar) }}" alt="photo de {{ $professeur->nom }}"
                                            class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    {{-- gender --}}
                                    <div class="form-group bmd-form-group">
                                        <label for="gender" class="bmd-label-floating">Genre</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="M" {{ $professeur->gender == 'M' ? 'selected' : '' }}>
                                                Masculin</option>
                                            <option value="F" {{ $professeur->gender == 'F' ? 'selected' : '' }}>
                                                Féminin</option>
                                        </select>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    {{-- is_available --}}
                                    <div class="form-group bmd-form-group">
                                        <label for="is_available" class="bmd-label-floating">Statut</label>
                                        <select name="is_available" id="is_available" class="form-control" required>
                                            <option value="1" {{ $professeur->is_available == 1 ? 'selected' : '' }}>
                                                Disponible</option>
                                            <option value="0" {{ $professeur->is_available == 0 ? 'selected' : '' }}>
                                                Indisponible</option>
                                        </select>
                                        @error('is_available')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="annee_scolaire" class="bmd-label-floating">Année Scolaire</label>
                                        <input type="text" class="form-control" id="annee_scolaire"
                                            name="annee_scolaire"
                                            value="{{ old('annee_scolaire', $professeur->annee_scolaire) }}"
                                            placeholder="Entrez l'année scolaire Ex: 2023-2024" required minlength="9"
                                            maxlength="9" pattern="^\d{4}-\d{4}$">
                                        @error('annee_scolaire')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="matricule" class="bmd-label-floating">Matricule</label>
                                        <input type="text" class="form-control" id="matricule" name="matricule"
                                            value="{{ old('matricule') ?? $professeur->matricule }}"> <button
                                            type="button" class="btn btn-info"
                                            onclick="generateMatricule()">Générer</button>
                                        @error('matricule')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="specialities" class="bmd-label-floating">Spécialités</label>
                                        <input type="text" class="form-control" id="specialities" name="specialities"
                                            value="{{ old('specialities') ?? $professeur->specialities }}">
                                        @error('specialities')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-primary pull-right w-100">{{ $professeur->id ? 'Modifier' : 'Ajouter' }}</button>
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
        // select2
        $(document).ready(function() {
            $('#gender').select2();
            $('#is_available').select2();

        });

        function generateMatricule() {
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();
            let matricule = first_name.substr(0, 2).toUpperCase() + last_name.substr(0, 2).toUpperCase() + Math.floor(Math
                .random() * 1000);
            var beg = "PROF-";
            matricule = beg + matricule;
            $('#matricule').val(matricule);
        }
    </script>
@endpush
