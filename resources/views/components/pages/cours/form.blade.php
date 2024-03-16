@extends('layouts.app')

@section('title', $cours->id ? 'Modifier cours' : 'Ajouter cours')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">Cours</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $cours->id ? 'Modifier cours' : 'Ajouter cours' }}</li>
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
                        <h4 class="card-title mt-0">{{ $cours->id ? 'Modifier cours' : 'Ajouter cours' }}</h4>
                        <p class="card-category">
                            {{ $cours->id ? 'Modifier les informations du cours' : 'Ajouter les informations du cours' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $cours->id ? route('cours.update', $cours->id) : route('cours.store') }}" id="form">
                            @csrf
                            @if ($cours->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$cours->id}}">
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $cours->name) }}" placeholder="Nom du cours">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="is_available" class="bmd-label-floating">Statut</label>
                                        <select name="is_available" id="is_available" class="form-control">
                                            {{-- <option value="0" {{ $cours->is_available === 0 ? 'selected' : '' }}>Inactif
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
                                {{-- description et avatar --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="description" class="bmd-label-floating">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="5"
                                            class="form-control">{{ old('description', $cours->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="image" class="bmd-label-floating">image</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($cours->id)
                                        <img src="{{ asset( $cours->image ?? 'images/filieres/filiere.png') }}" alt="{{ $cours->name }}"
                                            class="img-thumbnail" width="100">
                                        <h2>
                                            Image actuelle
                                        </h2>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3 d-flex justify-content-around">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line"></i>
                                        {{ $cours->id ? 'Modifier' : 'Ajouter' }}</button>
                                    <a href="{{ route('cours.index') }}" class="btn btn-danger">
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
    });
</script>

@endpush




