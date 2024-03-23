@extends('layouts.app')

@section('title', 'Detail classe')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    @if (!auth()->user()->isEtudiant())
                        <li class="breadcrumb-item"><a href="{{ route('classe.index') }}">Classe</a></li>
                    @endif
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
                        @if (auth()->user()->isAdmin() || auth()->user()->isConsellor())
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('classe.edit', $classe->id) }}" class="btn btn-warning float-right">
                                        <i class="ri-pencil-line"></i>
                                        Modifier</a>
                                </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nom & niveau de la classe:</strong> {{ $classe->name }} {{ $classe->level }}</p>
                                <p><strong>Nombre d'étudiants:</strong> {{ $classe->etudiants->count() }}</p>
                                <p><strong>Nombre de cours:</strong> {{ $classe->classeCours->count() }}</p>
                                <p>
                                    <strong>
                                        Nombre de cours terminés:
                                        {{ $classe->classeCours->where('is_done', true)->count() + $classe->classeCours->where('end_date', '<', now())->count() }}
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
        {{-- make  tabs for: liste de cours, liste de classe --}}
        <ul class="nav nav-tabs mt-1">
            <li class="nav-item mb-3">
                <a class="nav-link active" data-toggle="tab" href="#coursList">Liste des cours</a>
            </li>
            <li class="nav-item  mb-3">
                <a class="nav-link" data-toggle="tab" href="#etudiantList">Liste des étudiants</a>
            </li>
            {{-- list de presence --}}
            <li class="nav-item mb-3">
                <a class="nav-link" data-toggle="tab" href="#presenceList">Liste de présence</a>
            </li>
            {{-- end list de presence --}}
            <li class="nav-item mb-3">
                <a class="nav-link" data-toggle="tab"
                    href="{{ route('classe.createEmploi', ['classe' => $classe->id]) }}">Emploi du temps</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade show active" id="coursList">
                {{-- cours --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title mt-0"> Liste des cours </h4>
                                <p class="card-category"> Cours de la classe </p>
                                @if (auth()->user()->isAdmin() || auth()->user()->isConsellor())
                                    <div class="row">
                                        {{-- add cours --}}
                                        <div class="col-md-4 mb-3">
                                            <a href="{{ route('classe.createClasseCours', ['classe' => $classe->id]) }}"
                                                class="btn btn-success float-right">
                                                <i class="ri-add-line"></i>
                                                Ajouter un cours à la classe</a>
                                        </div>
                                        {{-- end add cours --}}
                                    </div>
                                @endif
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
                                            @if (auth()->user()->isAdmin() || auth()->user()->isConsellor())
                                                <th>
                                                    Actions
                                                </th>
                                            @endif
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
                                                        {{ $cours->professeur->first_name }}
                                                        {{ $cours->professeur->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $cours->start_date }}
                                                    </td>
                                                    <td>
                                                        {{ $cours->end_date }}
                                                    </td>
                                                    @if (auth()->user()->isCreator())
                                                        <td>

                                                            <a href="{{ route('classe.editClasseCours', $cours->id) }}"
                                                                class="btn btn-warning mb-3">
                                                                <i class="ri-pencil-line"></i>
                                                                Modifier</a>
                                                            <form
                                                                action="{{ route('classe.destroyClasseCours', $cours->id) }}"
                                                                method="post" class="d-inline mb-3"
                                                                id="deleteForm-{{ $cours->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="deleteItem({{ $cours->id }})"
                                                                    style="color: #fff;">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                    Supprimer</button>
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
                {{-- end cours --}}
            </div>
            <div class="tab-pane fade" id="etudiantList">
                {{-- etudiant --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title mt-0"> Liste des étudiants </h4>
                                <p class="card-category"> Etudiants de la classe </p>
                                @if (auth()->user()->isAdmin() || auth()->user()->isConsellor())
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <a href="{{ route('etudiant.create') }}" class="btn btn-success float-right">
                                                <i class="ri-add-line"></i>
                                                Ajouter un étudiant</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-responsive-sm">
                                        <thead class="">
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
                                                Email
                                            </th>
                                            <th>
                                                Date de naissance
                                            </th>
                                            @if (!auth()->user()->isEtudiant())
                                                <th>
                                                    Actions
                                                </th>
                                            @endif
                                        </thead>
                                        <tbody>
                                            @foreach ($classe->etudiants as $etudiant)
                                                <tr>
                                                    <td>
                                                        {{ $etudiant->student_mat }}
                                                    </td>
                                                    <td>
                                                        {{ $etudiant->first_name }}
                                                    </td>
                                                    <td>
                                                        {{ $etudiant->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $etudiant->email }}
                                                    </td>
                                                    <td>
                                                        {{ $etudiant->birth_date }}
                                                    </td>
                                                    @if (!auth()->user()->isEtudiant())
                                                        <td>
                                                            <a href="{{ route('etudiant.show', $etudiant->id) }}"
                                                                class="btn btn-primary mb-3">
                                                                <i class="ri-eye-line"></i>
                                                                Voir</a>
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
            {{-- end etudiant --}}
            <div class="tab-pane fade" id="presenceList">
                {{-- presence --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">Les listes de présence</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Classes</th>
                                                <th>Cours</th>
                                                <th class="text-right d-flex">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td>{{ $appointment->id }}</td>
                                                    <td>
                                                        <span>
                                                            {{ $appointment->start_date }}&nbsp;{{ $appointment->end_date }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{ $appointment->classe->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{ $appointment->classeCours->cours->name }}
                                                        </span>
                                                    </td>
                                                    <td class="text-right d-flex">
                                                        <a href="{{ route('appointment.show', $appointment->id) }}"
                                                            class="btn btn-sm btn-primary">Voir</a>
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
                {{-- end presence --}}
            </div>
        </div>
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

        $(document).ready(function() {
            $('.nav-tabs a').click(function() {
                $(this).tab('show');
                $("#coursList .tab-pane").tabs({
                    collapsible: true,
                    active: false,
                })
            });

            let hash = window.location.hash;
            if (hash) {
                $('.nav-tabs a[href="' + hash + '"]').tab('show');
            }

        });
    </script>
@endpush
