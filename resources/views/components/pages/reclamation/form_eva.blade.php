@extends('layouts.app')


@section('title', $reclamation->id ? 'Modifier une réclamation' : 'Ajouter une réclamation')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reclamations.index') }}">Réclamations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $reclamation->id ? 'Modifier' : 'Ajouter' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end breadcrumb --}}

    {{-- content --}}
    

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center">{{ $reclamation->id ? 'Modifier' : 'Ajouter' }} une réclamation</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $reclamation->id ? route('reclamations.update', $reclamation->id) : route('reclamations.store') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @if ($reclamation->id)
                                @method('put')
                            @endif
                            <input type="hidden" name="etudiant_id" value="{{ $reclamation->etudiant_id }}">
                            <input type="hidden" name="evaluation_id" value="{{ $reclamation->evaluation_id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="objet" class="bmd-label-floating">Objet</label>
                                        <input type="text" name="objet" id="objet"
                                            class="form-control @error('objet') is-invalid @enderror"
                                            value="{{ old('objet', $reclamation->objet) }}">
                                        @error('objet')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="date" class="bmd-label-floating">Date</label>
                                        <input type="date" name="date" id="date"
                                            class="form-control @error('date') is-invalid @enderror"
                                            value="{{ old('date', $reclamation->date) }}" min="{{ now() }}">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="message" class="bmd-label-floating">Message</label>
                                        <textarea name="message" id="message"
                                            class="form-control @error('message') is-invalid @enderror"
                                            rows="5">{{ old('message', $reclamation->message) }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- file: piece jointe --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="file" class="bmd-label-floating">Piece jointe</label>
                                        <input type="file" name="file" id="file"
                                            class="form-control @error('file') is-invalid @enderror">
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">{{ $reclamation->id ? 'Modifier' : 'Ajouter' }}</button>
                                    <a href="{{ route('reclamations.index') }}" class="btn btn-secondary">Annuler</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
@endsection


