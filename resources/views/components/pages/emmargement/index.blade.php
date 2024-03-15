@extends('layouts.app')


@section('title', 'Liste des émargements')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Tableau de bord</li>
                    <li class="breadcrumb-item active" aria-current="page">Emmargements</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end breadcrumb --}}

    <div class="row">
        <div class="col-12">
            @include('components.shared.alert')
            <div class="card">
                <div class="card-header">Les listes de classe</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Classes</th>
                                    <th>Cours</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                dd()
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>
                                            <span>
                                                {{ $appointment->start_date }}&nbsp;{{ $appointment->end_date }}
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                {{ $appointment->classe->name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                {{ $appointment->classeCours->cours->name }}
                                            </span>
                                        </td>
                                        <td class="text-right d-flex gap-2 my-2">
                                            <a href="{{ route('appointment.show', $appointment->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="ri-eye-line"></i> Voir</a>
                                            </a>
                                            @if (auth()->user()->isProfesseur())
                                                <form action="{{ route('appointment.destroy', $appointment->id) }}"
                                                    method="post" id="delete-appointment-{{ $appointment->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="deleteData({{ $appointment->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                        Supprimer</button>
                                                </form>
                                            @endif
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
@endsection

@push('scripts')
    <script>
        function deleteData(id) {
            Swal.fire({
                title: 'Etes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-appointment-' + id).submit();
                }
            })
        }
    </script>
@endpush
