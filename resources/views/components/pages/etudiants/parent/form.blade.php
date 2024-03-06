@extends('layouts.app')

@section('title', $parent->id ? 'Modifier parent' : 'Ajouter parent')
@section('content')
    {{-- bread --}}
    @if ($parent->id)
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('parents.index') }}">Parents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                    </ol>
                </nav>
            </div>
        </div>
    @else
        <x-shared.breadcrumb :items="[
            ['url' => route('etudiant.index'), 'label' => 'Liste des étudiants'],
            [
                'url' => route('etudiant.show', $etudiant->id),
                'label' => $etudiant->first_name . ' ' . $etudiant->last_name,
            ],
            ['url' => route('parents.index'), 'label' => 'Parents'],
            ['label' => 'Ajouter un parent'],
        ]" />
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Ajouter un parent </h4>
                        <p class="card-category"> Informations sur le parent </p>
                        @include('components.shared.alert')
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $parent->id ? route('parents.update', $parent->id) : route('parents.store') }}">
                            @csrf
                            @if ($parent->id)
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $parent->user_id }}">
                            @else
                                <input type="hidden" name="etudiant_id" value="{{ $etudiant->id }}">
                            @endif
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="first_name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ old('first_name', $parent->first_name) }}">
                                        @error('first_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="last_name" class="bmd-label-floating">Prénom</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ old('last_name', $parent->last_name) }}">
                                        @error('last_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group  bmd-form-group">
                                        <label for="email" class="bmd-label-floating">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="phone" class="bmd-label-floating">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone', $parent->phone) }}" placeholder="(+225) 77 12 45 67 55">
                                        @error('phone')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="address" class="bmd-label-floating">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address', $parent->address) }}"
                                            placeholder="Rue, Ville, Pays...">
                                        @error('address')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="profession" class="bmd-label-floating">Profession</label>
                                        <input type="text" class="form-control" id="profession" name="profession"
                                            value="{{ old('profession', $parent->profession) }}"
                                            placeholder="Enseignant, Médecin, Commerçant...">
                                        @error('profession')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="type" class="bmd-label-floating">Type de parent</label>
                                        <input type="text" class="form-control" id="type" name="type"
                                            value="{{ old('type', $parent->type) }}" placeholder="Père, Mère, Tuteur...">
                                        @error('type')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" role="switch"
                                                class="js-switch form-check-input"id="is_tutor_legal"
                                                name="is_tutor_legal" {{ $parent->is_tutor_legal == 1 ? 'checked' : '' }}>
                                            <label class="form-check label" for="is_tutor_legal">Tuteur légal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-primary pull-right w-100">
                                {{ $parent->id ? 'Modifier' : 'Ajouter' }} </button>
                            <a href="{{ route('parents.index') }}" class=" mt-1 btn btn-outline-danger pull-right"> Annuler </a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
