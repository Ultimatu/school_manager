@extends('layouts.app')


@section('title', $examenNote->id ? 'Modifier une note' : 'Ajouter une note')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('examens.index') }}">Examens</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('examens.show', $examenNote->examen_id) }}">Détails de l'examen</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $examenNote->id ? 'Modifier' : 'Ajouter' }}</li>
                </ol>
            </nav>
        </div>

    </div>

    {{-- content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title" style="text-align: center;">{{ $examenNote->id ? 'Modifier' : 'Ajouter' }} une note</h4>
                        <p class="card-category">{{ $examenNote->id ? 'Modifier' : 'Ajouter' }} une note</p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $examenNote->id ? route('examens.notes.update', ['examen'=>$examenNote->examen_id, 'examenNote'=>$examenNote]) : route('examens.notes.store', ['examen'=>$examenNote->examen_id]) }}"
                            id="form">
                            @csrf
                            @if ($examenNote->id)
                                @method('PUT')
                            @endif
                            <input type="hidden" name="examen_id" value="{{ $examenNote->examen_id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating" for="etudiant_id">Etudiant</label>
                                        <select name="etudiant_id" id="etudiant_id" class="form-control">
                                            @foreach ($etudiants as $etudiant)
                                                <option value="{{ $etudiant->id }}"
                                                    {{ $etudiant->id === $examenNote->etudiant_id ? 'selected' : '' }}>
                                                    {{ $etudiant->first_name . ' ' . $etudiant->last_name . ' '.$etudiant->student_mat }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('etudiant_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating" for="note">Note</label>
                                        <input type="number" name="note" id="note" class="form-control"
                                            value="{{ old('note', $examenNote->note) }}">
                                        @error('note')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
