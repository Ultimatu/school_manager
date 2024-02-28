@extends('layouts.app')


@section('title', $examen->id ? 'Modifier un examen' : 'Ajouter un examen')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('examens.index') }}">Examens</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $examen->id ? 'Modifier' : 'Ajouter' }}</li>
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
                        <h4 class="card-title text-center">{{ $examen->id ? 'Modifier' : 'Ajouter' }} un examen</h4>
                        <p class="card-category">{{ $examen->id ? 'Modifier' : 'Ajouter' }} un examen</p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $examen->id ? route('examens.update', $examen) : route('examens.store') }}"
                            id="form">
                            @csrf
                            @if ($examen->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating" for="classe_cours_id">Classe & Cours</label>
                                        <select name="classe_cours_id" id="classe_cours_id" class="form-control">
                                            @foreach ($classeCours as $cours)
                                                <option value="{{ $cours->cours->id }}"
                                                    {{ $cours->id === $examen->classe_cours_id ? 'selected' : '' }}>
                                                    {{ $cours->cours->name . ' ' . $cours->classe->name . ' ' . $cours->classe->level }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('classe_cours_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="salle_id" class="bmd-label-floating">Salle</label>
                                        <select name="salle_id" id="salle_id" class="form-control">
                                            @foreach ($salles as $salle)
                                                <option value="{{ $salle->id }}"
                                                    {{ $salle->id === $examen->salle_id ? 'selected' : '' }}>
                                                    {{ $salle->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('salle_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="start_date_time" class="bmd-label-floating">Date de début &
                                            heure</label>
                                        <input type="datetime-local" name="start_date_time" id="start_date_time"
                                            class="form-control" value="{{ $examen->start_date_time }}"
                                            min="{{ now()->format('Y-m-d\TH:i') }}">
                                        @error('start_date_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="end_date_time" class="bmd-label-floating">Date de fin &
                                            heure</label>
                                        <input type="datetime-local" name="end_date_time" id="end_date_time"
                                            class="form-control" value="{{ $examen->end_date_time }}"
                                            min="{{ now()->format('Y-m-d\TH:i') }}">
                                        @error('end_date_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <button type="button" class="btn btn-primary pull-right" onclick="submitForm()">
                                        {{ $examen->id ? 'Modifier' : 'Ajouter' }}
                                    </button>
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
        function submitForm() {
            //enlever les seconde sur start_date_time et end_date_time
            $('#start_date_time').val($('#start_date_time').val().slice(0, 16));
            $('#end_date_time').val($('#end_date_time').val().slice(0, 16));
            //maximum 4 heures de difference
            let start = new Date($('#start_date_time').val());
            let end = new Date($('#end_date_time').val());
            let diff = (end - start) / 1000 / 60 / 60;
            let startHour = start.getHours();
            let endHour = end.getHours();
            if (diff > 4) {
                $('#end_date_time').addClass('is-invalid').after(
                    '<span class="invalid-feedback" role="alert"><strong>La durée de l\'examen ne doit pas dépasser 4 heures</strong></span>'
                );
                return;
            } else if (startHour < 8 || startHour > 18 || endHour < 8 || endHour > 18) {
                $('#start_date_time').addClass('is-invalid ').after(
                    '<span class="invalid-feedback" role="alert"><strong>L\'heure de début et de fin de l\'examen doit être entre 08:00 et 18:00</strong></span>'
                );
                $('#end_date_time').addClass('is-invalid').after(
                    '<span class="invalid-feedback" role="alert"><strong>L\'heure de début et de fin de l\'examen doit être entre 08:00 et 18:00</strong></span>'
                );
                return;
            } else {
                $('#form').submit();
            }
        }
        $(document).ready(function() {
            $('#classe_cours_id').select2();
            $('#salle_id').select2();
            $('#form').validate({
                rules: {
                    classe_cours_id: {
                        required: true,
                    },
                    salle_id: {
                        required: true,
                    },
                    start_date_time: {
                        required: true,
                    },
                    end_date_time: {
                        required: true,
                    },
                },
                messages: {
                    classe_cours_id: {
                        required: 'La classe & le cours est obligatoire',
                    },
                    salle_id: {
                        required: 'La salle est obligatoire',
                    },
                    start_date_time: {
                        required: 'La date de début & heure est obligatoire',

                    },
                    end_date_time: {
                        required: 'La date de fin & heure est obligatoire',

                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
