@extends('layouts.app')

@section('title', 'Liste des salles')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Salles</li>
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
                        <h4 class="card-title mt-0">Liste des salles</h4>
                        <p class="card-category">Liste des salles enregistrées</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('salle.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une salle</a>
                            </div>
                        </div>
                    </div>
                    {{-- 'name',
        'capacity',
        'is_available',
        'capacity',
        'type',
        'location', --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nom
                                    </th>
                                    <th>
                                        Capacitée
                                    </th>
                                    <th>
                                        Emplacement
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    <th>
                                        Date de création
                                    </th>
                                    <th>
                                        Date de modification
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($salles as $salle)
                                        <tr>
                                            <td>
                                                {{ $salle->id }}
                                            </td>
                                            <td>
                                                {{ $salle->name }}
                                            </td>
                                            <td>
                                                {{ $salle->capacity }}
                                           </td>
                                            <td>
                                                {{ $salle->location }}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-id="{{ $salle->id }}" role="switch" class="js-switch form-check-input" {{ $salle->is_available == 1 ? 'checked' : '' }} style="color: #26c6da;" onclick="toggleStatus({{ $salle->id }})"/>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $salle->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                {{ $salle->updated_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('salle.show', $salle->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="ri-eye-line fs-2"></i>
                                                </a>
                                                <a href="{{ route('salle.edit', $salle->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="ri-pencil-line fs-2"></i>
                                                </a>
                                                <form action="{{ route('salle.destroy', $salle->id) }}" method="POST"
                                                    class="d-inline" id="delete-form-{{ $salle->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteSalle({{ $salle->id }})">
                                                        <i class="ri-delete-bin-line fs-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucune salle enregistrée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        function deleteSalle(salleId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + salleId).submit();
                }
            })
        }

        function toggleStatus(salleId) {
            $.ajax({
                url: `api/changeSalle-state/${salleId}`,
                type: "PUT",
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
@endpush
