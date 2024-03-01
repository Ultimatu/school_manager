@extends('layouts.app')


@section('title', 'Details de la salle')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('salle.index') }}">Salle</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $salle->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- content --}}
    {{-- 'name',
        'capacity',
        'is_available',
        'capacity',
        'type',
        'location', --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Details de la salle</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>Nom:</strong> {{ $salle->name }}
                        </p>
                        <p>
                            <strong>Capacité:</strong> {{ $salle->capacity }}
                        </p>
                        <p>
                            <strong>Statut:</strong> {{ $salle->is_available ? 'Disponible' : 'Indisponible' }}
                        </p>
                        <p>
                            <strong>Type:</strong> {{ $salle->type }}
                        </p>
                        <p>
                            <strong>Localisation:</strong> {{ $salle->location }}
                        </p>
                        <hr>
                        <h1>Details des réservations (Emploi du temps)</h1>
                        <div class="datatable bg-info">
                            <table class="table table-hover table-responsive" id="myTable">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Date de début
                                    </th>
                                    <th>
                                        Date de fin
                                    </th>
                                    <th>
                                        Classe
                                    </th>
                                    <th>
                                        Cours
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($salle->emploiDuTemps as $emploi)
                                        <tr>
                                            <td>
                                                {{ $emploi->id }}
                                            </td>
                                            <td>
                                                {{ $emploi->start_date_time }}
                                            </td>
                                            <td>
                                                {{ $emploi->end_date_time }}
                                            </td>
                                            <td>
                                                <a href="{{ route('classe.show', $emploi->classe->id) }}"
                                                    class="text-primary" title="Voir les détails de la classe">
                                                    {{ $emploi->classe->name }}
                                                </a>
                                            </td>
                                            <td>

                                                {{ $emploi->classeCours->cours->name }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                Aucune réservation enregistrée
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
