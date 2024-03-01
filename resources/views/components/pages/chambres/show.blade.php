@extends('layouts.app')


@section('title', 'Details de la chambre')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('chambres.index') }}">Chambres</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details de la chambre</li>
                </ol>
            </nav> 
        </div>
    </div>
    {{-- end bread --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Details de la chambre</h4>
                        <p class="card-category">Details de la chambre</p>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('chambres.edit', $chambre->id) }}" class="btn btn-primary float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier la chambre</a>
                            </div>
                        </div>
                    </div>
                                            {{-- 'number','type','status','cite_id','is_occupied','location','capacity' --}}
                    <div class="card-body">
                       <p class="text-muted">ID: {{ $chambre->id }}</p>
                          <p class="text-muted text-capitalize">Numéro de chambre: {{ $chambre->number }}</p>
                            <p class="text-muted text-capitalize">Type de chambre: {{ $chambre->type }}</p>
                            <p> <span class="text-muted">Citée de la chambre: </span> {{ $chambre->cite->name }}</p>
                            <p> <span class="text-muted">Capacité: </span> {{ $chambre->capacity }}</p>
                            <p> <span class="text-muted">Localisation: </span> {{ $chambre->location }}</p>
                            <p> <span class="text-muted">Status: </span> {{ $chambre->status }}</p>
                            <p>
                                <span class="text-muted">Places disponibles: </span>
                                {{ $chambre->capacity - $chambre->occupants()->count() }}
                                <hr class="divider my-3">
                                @if ($chambre->occupants()->count() === $chambre->capacity / 2)
                                    <span class="badge bg-warning text-dark"> Moitié remplie</span>
                                @elseif ($chambre->occupants()->count() === $chambre->capacity)
                                    <span class="badge bg-danger"> Remplie</span>
                                @endif
                            </p>
                            <p>
                                <span class="text-muted">Nombre d'occupants: </span>
                                {{ $chambre->is_occupied ? $chambre->occupants()->count() : 0 }}
                            </p>
                            @if ($chambre->occupants()->count() > 0)
                                <p class="text-muted mb-3">Occupants</p>
                                <ul>
                                    @foreach ($chambre->occupants() as $citeInscription)
                                        <li>
                                            <a href="{{ route('etudiant.show', $citeInscription->etudiant_id) }}">
                                                {{ $citeInscription->etudiant->first_name }} {{ $citeInscription->etudiant->last_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#chambres').addClass('active');
        });
    </script>
@endsection

