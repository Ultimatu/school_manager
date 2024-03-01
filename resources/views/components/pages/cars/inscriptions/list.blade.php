@extends('layouts.app')


@section('title', 'Liste des inscriptions aux services de transport')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inscriptions</li>
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
                        <h4 class="card-title mt-0">Liste des inscriptions aux services de transport</h4>
                        <p class="card-category">Liste des inscriptions aux services de transport enregistrées</p>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('car_inscriptions.create') }}" class="btn btn-outline-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une inscription</a>
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
                                        Etudiant
                                    </th>
                                    <th>
                                        Trajet
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($inscriptions as $inscription)
                                        <tr>
                                            <td>
                                                {{ $inscription->id }}
                                            </td>
                                            <td>
                                                <a href="{{ route('etudiants.show', $inscription->etudiant->id) }}">
                                                    {{ $inscription->etudiant->first_name }}
                                                    {{ $inscription->etudiant->last_name }}</a>
                                            </td>
                                            <td>
                                                {{ $inscription->trajet->name }}
                                            </td>
                                            <td>
                                                @if ($inscription->is_paid)
                                                    <span class="badge bg-success">Payé</span>
                                                @else
                                                    <span class="badge bg-danger">Non payé</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('car_inscriptions.edit', $inscription->id) }}"
                                                    class="btn btn-warning btn-sm mb-3">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <a href="{{ route('car_inscriptions.show', $inscription->id) }}"
                                                    class="btn btn-info btn-sm mb-3">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <form action="{{ route('car_inscriptions.destroy', $inscription->id) }}"
                                                    method="post" class="d-inline mb-3"
                                                    id="deleteForm-{{ $inscription->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteItem({{ $inscription->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                Aucune inscription enregistrée
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
