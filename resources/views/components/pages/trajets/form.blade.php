@php
$waypoints = [
    'Yopougon',
    'Cocody',
    'Abobo',
    'Adjamé',
    'Koumassi',
    'Port-Bouët',
    'Marcory',
    'Treichville',
    'Plateau',
    'Attecoubé',
    'Bingerville',
    'Anyama',
    'Songon',
    'Dabou',
    'Grand-Bassam',
    'Bassam',
];
@endphp

@extends('layouts.app')

@section('title', $trajet->id ? 'Modifier le trajet' : 'Ajouter un trajet')

@section('content')
  {{-- bread --}}
  <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('trajets.index') }}">Trajets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $trajet->id ? 'Modifier le trajet' : 'Ajouter un trajet' }}</li>
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
                        <h4 class="card-title mt-0">{{ $trajet->id ? 'Modifier le trajet' : 'Ajouter un trajet' }}</h4>
                        <p class="card-category">{{ $trajet->id ? 'Modifier le trajet' : 'Ajouter un trajet' }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ $trajet->id ? route('trajets.update', $trajet) : route('trajets.store') }}">
                            @csrf
                            @if ($trajet->id)
                                @method('PUT')
                            @endif
                              {{--  'name',
                    'waypoints',
                    'city_departure_time',
                    'school_departure_time', --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="name" class="bmd-label-floating">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $trajet->name) }}">
                                    </div>
                                    @error('name')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="waypoints" class="bmd-label-floating">Points de passage</label>
                                        <select class="form-control" id="waypoints" name="waypoints[]" multiple>
                                            @foreach ($waypoints as $waypoint)
                                                <option value="{{ $waypoint }}" {{ in_array($waypoint, old('waypoints', $trajet->waypoints ?? [])) ? 'selected' : '' }}>{{ $waypoint }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('waypoints')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="city_departure_time" class="bmd-label-floating">Heure de ramassage</label>
                                        <input type="time" class="form-control" id="city_departure_time" name="city_departure_time" value="{{ old('city_departure_time', $trajet->city_departure_time) }}">
                                    </div>
                                    @error('city_departure_time')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="school_departure_time" class="bmd-label-floating">Heure de départ de l'école</label>
                                        <input type="time" class="form-control" id="school_departure_time" name="school_departure_time" value="{{ old('school_departure_time', $trajet->school_departure_time) }}">
                                    </div>
                                    @error('school_departure_time')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success w-100 mt-1">{{ $trajet->id ? 'Modifier' : 'Ajouter' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#waypoints').select2({
                placeholder: 'Sélectionnez ou ajoutez des points de passage',
                tags: true,
                tokenSeparators: [',', ' '],
                multiple: true,
                //permettre de créer des tags
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true // add additional parameters
                    }
                }
            });
        });
    </script>
@endpush






