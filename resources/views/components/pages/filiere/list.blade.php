@extends('layouts.app')

@section('title', 'Liste des filières')

@section('content')
{{-- 'name',
        'description',
        'image',
        'status',
        'annee_scolaire', --}}
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Filières</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Liste des filières </h4>
                        <p class="card-category"> Liste des filières de l'établissement </p>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('filiere.create') }}" class="btn btn-success float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une filière</a>
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
                                        Nom
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    <th>
                                        Année scolaire
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($filieres as $filiere)
                                        <tr>
                                            <td>
                                                {{ $filiere->id }}
                                            </td>
                                            <td>
                                                {{ $filiere->name }}
                                            </td>
                                            <td>
                                                {{ $filiere->description }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($filiere->image ?? 'images/filieres/filiere.png') }}" alt="image" width="100">
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-id="{{ $filiere->id }}" role="switch" class="js-switch form-check-input" {{ $filiere->status == 1 ? 'checked' : '' }} style="color: #26c6da;" onclick="toggleStatus({{ $filiere->id }})"/>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $filiere->annee_scolaire }}
                                            </td>
                                            <td>
                                                <a href="{{ route('filiere.show', $filiere->id) }}" class="btn btn-info">
                                                    <i class="ri-eye-line"></i>
                                                    </a>
                                                <a href="{{ route('filiere.edit', $filiere->id) }}" class="btn btn-warning">
                                                    <i class="ri-pencil-line"></i>
                                                    </a>
                                                <form action="{{ route('filiere.destroy', $filiere->id) }}" method="POST"
                                                    style="display: inline-block" id="deleteForm-{{ $filiere->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete({{ $filiere->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Aucune filière disponible
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
        function confirmDelete(id) {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer cette filière?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            })
        }

        function toggleStatus(id) {

            $.ajax({
                url: `api/changeFiliere-state/${id}`,
                type: 'PUT',
                success: function (data) {
                    console.log(data);
                }
            });
        }

    </script>



@endpush
