@extends('layouts.app')

@section('title', 'Details de la liste de présence')


@section('content')
    {{-- breadcrumb --}}
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
    {{-- end breadcrumb --}}
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
                                        @if (auth()->user()->isProfesseur())
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointment->etudiantAppointments as $etudiantAppointment)
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
                                                <span data-id="{{ $etudiantAppointment->id }}"
                                                    class="badge bg-{{ $etudiantAppointment->is_present ? 'success' : 'danger' }} rounded-pill">
                                                    {{ $etudiantAppointment->is_present ? 'Présent' : 'Absent' }}
                                                </span>
                                            </td>
                                            @if (auth()->user()->isProfesseur())
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" data-id="{{ $etudiantAppointment->id }}"
                                                            role="switch" class="js-switch form-check-input"
                                                            {{ $etudiantAppointment->is_present == 1 ? 'checked' : '' }}
                                                            style="color: #26c6da;"
                                                            onclick="toggleStatus({{ $etudiantAppointment->id }})" />
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            l'emmargement n'a pas encore été fait
                        </div>
                        @if (auth()->user()->isProfesseur())
                            <div class="d-grid">
                                <a href="{{ route('appointment.etudiants.create', ['appointment' => $appointment->id]) }}"
                                    class="btn btn-primary">Faire l'emmargement</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleStatus(id) {
            $.ajax({
                url: "{{ route('api.appointmentEtudiant.change-state') }}",
                type: "PUT",
                data: {
                    appointment_id: id,
                },
                success: function(response) {
                    //change the text of the span
                    console.log(response);
                    //change the color of the span and the text
                    if (response.is_present) {
                        $(`span[data-id=${id}]`).removeClass('text-danger').addClass('text-success').text(
                            'Présent');
                    } else {
                        $(`span[data-id=${id}]`).removeClass('text-success').addClass('text-danger').text(
                            'Absent');
                    }

                }
            });
        }
    </script>
@endpush
