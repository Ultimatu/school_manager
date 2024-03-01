@extends('layouts.app')


@section('title', 'Details du bâtiments')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cites.index') }}">Bâtiments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $cite->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}
    {{-- end bread --}}
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Details du bâtiments</h4>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('cites.edit', $cite->id) }}" class="btn btn-primary float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier le bâtiment</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Details du bâtiment enregistré</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Nom</td>
                                                <td>{{ $cite->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Statut</td>
                                                <td>
                                                    @if ($cite->status == 'disponible')
                                                        <span class="badge bg-success">Actif</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactif</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Capacité</td>
                                                <td>{{ $cite->capacity }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="ri-file-list-3-line"></i>
                                                    Description</td>
                                                <td>{{ $cite->description }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="ri-checkbox-blank-circle-line"></i>
                                                    Type</td>
                                                <td>{{ $cite->type }}</td>
                                            </tr>
                                            <tr>
                                                <td> <i class="ri-map-pin-line"></i>
                                                    Adresse</td>
                                                <td>{{ $cite->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="ri-home-4-line"></i>
                                                    Nombres de chambres
                                                </td>
                                                <td>
                                                    {{ $cite->chambres->count() }}
                                                </td>
                                                <td>
                                                    <i class="ri-home-4-line"></i>
                                                    Nombre de chambre occupées
                                                </td>
                                                <td>
                                                    {{ $cite->chambres->where('is_occupied', true)->count() }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5 class="card-title mt-0">Liste des chambres</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Numéro</th>
                                                <th>Statut</th>
                                                <th>Occupant</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cite->chambres as $chambre)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $chambre->numero }}</td>
                                                    <td>
                                                        @if ($chambre->is_occupied)
                                                            <span class="badge bg-danger">Occupée</span>
                                                        @else
                                                            <span class="badge bg-success">Disponible</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($chambre->is_occupied)
                                                            {{ $chambre->occupant->name }}
                                                        @else
                                                            <span class="badge bg-success">Disponible</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('chambres.show', $chambre->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="ri-eye-line"></i>
                                                            Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Aucune chambre enregistrée</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5 class="card-title mt-0">Liste des résidents</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom</th>
                                                <th>Chambre</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cite->citeInscriptions as $resident)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $resident->etudiant->first_name }}
                                                        {{ $resident->etudiant->last_name }}
                                                    <td>
                                                        @if ($resident->etudiant->chambre)
                                                            {{ $resident->etudiant->chambre->chambre->numero }}
                                                        @else
                                                            <span class="badge bg-danger">Non attribuée</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('residents.show', $resident->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="ri-eye-line"></i>
                                                            Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Aucun résident enregistré</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end card body --}}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script></script>
@endsection
