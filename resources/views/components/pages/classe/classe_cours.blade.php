@extends('layouts.app')

@section('title', $classeCours->id ? 'Modifier cours' : 'Ajouter cours')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('classe.index') }}">Classe</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $classeCours->id ? 'Modifier cours' : 'Ajouter cours' }}</li>
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
                        <h4 class="card-title mt-0">{{ $classeCours->id ? 'Modifier cours' : 'Ajouter cours' }}</h4>
                        <p class="card-category">
                            {{ $classeCours->id ? 'Modifier les informations du cours' : 'Ajouter les informations du cours' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $classeCours->id ? route('classe.updateClasseCours', ['classeCours' => $classeCours->id,]) : route('classe.storeClasseCours', ['classe'=>$classeCours->classe_id]) }}"
                            id="form">
                            @csrf
                            @if ($classeCours->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$classeCours->id}}">
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="classe_id" class="bmd-label-floating">Classe</label>
                                        <select name="classe_id" id="classe_id" class="form-control">
                                                <option value="{{ $classeCours->classe_id }}" selected>
                                                    {{ $classeCours->classe->name }}
                                                </option>
                                        </select>
                                        @error('classe_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="cours_id" class="bmd-label-floating">Cours</label>
                                        <select name="cours_id" id="cours_id" class="form-control">
                                            @foreach ($cours as $cours)
                                                <option value="{{ $cours->id }}"
                                                    {{ $classeCours->cours_id === $cours->id ? 'selected' : '' }}>
                                                    {{ $cours->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('cours_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="professor_id" class="bmd-label-floating">Professeur</label>
                                        <select name="professor_id" id="professor_id" class="form-control">
                                            @foreach ($professors as $professor)
                                                <option value="{{ $professor->id }}"
                                                    {{ $classeCours->professor_id === $professor->id ? 'selected' : '' }}>
                                                    {{ $professor->first_name }} {{ $professor->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('professor_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="semester" class="bmd-label-floating">Semestre</label>
                                        <select name="semester" id="semester" class="form-control">
                                            <option value="1" {{ $classeCours->semester === 1 ? 'selected' : '' }}>1
                                            </option>
                                            <option value="2" {{ $classeCours->semester === 2 ? 'selected' : '' }}>2
                                            </option>
                                        </select>
                                        @error('semester')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="start_date" class="bmd-label-floating">Date de début</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            value="{{ old('start_date', $classeCours->start_date) }}"
                                            placeholder="Date de début">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="end_date" class="bmd-label-floating">Date de fin</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            value="{{ old('end_date', $classeCours->end_date) }}"
                                            placeholder="Date de fin">
                                        @error('end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="is_available" class="bmd-label-floating">Disponibilité</label>
                                        <select name="is_available" id="is_available" class="form-control">
                                            <option value="1"
                                                {{ $classeCours->is_available === 1 ? 'selected' : '' }}>Disponible
                                            </option>
                                            <option value="0"
                                                {{ $classeCours->is_available === 0 ? 'selected' : '' }}>Non disponible
                                            </option>
                                        </select>
                                        @error('is_available')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="is_done" class="bmd-label-floating">Statut</label>
                                        <select name="is_done" id="is_done" class="form-control">
                                            <option value="1" {{ $classeCours->is_done === 1 ? 'selected' : '' }}>
                                                Terminé</option>
                                            <option value="0" {{ $classeCours->is_done === 0 ? 'selected' : '' }}>En
                                                cours ou pas encore commencé</option>
                                        </select>
                                        @error('is_done')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                {{-- trois col pour les 3 derniers --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="credit" class="bmd-label-floating">Crédit</label>
                                        <input type="number" class="form-control" id="credit" name="credit"
                                            value="{{ old('credit', $classeCours->credit) }}" placeholder="Crédit">
                                        @error('credit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="total_hours" class="bmd-label-floating">Heures</label>
                                        <input type="number" class="form-control" id="total_hours" name="total_hours"
                                            value="{{ old('total_hours', $classeCours->total_hours) }}"
                                            placeholder="Entrez l'heure total du cours">
                                        @error('total_hours')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-send-plane-2-fill pr-2"></i>
                                        {{ $classeCours->id ? 'Modifier' : 'Ajouter' }}
                                    </button>
                                    <a href="{{ route('classe.index') }}" class="btn btn-danger">
                                        <i class="ri-arrow-go-back-fill pr-2"></i>
                                        Retour
                                    </a>
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
        $(document).ready(function() {
            $('#form').submit(function() {
                $(this).find(':input[type=submit]').prop('disabled', true);
            });

            //select2
            $('#classe_id').select2({
                placeholder: "Selectionner une classe",
                allowClear: true
            });
            $('#cours_id').select2({
                placeholder: "Selectionner un cours",
                allowClear: true
            });
            $('#professor_id').select2({
                placeholder: "Selectionner un professeur",
                allowClear: true
            });
            $('#semester').select2({
                placeholder: "Selectionner un semestre",
                allowClear: true
            });
            $('#is_available').select2({
                placeholder: "Selectionner la disponibilité",
                allowClear: true
            });
            $('#is_done').select2({
                placeholder: "Selectionner le statut",
                allowClear: true
            });
        });
    </script>
@endpush
