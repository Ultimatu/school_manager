@extends('layouts.app')

@section('title', 'Liste des professeurs')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Professeurs</li>
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
                        <h4 class="card-title mt-0"> Liste des professeurs </h4>
                        @if (!auth()->user()->isEtudiant())
                            <p class="card-category"> Liste des professeurs de l'établissement </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('professeur.create') }}" class="btn btn-success float-right">
                                        <i class="ri-add-line"></i>
                                        Ajouter un professeur</a>
                                </div>
                            </div>
                        @else
                            <p class="card-category"> Liste de vos professeurs </p>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Photo
                                    </th>
                                    <th>
                                        Matricule
                                    </th>
                                    <th>
                                        Nom
                                    </th>
                                    <th>
                                        Prénom
                                    </th>
                                    <th>
                                        Genre
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Téléphone
                                    </th>
                                    <th>
                                        Spécialités
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    @if (!auth()->user()->isEtudiant())
                                        <th>
                                            Actions
                                        </th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($professeurs as $prof)
                                        <tr>
                                            <td>
                                                {{ $prof->id }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($prof->avatar ?? 'administrations/avatar.png') }}"
                                                    alt="photo de {{ $prof->first_name }}" class="img-fluid"
                                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                            </td>
                                            <td>
                                                {{ $prof->matricule }}
                                            </td>
                                            <td>
                                                {{ $prof->first_name }}
                                            </td>
                                            <td>
                                                {{ $prof->last_name }}
                                            </td>
                                            <td>
                                                {{ $prof->gender }}
                                            </td>
                                            <td>
                                                {{ $prof->email }}
                                            </td>
                                            <td>
                                                {{ $prof->phone }}
                                            </td>
                                            <td>
                                                {{ $prof->specialities }}
                                            </td>
                                            <td>
                                                @if ($prof->is_available === '1')
                                                    <span class="badge bg-success">Disponible</span>
                                                @else
                                                    <span class="badge bg-danger">Indisponible</span>
                                                @endif
                                            </td>
                                            @if (!auth()->user()->isEtudiant())
                                                <td class="td-actions d-flex justify-content-between gap-2">
                                                    <a href="{{ route('professeur.show', $prof->id) }}"
                                                        class="btn btn-info">
                                                        <i class="ri-eye-line"></i></a>
                                                    <a href="{{ route('professeur.edit', $prof->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="ri-pencil-line "></i></a>
                                                    <form action="{{ route('professeur.destroy', $prof->id) }}"
                                                        method="post" class="d-inline"
                                                        id="deleteForm-{{ $prof->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="deleteItem({{ $prof->id }})">
                                                            <i class="ri-delete-bin-line "></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
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
        function deleteItem(id) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            })
        }
    </script>
@endpush
