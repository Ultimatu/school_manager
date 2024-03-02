@extends('layouts.app')


@section('title', 'Liste des voitures')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Voitures</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}
    {{--  'matricule',
        'marque',
        'model',
        'type',
        'status' --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Liste des voitures</h4>
                        <p class="card-category">Liste des voitures enregistrées</p>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('cars.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une voiture</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Matricule
                                    </th>
                                    <th>
                                        Marque
                                    </th>
                                    <th>
                                        Model
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    <th>
                                        Date de création
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                        <tr>
                                            <td>
                                                {{ $car->id }}
                                            </td>
                                            <td>
                                                {{ $car->matricule }}
                                            </td>
                                            <td>
                                                {{ $car->marque }}
                                            </td>
                                            <td>
                                                {{ $car->model }}
                                            </td>
                                            <td>
                                                {{ $car->type }}
                                            </td>
                                            <td>
                                                @if ($car->status)
                                                    <span class="badge bg-success">Disponible</span>
                                                @else
                                                    <span class="badge bg-danger">Indisponible</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $car->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                {{ $car->updated_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <form action="{{ route('cars.destroy', $car->id) }}" method="post"
                                                    class="d-inline" id="delete-form-{{ $car->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" onclick="deleteItem({{ $car->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
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


@push('scripts')
    <script>
        function deleteItem(itemId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#26c6da',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>
@endpush