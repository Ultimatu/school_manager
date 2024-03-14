@extends('layouts.app')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('etudiant.index') }}">Etudiants</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $etudiant->first_name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- /bread --}}

    {{-- card --}}
    <div class="row">
        <div class="col-md-12">
            @include('components.shared.alert')
            <div class="card">
                <div class="card-header card-header-primary mb-1 mt-1">
                    {{-- photo as img-thumb --}}
                    <img src="{{ asset($etudiant->avatar ?? 'users/avatar.png') }}" alt="{{ $etudiant->first_name }}"
                        class="img-thumbnail" width="100">
                    {{ $etudiant->first_name }} {{ $etudiant->last_name }}
                    {{-- buttons --}}
                    @if (!auth()->user()->isProfesseur())
                        <div class="float-right d-flex align-items-center justify-content-start gap-2 w-50">
                            {{-- edit --}}
                            <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-warning mb-3">
                                <i class="ri-pencil-line fs-3 text-white "></i>
                                Modifier
                            </a>
                            {{-- delete --}}
                            <form action="{{ route('etudiant.destroy', $etudiant->id) }}" method="post" class="d-inline"
                                id="deleteEtudiant">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger mb-3" onclick="deleteEtudiant()"
                                    style="color: #fff;">
                                    <i class="ri-delete-bin-line fs-3 text-white"></i>
                                    Supprimer {{ $etudiant->first_name }}
                                </button>
                            </form>
                        </div>
                    @endif
                    <!-- Header du tab -->
                    <!-- Ajoutez les liens pour chaque onglet -->
                    <ul class="nav nav-tabs mt-1">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#infos">Informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#parents">Parents</a>
                        </li>
                        @if (!auth()->user()->isProfesseur())
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#scolarite">Scolarité</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <!-- Contenu des onglets -->
                    <div class="tab-content">
                        <!-- Onglet Informations -->
                        <div id="infos" class="tab-pane fade show active">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $etudiant->first_name }}
                                    {{ $etudiant->last_name }}</h5>
                                <p class="card-text">
                                    <strong>Matricule:</strong> {{ $etudiant->student_mat }} <br>
                                    <strong>Sexe:</strong> {{ $etudiant->gender }} <br>
                                    <strong>Date de naissance:</strong> {{ $etudiant->birth_date }} <br>
                                    <strong>Lieu de naissance:</strong> {{ $etudiant->birth_place }} <br>
                                    <strong>Adresse:</strong> {{ $etudiant->address }} <br>
                                    <strong>Numéro de téléphone:</strong> {{ $etudiant->phone }} <br>
                                    <strong>Email:</strong> {{ $etudiant->email }} <br>
                                    <strong>Filière:</strong> {{ $etudiant->classe->filiere->name }} <br>
                                    <strong>Classe:</strong> {{ $etudiant->classe->name }} {{ $etudiant->classe->level }}
                                    <br>
                                    {{-- urgence_phone --}}
                                    <strong>Numéro de téléphone en cas d'urgence:</strong> <span class="badge bg-danger">
                                        {{ $etudiant->urgent_phone }}
                                    </span> <br>
                                    @if (!auth()->user()->isProfesseur())
                                        <p>
                                            Statut: @if ($etudiant->scolarite->amount - $etudiant->versements()->sum('amount') == 0 || $etudiant->scolarite->is_paid == 1)
                                                <span class="badge bg-success">Soldé</span>
                                            @else
                                                <span class="badge bg-danger">Non soldé</span>
                                            @endif
                                        </p>
                                    @endif
                            </div>
                        </div>
                        <!-- Onglet Parents -->
                        <div id="parents" class="tab-pane fade">
                            <div class="card-body">
                                <div class="d-grid mb-3">
                                    {{-- add_parent button --}}
                                    <a href="{{ route('parents.create', ['etudiant' => $etudiant->id]) }}"
                                        class="btn btn-success mb-3">
                                        <i class="ri-user-add-line fs-3 text-white"></i>
                                        Ajouter un parent
                                    </a>
                                </div>
                                {{-- parents --}}
                                <hr>
                                @if ($etudiant->parents->count() > 0)
                                    @foreach ($etudiant->parents as $parent)
                                        <div class="datatable table-responsive">
                                            <table class="table table-bordered table-striped table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nom & Prénom</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Téléphone</th>
                                                        <th scope="col">Adresse</th>
                                                        <th scope="col">Profession</th>
                                                        <th>Type de parent</th>
                                                        @if (!auth()->user()->isProfesseur())
                                                            <th>Actions</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $parent->parent->first_name }} {{ $parent->last_name }}
                                                        </td>
                                                        <td>{{ $parent->parent->email }}</td>
                                                        <td>{{ $parent->parent->phone }}</td>
                                                        <td>{{ $parent->parent->address }}</td>
                                                        <td>{{ $parent->parent->profession }}</td>
                                                        <td>
                                                            <span class="badge bg-warning">
                                                                {{ $parent->parent->type }}
                                                            </span>
                                                        </td>
                                                        @if (!auth()->user()->isProfesseur())
                                                            <td>
                                                                <a href="{{ route('parents.edit', $parent->parent_id) }}"
                                                                    class="btn btn-warning">
                                                                    <i class="ri-pencil-line"></i>
                                                                    Modifier
                                                                </a>
                                                                <form
                                                                    action="{{ route('parents.destroy', $parent->parent_id) }}"
                                                                    method="post" class="d-inline"
                                                                    id="deleteParent-{{ $parent->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="deleteParent({{ $parent->parent_id }})"
                                                                        style="color: #fff;">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                        Supprimer
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Aucun parent enregistré</p>
                                @endif
                            </div>
                        </div>
                        <!-- Onglet Scolarité -->
                        @if (!auth()->user()->isProfesseur())
                            <div id="scolarite" class="tab-pane fade">
                                <!-- Contenu de l'onglet -->
                                <div class="card-body">
                                    {{-- scolarite --}}
                                    <div class="d-grid mb-3">
                                        {{-- ajouter un versement --}}
                                        <a href="{{ route('versement.etudiant.create', ['paymentScolarite' => $etudiant->scolarite->id]) }}"
                                            class="btn btn-info">
                                            <i class="ri-money-dollar-circle-line fs-3 text-white mb-3"></i>
                                            Ajouter un versement
                                        </a>
                                    </div>
                                    <p>
                                        Montant de la scolarité: {{ $etudiant->scolarite->amount }} FCFA
                                    </p>
                                    <p>
                                        Montant payé: {{ $etudiant->versements()->sum('amount') }} FCFA
                                    </p>
                                    <p>
                                        Montant restant:
                                        {{ $etudiant->scolarite->amount - $etudiant->versements()->sum('amount') }} FCFA
                                    </p>
                                    <p>
                                        Statut: @if ($etudiant->scolarite->amount - $etudiant->versements()->sum('amount') == 0 || $etudiant->scolarite->is_paid == true)
                                            <span class="badge bg-success">Soldé</span>
                                        @else
                                            <span class="badge bg-danger">Non soldé</span>
                                        @endif
                                    </p>
                                    {{-- details payments --}}
                                    <div class="datatable table-responsive">
                                        <table class="table table-bordered table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Montant</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Mode de paiement</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($etudiant->versements() as $versement)
                                                    <tr>
                                                        <td>{{ $versement->amount }} FCFA</td>
                                                        <td>{{ $versement->date }}</td>
                                                        <td>
                                                            <span class="badge bg-warning">
                                                                {{ $versement->mode_payement ?? 'Espèce' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('versement.edit', $versement->id) }}"
                                                                class="btn btn-warning">
                                                                <i class="ri-pencil-line"></i>
                                                                Modifier
                                                            </a>
                                                            <form action="{{ route('versement.destroy', $versement->id) }}"
                                                                method="post" class="d-inline"
                                                                id="deleteForm-{{ $versement->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="deleteItem({{ $versement->id }})"
                                                                    style="color: #fff;">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                    Supprimer
                                                                </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">Aucun versement enregistré</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /card --}}
@endsection

@push('scripts')
    <script>
        function deleteItem(itemId) {
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
                    document.getElementById('deleteForm-' + itemId).submit();
                }
            })
        }

        function deleteParent(parentId) {
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
                    document.getElementById('deleteParent-' + parentId).submit();
                }
            })
        }

        function deleteEtudiant() {
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
                    document.getElementById('deleteEtudiant').submit();
                }
            })
        }

        $(document).ready(function() {
            $('.nav-tabs a').click(function() {
                $(this).tab('show');
                $("#infos .tab-pane").tabs({
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
