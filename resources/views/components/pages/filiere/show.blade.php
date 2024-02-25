@extends('layouts.app')


@section('title', 'Detail filière')

@section('content')

    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('filiere.index') }}">Filières</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détail filière</li>
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
                        <h4 class="card-title mt-0"> Détail filière </h4>
                        <p class="card-category"> Informations sur la filière </p>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('filiere.edit', $filiere->id) }}" class="btn btn-warning float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nom:</strong> {{ $filiere->name }}</p>
                                <p><strong>Description:</strong> {{ $filiere->description }}</p>
                                <p><strong>Image:</strong> <img
                                        src="{{ asset($filiere->image ?? 'administration/avatar.png') }}" alt="photo"
                                        width="100"></p>
                                <p><strong>Statut:</strong> {{ $filiere->status === '1' ? 'Actif' : 'Inactif' }}</p>
                                <p><strong>Année scolaire:</strong> {{ $filiere->annee_scolaire }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Créé le:</strong> {{ $filiere->created_at->format('d/m/Y') }}</p>
                                <p><strong>Modifié le:</strong> {{ $filiere->updated_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- classe appartenant à la filiere --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Classes de la filière </h4>
                        <p class="card-category"> Liste des classes de la filière </p>
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
                                        Niveau
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    <th>
                                        Créé le
                                    </th>
                                    <th>
                                        Modifié le
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($filiere->classes as $classe)
                                        <tr>
                                            <td>
                                                {{ $classe->id }}
                                            </td>
                                            <td>
                                                {{ $classe->name }}
                                            </td>
                                            <td>
                                                {{ $classe->level }}
                                            </td>
                                            <td>
                                                {{ $classe->status === '1' ? 'Actif' : 'Inactif' }}
                                            </td>
                                            <td>
                                                {{ $classe->created_at->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                {{ $classe->updated_at->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('classe.show', $classe->id) }}" class="btn btn-info">
                                                    <i class="ri-eye-line"></i>
                                                    Voir</a>
                                                <a href="{{ route('classe.edit', $classe->id) }}" class="btn btn-warning">
                                                    <i class="ri-pencil-line"></i>
                                                    Modifier</a>
                                                <form action="{{ route('classe.destroy', $classe->id) }}" method="post"
                                                    style="display: inline-block" id="deleteForm-{{ $classe->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deleteItem({{ $classe->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                        Supprimer</button>
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
        function deleteItem(id) {
            let form = document.getElementById('deleteForm-' + id);
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6a6a6a',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
