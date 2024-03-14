@extends('layouts.app')

@section('title', 'Details de la liste de présence')


@section('content')
    {{--breadcrumb--}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Tableau de bord</li>
                    <li class="breadcrumb-item"><a href="{{ route('appointment.index') }}">Emmargements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
    </div>
    {{--end breadcrumb--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('components.shared.alert')
                <div class="card-header">Details de la liste de présence</div>
                <div class="card-body">
                    @if ($appointment->etudiantAppointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointment->etudiantAppointments as $etudiantAppointment)
                                        <tr>
                                            <td>{{ $etudiantAppointment->id }}</td>
                                            <td>
                                                <span>
                                                    {{ $etudiantAppointment->etudiant->first_name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    {{ $etudiantAppointment->etudiant->last_name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="{{ $etudiantAppointment->is_present ? 'text-success' : 'text-danger' }}">
                                                    {{ $etudiantAppointment->is_present ? 'Présent' : 'Absent'}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            l'emmargement n'a pas encore été fait
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('appointment.etudiants.create', ['appointment'=>$appointment->id]) }}" class="btn btn-primary">Faire l'emmargement</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

