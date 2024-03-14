@extends('layouts.app')


@section('title', $appointmentEtudiant->id ? 'Modifier emmargement' : 'Nouvelle emmargement')

@section('content')

    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('appointment.index') }}">Emmargements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $appointmentEtudiant->id ? 'Modifier emmargement' : 'Nouvelle emmargement' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('components.shared.alert')
                <div class="card-header">{{ $appointmentEtudiant->id ? 'Modifier emmargement' : 'Nouvelle emmargement' }}
                </div>
                <div class="card-body">
                    <form action="{{ route('appointment.etudiants.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointmentEtudiant->appointment_id }}">

                        <div class="row">
                            <div class="col-md-12  mb-3">
                                <div class="form-group bmd-form-group">
                                    <label for="etudiant_ids" class="bmd-label-floating">Selectionnez les etudiants</label>
                                    <select name="etudiant_ids[]" id="etudiant_ids"
                                        class="form-control @error('etudiant_ids') is-invalid @enderror" multiple required>
                                        @foreach ($etudiants as $etudiant)
                                            <option value="{{ $etudiant->id }}"
                                                @if (in_array($etudiant->id, old('etudiant_ids', []))) selected @endif>
                                                {{ $etudiant->first_name }} {{ $etudiant->last_name }} -
                                                {{ $etudiant->student_mat }} </option>
                                        @endforeach
                                    </select>
                                    @error('etudiant_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{-- precisez si les etudiants selectionnez sont présent ou absent --}}
                                <div class="form-group bmd-form-group">
                                    <label for="selected_are_present" class="bmd-label-floating">Status</label>
                                    <select name="selected_are_present" id="selected_are_present"
                                        class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="true">Present</option>
                                        <option value="false">Absent</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-primary w-100">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#etudiant_ids').select2({
                placeholder: "Selectionnez les etudiants",
                allowClear: true,
                multiple: true,
            });

            $('#selected_are_present').select2({
                placeholder: "Selectionnez le status",
                allowClear: true,
                multiple: false,
            });
        });
    </script>
@endpush
