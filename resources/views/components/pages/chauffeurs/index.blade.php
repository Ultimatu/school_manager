@extends('layouts.app')


@section('title', 'Liste des chauffeurs')



@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chauffeurs</li>
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
                        <h4 class="card-title mt-0">Liste des chauffeurs</h4>
                        <p class="card-category">Liste des chauffeurs enregistrés</p>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('chauffeurs.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter un chauffeur</a>
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
                                        Image
                                    </th>
                                    <th>
                                        Nom
                                    </th>
                                    <th>
                                        Prénom
                                    </th>
                                    <th>
                                        Téléphone
                                    </th>
                                    <th>
                                        Adresse
                                    </th>
                                    <th>
                                        Voiture
                                    </th>
                                    <th>
                                        Trajet
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($chauffeurs as $chauffeur)
                                        <tr>
                                            <td>
                                                {{ $chauffeur->id }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($chauffeur->avatar ?? "users/avatar.png") }}" width="140" alt="" height="140" class="">
                                            </td>
                                            <td>
                                                {{ $chauffeur->first_name }}
                                            </td>
                                            <td>
                                                {{ $chauffeur->last_name }}
                                            </td>
                                            <td>
                                                {{ $chauffeur->address }}
                                            </td>
                                            <td>
                                                {{ $chauffeur->phone }}
                                            </td>
                                            <td>
                                                {{ $chauffeur->car->matricule  }}
                                            </td>
                                            <td>
                                                {{ $chauffeur->trajet->name }}
                                            </td>
                                            <td class="text-center gap-2 d-flex justify-content-between">
                                                <a href="{{ route('chauffeurs.show', $chauffeur->id) }}"
                                                    class="btn btn-primary  btn-sm mb-3">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('chauffeurs.edit', $chauffeur->id) }}"
                                                    class="btn btn-ouline-edit  btn-sm mb-3">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <form action="{{ route('chauffeurs.destroy', $chauffeur->id) }}"
                                                    method="post" id="deleteForm-{{ $chauffeur->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-outline-danger  btn-sm"
                                                        onclick="confirmDelete({{ $chauffeur->id }})">
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
        function confirmDelete(chauffeurId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + chauffeurId).submit();
                }
            })
        }
    </script>
@endpush
