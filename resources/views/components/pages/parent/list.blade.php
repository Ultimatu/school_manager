@extends('layouts.app')


@section('title', 'Liste des parents')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Parents</li>
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
                        <h4 class="card-title mt-0">Liste des parents</h4>
                        <p class="card-category">Liste des parents enregistrés</p>
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
                                        Prénom
                                    </th>
                                    <th>
                                        Type de parent
                                    </th>
                                    <th>
                                        Nombre d'enfants
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Téléphone
                                    </th>
                                    <th>
                                        Adresse
                                    </th>
                                    <th>
                                        Profession
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($parents as $parent)
                                        <tr>
                                            <td>
                                                {{ $parent->id }}
                                            </td>
                                            <td>
                                                {{ $parent->first_name }}
                                            </td>
                                            <td>
                                                {{ $parent->lastname }}
                                            </td>
                                            <td>
                                                {{ $parent->type }}
                                            </td>
                                            <td>
                                                {{ $parent->etudiants()->count() }}
                                            </td>
                                            <td>
                                                {{ $parent->email }}
                                            </td>
                                            <td>
                                                {{ $parent->phone }}
                                            </td>
                                            <td>
                                                {{ $parent->adress }}
                                            </td>
                                            <td>
                                                {{ $parent->profession }}
                                            </td>
                                            <td>
                                                <a href="{{ route('parents.show', $parent) }}" class="btn btn-info">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('parents.edit', $parent) }}" class="btn btn-warning">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <form action="{{ route('parents.destroy', $parent) }}" method="post"
                                                    class="d-inline" id="delete-form-{{ $parent->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deleteParent({{ $parent->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($parents->count() == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                Aucun parent enregistré
                                            </td>
                                        </tr>
                                    @endif
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
        function deleteParent(id) {
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
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endpush


