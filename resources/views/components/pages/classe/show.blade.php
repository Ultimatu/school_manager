@extends('layouts.app')

@section('title', 'Detail classe')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('classe.index') }}">Classe</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détail classe</li>
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
                        <h4 class="card-title mt-0"> Détail classe </h4>
                        <p class="card-category"> Informations sur la classe </p>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('classe.edit', $classe->id) }}" class="btn btn-warning float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier</a>
                            </div>
                            {{-- add cours --}}
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('classe.createClasseCours', ['classe'=>$classe->id]) }}" class="btn btn-success float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter un cours à la classe</a>
                            </div>
                            {{-- end add cours --}}
                            {{-- show emploi du temps --}}
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('classe.createEmploi', ['classe'=>$classe->id]) }}" class="btn btn-info float-right">
                                    <i class="ri-calendar-todo-line"></i>
                                    Emploi du temps</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nom & niveau de la classe:</strong> {{ $classe->name }}  {{ $classe->level}}</p>
                                <p><strong>Nombre d'étudiants:</strong> {{ $classe->etudiants->count() }}</p>
                                <p><strong>Nombre de cours:</strong> {{ $classe->classeCours->count() }}</p>
                                <p>
                                    <strong>
                                        Nombre de cours terminés:
                                        {{ $classe->classeCours->where('is_done', true)->count() + $classe->classeCours->where('end_date', '<', now())->count()}}
                                    </strong>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Créé le:</strong> {{ $classe->created_at->format('d/m/Y') }}</p>
                                <p><strong>Modifié le:</strong> {{ $classe->updated_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- cours --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Liste des cours </h4>
                        <p class="card-category"> Cours de la classe </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-responsive-sm">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nom
                                    </th>
                                    <th>
                                        Professeur
                                    </th>
                                    <th>
                                        Date de début
                                    </th>
                                    <th>
                                        Date de fin
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($classe->classeCours as $cours)
                                        <tr>
                                            <td>
                                                {{ $cours->id }}
                                            </td>
                                            <td>
                                                {{ $cours->cours->name }}
                                            </td>
                                            <td>
                                                {{ $cours->professeur->first_name }}  {{ $cours->professeur->last_name }}
                                            </td>
                                            <td>
                                                {{ $cours->start_date }}
                                            </td>
                                            <td>
                                                {{ $cours->end_date }}
                                            </td>
                                            <td>
                                                <a href="{{ route('classe.editClasseCours', $cours->id) }}" class="btn btn-warning mb-3">
                                                    <i class="ri-pencil-line"></i>
                                                    Modifier</a>
                                                <form action="{{ route('classe.destroyClasseCours', $cours->id) }}" method="post" class="d-inline mb-3" id="deleteForm-{{ $cours->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" onclick="deleteItem({{ $cours->id }})" style="color: #fff;">
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
        {{-- end cours --}}
    </div>
@endsection

@push('scripts')

<script>
    function deleteItem(id) {
        let form = document.getElementById('deleteForm-' + id);
        swal({
            title: "Êtes-vous sûr?",
            text: "Une fois supprimé, vous ne pourrez pas récupérer ce cours!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    }

</script>

@endpush
