@extends('layouts.app')

@section('title', 'Liste des cours')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cours</li>
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
                        <h4 class="card-title mt-0">Liste des cours</h4>
                        <p class="card-category">Liste des cours enregistrés</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('cours.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter un cours</a>
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
                                        Description
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
                                    @forelse ($cours as $cours)
                                        <tr>
                                            <td>
                                                {{ $cours->id }}
                                            </td>
                                            <td>
                                                <img src="{{ asset( $cours->image ?? 'images/filieres/filiere.png') }}" alt="{{ $cours->name }}"
                                                    class="img-thumbnail" width="100">
                                            </td>
                                            <td>
                                                {{ $cours->name }}
                                            </td>
                                            <td>
                                                {{ $cours->description }}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-id="{{ $cours->id }}" role="switch" class="js-switch form-check-input" {{ $cours->is_available == 1 ? 'checked' : '' }} style="color: #26c6da;" onclick="toggleStatus({{ $cours->id }})"/>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $cours->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                {{ $cours->updated_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="td-actions text-right d-flex justify-content-end gap-2">
                                                <a href="{{ route('cours.edit', $cours->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <form action="{{ route('cours.destroy', $cours->id) }}" method="POST"
                                                    class="d-inline" id="delete-form-{{ $cours->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteCours({{ $cours->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucun cours enregistré</td>
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
        function deleteCours(coursId) {
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
                    document.getElementById('delete-form-' + coursId).submit();
                }
            })
        }

        function toggleStatus(coursId) {
            $.ajax({
                url: `api/changeCours-state/${coursId}`,
                type: "PUT",
                success: function(response) {
                    console.log(response);
                }
            });
        }



    </script>
@endpush
