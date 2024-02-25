@extends('layouts.app')

@section('title', 'Classe')

@section('content')
{{-- bread --}}
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">Classe</li>
            </ol>
        </nav>
    </div>
</div>
{{-- end bread --}}
    <div class="container-fluid">
        @include('components.shared.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Classe </h4>
                        <p class="card-category"> Liste des classes </p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('classe.create') }}" class="btn btn-success float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une classe</a>
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
                                        Statut
                                    </th>
                                    <th>
                                        Niveau
                                    </th>
                                    <th>
                                        Année
                                    </th>
                                    <th>
                                        Filière
                                    </th>
                                    <th>
                                        Crédits
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $classe)
                                        <tr>
                                            <td>
                                                {{ $classe->id }}
                                            </td>
                                            <td>
                                                {{ $classe->name }}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-id="{{ $classe->id }}" role="switch" class="js-switch form-check-input" {{ $classe->status == 1 ? 'checked' : '' }} style="color: #26c6da;" onclick="toggleStatus({{ $classe->id }})"/>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $classe->level }}
                                            </td>
                                            <td>
                                                {{ $classe->year }}
                                            </td>
                                            <td>
                                                {{ $classe->filiere->name }}
                                            </td>
                                            <td>
                                                {{ $classe->credits }}
                                            </td>
                                            <td class="fs-2">
                                                <a href="{{ route('classe.show', $classe->id) }}"
                                                    class="btn btn-info btn-sm fs-2">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('classe.edit', $classe->id) }}"
                                                    class="btn btn-warning btn-sm fs-2">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <form action="{{ route('classe.destroy', $classe->id) }}" method="post"
                                                    class="d-inline " id="delete-form-{{ $classe->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm fs-2"
                                                        onclick="deleteConfirmation({{ $classe->id }})">
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
        function deleteConfirmation(classeId) {
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
                    document.getElementById('delete-form-' + classeId).submit();
                }
            })
        }

        function toggleStatus(classeId) {
            $.ajax({
                url: `api/changeClasse-state/${classeId}`,
                type: "PUT",
                success: function(response) {
                    console.log(response);
                }
            });
        }



    </script>
@endpush
