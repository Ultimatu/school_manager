@extends('layouts.app')


@section('title', 'Détails de la voiture')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cars.index') }}">Voitures</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Détails de la voiture</h4>
                        <p class="card-category">Détails de la voiture enregistrée</p>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier</a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <form action="{{ route('cars.destroy', $car->id) }}" method="post" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger float-left" onclick="confirmDelete()">
                                        <i class="ri-delete-bin-line"></i>
                                        Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Détails de la voiture enregistrée</p>
                        <p>Matricule: <strong>{{ $car->matricule }}</strong></p>
                        <p>Marque: <strong>{{ $car->marque }}</strong></p>
                        <p>Model: <strong>{{ $car->model }}</strong></p>
                        <p>Type: <strong>{{ $car->type }}</strong></p>
                        @if ($car->status == 'disponible')
                            <p>Statut: <strong><span class="badge bg-success">{{ $car->status }}</span></strong></p>
                        @else
                            <p>Statut: <strong><span class="badge bg-danger">{{ $car->status }}</span></strong></p>
                        @endif
                        @if ($car->chauffeur)
                          <p class="text-muted">Chauffeur</p>
                        <p>Nom & prenom: <strong>
                            <a href="{{ route('chauffeurs.show', $car->chauffeur->id) }}">
                                {{ $car->chauffeur->first_name }} {{ $car->chauffeur->last_name }}
                            </a>
                            </strong></p>
                        @endif
                        <p>Date de création: <strong>{{ $car->created_at->format('d/m/Y H:i') }}</strong></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer cette voiture?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            })
        }
    </script>
@endpush