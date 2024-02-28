@extends('layouts.app')


@section('title', 'Ajouter un événement')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('evenements.index') }}">Evénements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un événement</li>
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
                        <h4 class="card-title text-center">Ajouter un événement</h4>
                        <p class="card-category">Ajouter un événement au calendrier</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ $event->id? route('evenements.update', $event->id) : route('evenements.store') }}" method="POST">
                            @csrf
                            @if ($event->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="titre" class="form-label">Titre</label>
                                        <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $event->titre) }}" required>
                                        @error('titre')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select name="type" id="type" class="form-select" required>
                                            <option value="meeting" {{ $event->type == 'meeting' ? 'selected' : '' }}>Réunion</option>
                                            <option value="conference" {{ $event->type == 'conference' ? 'selected' : '' }}>Conférence</option>
                                            <option value="soutenance" {{ $event->type == 'soutenance' ? 'selected' : '' }}>Soutenance</option>
                                        </select>
                                        @error('type')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="date_heure_debut" class="form-label">Date de début</label>
                                        <input type="datetime-local" name="date_heure_debut" id="date_heure_debut" class="form-control" value="{{ old('date_heure_debut', $event->date_heure_debut) }}" min="{{ date('Y-m-d\TH:i') }}" required>
                                        @error('date_heure_debut')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="date_time_fin" class="form-label">Date de fin</label>
                                        <input type="datetime-local" name="date_time_fin" id="date_time_fin" class="form-control" value="{{ old('date_time_fin', $event->date_time_fin) }}" min="{{ date('Y-m-d\TH:i') }}" required>
                                        @error('date_time_fin')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="send_to_all" data-id="{{ $event->id }}"
                                            role="switch" class="js-switch form-check-input"
                                            {{ $event->send_to_all === 1 ? 'checked' : '' }}
                                            style="color: #26c6da;">
                                        <label for="send_to_all" class="form-label">
                                            Pour tous (etudiants, administrations, profs)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="only_for_profs" data-id="{{ $event->id }}"
                                            role="switch" class="js-switch form-check-input"
                                            {{ $event->only_for_profs === 1 ? 'checked' : '' }}
                                            style="color: #26c6da;">
                                        <label for="only_for_profs" class="form-label">
                                            Uniquement pour les profs
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="only_for_admins" data-id="{{ $event->id }}"
                                            role="switch" class="js-switch form-check-input"
                                            {{ $event->only_for_admins === 1 ? 'checked' : '' }}
                                            style="color: #26c6da;">
                                        <label for="only_for_admins" class="form-label">
                                            Seulement pour l'administration
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-1">
                                {{$event->id? 'Modifier': 'Enregistrer'}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    $('#type').select2();
</script>

@endpush



