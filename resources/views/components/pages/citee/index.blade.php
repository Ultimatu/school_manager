@extends('layouts.app')


@section('title', 'Liste des bâtiments')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bâtiments</li>
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
                        <h4 class="card-title mt-0">Liste des bâtiments</h4>
                        <p class="card-category">Liste des bâtiments enregistrés</p>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('cites.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter un bâtiment</a>
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
                                        Type
                                    </th>
                                    <th>
                                        Adresse
                                    </th>
                                    <th>
                                        Capacité
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($cites as $cite)
                                        <tr>
                                            <td>
                                                {{ $cite->id }}
                                            </td>
                                            <td>
                                                {{ $cite->name }}
                                            </td>
                                            <td>
                                                {{ $cite->type }}
                                            </td>
                                            <td>
                                                {{ $cite->address }}
                                            </td>
                                            <td>
                                                {{ $cite->capacity }}
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $cite->status == 'active' ? 'success' : 'danger' }}">{{ $cite->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('cites.show', $cite->id) }}" class="btn btn-info btn-sm mb-3">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('cites.edit', $cite->id) }}" class="btn btn-warning btn-sm mb-3">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <form action="{{ route('cites.destroy', $cite->id) }}" method="post" class="d-inline" id="deleteForm-{{ $cite->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm mb-3" onclick="deleteItem({{ $cite->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                Aucun bâtiment enregistré
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



