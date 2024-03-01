@extends('layouts.app')

@section('title', 'Liste des chambres')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chambres</li>
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
                        <h4 class="card-title mt-0">Liste des chambres</h4>
                        <p class="card-category">Liste des chambres enregistrées</p>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('chambres.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une chambre</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- 'number','type','status','cite_id','is_occupied','location','capacity' --}}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Numéro de chambre
                                    </th>
                                    <th>
                                        Type de chambre
                                    </th>
                                    <th>
                                        Citée de la chambre
                                    </th>
                                    <th>
                                        Capacité
                                    </th>
                                    <th>
                                        Localisation
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Statut d'occupation
                                    </th>
                                    <th>
                                        Date de création
                                    </th>

                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($chambres as $chambre)
                                        <tr>
                                            <td>
                                                {{ $chambre->id }}
                                            </td>
                                            <td>
                                                {{ $chambre->number }}
                                            </td>
                                            <td>
                                                {{ $chambre->type }}
                                            </td>
                                            <td>
                                                {{ $chambre->cite->name }}
                                            </td>
                                            <td>
                                                {{ $chambre->capacity }}
                                            </td>
                                            <td>
                                                {{ $chambre->location }}
                                            </td>
                                            <td>
                                                {{ $chambre->status }}
                                            </td>
                                            <td>
                                                @if ($chambre->is_occupied)
                                                    <span class="badge bg-danger">Occupée</span>
                                                @else
                                                    <span class="badge bg-success">Disponible</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $chambre->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="text-center gap-2 d-flex justify-content-between">
                                                <a href="{{ route('chambres.show', $chambre->id) }}"
                                                    class="btn btn-primary mb-3">
                                                    <i class="ri-eye-line"></i>
                                                    Voir</a>
                                                <a href="{{ route('chambres.edit', $chambre->id) }}"
                                                    class="btn btn-outline-edit mb-3">
                                                    <i class="ri-pencil-line"></i>
                                                    Modifier</a>
                                                <form action="{{ route('chambres.destroy', $chambre->id) }}" method="post"
                                                    id="deleteForm-{{ $chambre->id }}" class="mb-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-outline-danger"
                                                        onclick="confirmDelete({{ $chambre->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                        Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                Aucune chambre enregistrée
                                            </td>
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
        function confirmDelete(id){
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer cette chambre?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-'+id).submit()
                }
            })
        }
    </script>
@endpush
