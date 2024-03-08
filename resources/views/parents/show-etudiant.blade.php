@extends('layouts.app-parent')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('parent-students') }}">Etudiants</a></li>
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
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('parent-etudiant-emploi', $etudiant->id) }}" class="btn btn-info">Voir l'emploi du
                            temps</a>
                    </div>
                    <!-- Ajoutez les liens pour chaque onglet -->
                    <ul class="nav nav-tabs mt-1">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#infos">Informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#parents">Parents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#scolarite">Scolarité</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#professeur">Professeurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#notes">Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#presence">Liste de présence</a>
                        </li>
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
                                <p>
                                    Statut: @if ($etudiant->scolarite->amount - $etudiant->versements()->sum('amount') == 0 || $etudiant->scolarite->is_paid == true)
                                        <span class="badge bg-success">Soldé</span>
                                    @else
                                        <span class="badge bg-danger">Non soldé</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <!-- Onglet Parents -->
                        <div id="parents" class="tab-pane fade">
                            <div class="card-body">
                                {{-- parents --}}
                                <hr>
                                @if ($etudiant->parents->count() > 0)
                                    @foreach ($etudiant->parents as $parent)
                                        <div class="datatable table">
                                            <table class="table table-bordered table-striped table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nom & Prénom</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Téléphone</th>
                                                        <th scope="col">Adresse</th>
                                                        <th scope="col">Profession</th>
                                                        <th>Type de parent</th>
                                                        <th>Actions</th>
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
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- Onglet Scolarité -->
                        <div id="scolarite" class="tab-pane fade">
                            <!-- Contenu de l'onglet -->
                            <div class="card-body">
                                {{-- scolarite --}}
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
                                <div class="datatable">
                                    <table class="table table-bordered table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <th scope="col">Montant</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Mode de paiement</th>
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
                        <div id="professeur" class="tab-pane fade">
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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="notes" class="tab-pane fade">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive table-striped dataTable">
                                        <thead class="">
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Cours
                                            </th>
                                            <th>
                                                Evaluation
                                            </th>
                                            <th>
                                                Note
                                            </th>
                                            <th>
                                                Observation
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                        </thead>
                                        <tbody>
                                            @forelse ($etudiant->notes as $note)
                                                <tr>
                                                    <td>
                                                        {{ $note->id }}
                                                    </td>
                                                    <td>
                                                        {{ $note->evaluation->classeCours->cours->name }}
                                                    </td>
                                                    <td>
                                                        {{ $note->evaluation->sujet }}
                                                    </td>
                                                    <td class="btn btn-danger">
                                                        {{ $note->note }}/ {{ $note->evaluation->max_note }}
                                                    </td>
                                                    <td>
                                                        {{ $note->observation }}
                                                    </td>
                                                    <td>
                                                        {{ $note->evaluation->date }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        Aucune note enregistrée
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="presence" class="tab-pane fade">
                            <div class="alert alert-info">
                                Liste de presence en cours de construction
                            </div>
                        </div>
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
