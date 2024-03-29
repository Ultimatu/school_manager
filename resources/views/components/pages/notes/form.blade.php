@extends('layouts.app')


@section('title', $notes->id ? 'Modifier la note' : 'Ajouter une note')

@section('content')
  {{-- bread --}}
  <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">Notes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $notes->id ? 'Modifier la note' : 'Ajouter une note' }}</li>
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
                        <h4 class="card-title mt-0">{{ $notes->id ? 'Modifier la note' : 'Ajouter une note' }}</h4>
                        <p class="card-category">{{ $notes->id ? 'Modifier la note' : 'Ajouter une note' }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ $notes->id ? route('notes.update', $notes) : route('notes.store') }}">
                            @csrf
                            @if ($notes->id)
                                @method('PUT')
                            @endif
                            <input type="text" name="evaluation_id" value="{{ $notes->evaluation_id }}" hidden>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="etudiant_id" class="bmd-label-floating">Etudiant</label>
                                        <select name="etudiant_id" id="etudiant_id" class="form-control">
                                            @foreach ($etudiants as $etudiant)
                                                <option value="{{ $etudiant->id }}" {{ $notes->etudiant_id == $etudiant->id ? 'selected' : '' }}>{{ $etudiant->student_mat }} - {{ $etudiant->first_name. " ". $etudiant->last_name }} </option>
                                            @endforeach
                                        </select>
                                        @error('etudiant_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="note" class="bmd-label-floating">Note</label>
                                        <input type="text" class="form-control" id="note" name="note" value="{{ old('note', $notes->note) }}">
                                        @error('note')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="observation" class="bmd-label-floating">Observation</label>
                                        <input type="text" class="form-control" id="observation" name="observation" value="{{ old('observation', $notes->observation) }}">
                                        @error('observation')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success w-100 mt-1">{{ $notes->id ? 'Modifier' : 'Ajouter' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



