@extends('layouts.app')

@section('title', $etudiant->id ? 'Modifier etudiant' : 'Ajouter etudiant')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('etudiant.index') }}">Etudiants</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $etudiant->id ? 'Modifier' : 'Ajouter' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">{{ $etudiant->id ? 'Modifier etudiant' : 'Ajouter etudiant' }}</h4>
                        <p class="card-category">
                            {{ $etudiant->id ? 'Modifier les informations de l\'etudiant' : 'Ajouter les informations de l\'etudiant' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $etudiant->id ? route('etudiant.update', $etudiant->id) : route('etudiant.store') }}"
                            id="form" enctype="multipart/form-data" data-parsley-validate id="form">
                            @csrf
                            @if ($etudiant->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $etudiant->id }}">
                            @endif
                            <div class="wizard-demo" id="wizard">
                                <h2>Informations personnelles</h2>
                                {{-- field for this are : first, last, email, phone, gender, address, avatar, annee_scolaire, nationality --}}
                                <section id="1-step">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="first_name" class="bmd-label-floating">Nom</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name"
                                                    value="{{ old('first_name', $etudiant->first_name) }}"
                                                    placeholder="Nom de l'étudiant" required pattern="^[a-zA-Z]+$"
                                                    min="3">
                                                @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="last_name" class="bmd-label-floating">Prénom</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                    value="{{ old('last_name', $etudiant->last_name) }}"
                                                    placeholder="Prénom de l'étudiant">
                                                @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="email" class="bmd-label-floating">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $etudiant->email) }}"
                                                    placeholder="Adresse email de l'étudiant" required min="3">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="phone" class="bmd-label-floating">Téléphone</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone', $etudiant->phone) }}"
                                                    placeholder="Numéro de téléphone de l'étudiant" pattern="^\d{9}$"
                                                    max="9" min="9" required>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{-- nationality, address, avatar --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="nationality" class="bmd-label-floating">Nationalité</label>
                                                    <input type="text" class="form-control" id="nationality"
                                                        name="nationality"
                                                        value="{{ old('nationality', $etudiant->nationality) }}"
                                                        placeholder="Nationalité de l'étudiant" required>
                                                    @error('nationality')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="address" class="bmd-label-floating">Adresse</label>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address" value="{{ old('address', $etudiant->address) }}"
                                                        placeholder="Adresse de l'étudiant" required>
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="avatar" class="bmd-label-floating">Photo</label>
                                                    <input type="file" class="form-control" id="avatar"
                                                        name="avatar" value="{{ old('avatar', $etudiant->avatar) }}"
                                                        placeholder="Photo de l'étudiant">
                                                    @error('avatar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if ($etudiant->avatar)
                                                    <img src="{{ asset($etudiant->avatar) }}" alt="avatar"
                                                        class="img-fluid" width="50">
                                                    Photo de l'étudiant
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="gender" class="bmd-label-floating">Sexe</label>
                                                    <select name="gender" id="gender" required class="form-control">
                                                        <option value="M"
                                                            {{ $etudiant->gender === 'M' ? 'selected' : '' }}>Masculin</option>
                                                        <option value="F"
                                                            {{ $etudiant->gender === 'F' ? 'selected' : '' }}>Féminin</option>
                                                    </select>
                                                    @error('gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h2>Informations académiques</h2>
                                {{-- field for this are : student_mat, classe_id, card_id, birth_date, birth_place, cni --}}
                                <section id="2-step">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="student_mat" class="bmd-label-floating">Matricule</label>
                                                <input type="text" class="form-control" id="student_mat"
                                                    name="student_mat"
                                                    value="{{ old('student_mat', $etudiant->student_mat) }}"
                                                    placeholder="Matricule de l'étudiant" required min="6">
                                                @error('student_mat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="classe_id" class="bmd-label-floating">Classe</label>
                                                <select name="classe_id" id="classe_id" class="form-control" required>
                                                    @foreach ($classes as $classe)
                                                        <option value="{{ $classe->id }}"
                                                            {{ $etudiant->classe_id === $classe->id ? 'selected' : '' }}>
                                                            {{ $classe->name . ' ' . $classe->level }} -
                                                            {{ $classe->filiere->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('classe_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group flex-1">
                                                <label for="cni" class="bmd-label-floating">Carte d'identité
                                                    nationale</label>
                                                <input type="text" class="form-control" id="cni" name="cni"
                                                    value="{{ old('cni', $etudiant->cni) }}"
                                                    placeholder="Numéro de la carte d'identité nationale de l'étudiant">
                                                @error('cni')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="birth_date" class="bmd-label-floating">Date de
                                                    naissance</label>
                                                <input type="date" class="form-control" id="birth_date"
                                                    name="birth_date"
                                                    value="{{ old('birth_date', $etudiant->birth_date) }}"
                                                    placeholder="Date de naissance de l'étudiant">
                                                @error('birth_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="birth_place" class="bmd-label-floating">Lieu de
                                                    naissance</label>
                                                <input type="text" class="form-control" id="birth_place"
                                                    name="birth_place"
                                                    value="{{ old('birth_place', $etudiant->birth_place) }}"
                                                    placeholder="Lieu de naissance de l'étudiant">
                                                @error('birth_place')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3 d-flex justify-content-between">
                                            <div class="form-group bmd-form-group">
                                                <label for="card_id" class="bmd-label-floating">Carte scolaire</label>
                                                <input type="text" class="form-control" id="card_id" name="card_id"
                                                    value="{{ old('card_id', $etudiant->card_id) }}"
                                                    placeholder="Numéro de la carte scolaire de l'étudiant">
                                                @error('card_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3 d-flex justify-content-center align-items-center flex-1">
                                                <button type="button" class="btn btn-primary"
                                                    onclick="generateMatricule()">Générer le matricule</button>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2>Scolarité</h2>
                                {{-- field for this are : amount, is_paid, versement_amount, urgent_phone --}}
                                <section id="3-step">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="amount" class="bmd-label-floating">Montant de la
                                                    scolarité</label>
                                                <input type="number" class="form-control" id="amount" name="amount"
                                                    value="{{ old('amount', $etudiant->scolarite? $etudiant->scolarite->amount : '') }}"
                                                    placeholder="Montant de la scolarité de l'étudiant">
                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="is_paid" class="bmd-label-floating">Statut de
                                                    paiement</label>
                                                <select name="is_paid" id="is_paid" class="form-control">
                                                    <option value="1">Soldé
                                                    </option>
                                                    <option value="0">Non soldé
                                                    </option>
                                                </select>
                                                @error('is_paid')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="versement_amount" class="bmd-label-floating">Montant
                                                    versé</label>
                                                <input type="number" class="form-control" id="versement_amount"
                                                    name="versement_amount" value="{{ old('versement_amount',
                                                        $etudiant->scolarite? $etudiant->scolarite->details->sum('amount') : '') }}"
                                                    placeholder="Montant versé de la scolarité de l'étudiant">
                                                @error('versement_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group bmd-form-group">
                                                <label for="urgent_phone" class="bmd-label-floating">Téléphone
                                                    d'urgence</label>
                                                <input type="text" class="form-control" id="urgent_phone"
                                                    name="urgent_phone"
                                                    value="{{ old('urgent_phone', $etudiant->urgent_phone) }}"
                                                    placeholder="Numéro de téléphone d'urgence de l'étudiant"
                                                    pattern="^\d{9}$" max="9" min="9">
                                                @error('urgent_phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="add_parent" value="true">
                                    </div>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
@endsection
@push('scripts')
    <script>
        //select2
        $(document).ready(function() {
            $('#wizard').steps({
                headerTag: 'h2',
                bodyTag: 'section',
                transitionEffect: 'fade',
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                labels: {
                    finish: '<i class="ri-check-fill"></i>Inscrire!',
                    next: '<i class="ri-arrow-right-s-line"></i> Suivant',
                    previous: '<i class="ri-arrow-left-s-line"></i> Précédent',
                    loading: '<i class="ri-restart-fill animate-spin"></i> Chargement...',
                },
                onFinished: function(event, currentIndex) {
                    document.getElementById('form').submit();
                }

            });
        });

        function validateFirstStep() {
            // {{-- field for this are : first, last, email, phone, gender, address, avatar, annee_scolaire, nationality --}}
            var step1 = $("#1-step").validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 3,
                    },
                    last_name: {
                        required: true,
                        minlength: 3,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        minlength: 9,
                        maxlength: 9,
                    },
                },
                messages: {
                    first_name: {
                        required: "Le nom de l'étudiant est requis",
                        minlength: "Le nom de l'étudiant doit contenir au moins 3 caractères",
                    },
                    last_name: {
                        required: "Le prénom de l'étudiant est requis",
                        minlength: "Le prénom de l'étudiant doit contenir au moins 3 caractères",
                    },
                    email: {
                        required: "L'adresse email de l'étudiant est requise",
                        email: "L'adresse email de l'étudiant doit être valide",
                    },
                    phone: {
                        required: "Le numéro de téléphone de l'étudiant est requis",
                        minlength: "Le numéro de téléphone de l'étudiant doit contenir 9 chiffres",
                        maxlength: "Le numéro de téléphone de l'étudiant doit contenir 9 chiffres",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    return false;
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    return false;
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    return true;
                }

            });
            step1.form();
            return true

        }

        function validateSecondStep() {
            // {{-- field for this are : student_mat, classe_id, card_id, birth_date, birth_place, cni --}}
            $('#2-step').validate({
                rules: {
                    student_mat: {
                        required: true,
                        minlength: 6,
                    },
                    classe_id: {
                        required: true,
                    },
                    card_id: {
                        required: true,
                    },
                    birth_date: {
                        required: true,
                    },
                    birth_place: {
                        required: true,
                    },
                    cni: {
                        required: true,
                    },
                },
                messages: {
                    student_mat: {
                        required: "Le matricule de l'étudiant est requis",
                        minlength: "Le matricule de l'étudiant doit contenir au moins 6 caractères",
                    },
                    classe_id: {
                        required: "La classe de l'étudiant est requise",
                    },
                    card_id: {
                        required: "Le numéro de la carte d'identité de l'étudiant est requis",
                    },
                    birth_date: {
                        required: "La date de naissance de l'étudiant est requise",
                    },
                    birth_place: {
                        required: "Le lieu de naissance de l'étudiant est requis",
                    },
                    cni: {
                        required: "Le numéro de la carte d'identité nationale de l'étudiant est requis",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    return false;
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    return false;
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    return true;
                }
            });
        }

        function validateThirdStep() {
            // {{-- field for this are : amount, is_paid, versement_amount, urgent_phone --}}

            $('#3-step').validate({
                rules: {
                    amount: {
                        required: true,
                    },
                    is_paid: {
                        required: true,
                    },
                    versement_amount: {
                        required: true,
                    },
                    urgent_phone: {
                        required: true,
                        minlength: 9,
                        maxlength: 9,
                    },
                },
                messages: {
                    amount: {
                        required: "Le montant de la scolarité de l'étudiant est requis",
                    },
                    is_paid: {
                        required: "Le statut de paiement de la scolarité de l'étudiant est requis",
                    },
                    versement_amount: {
                        required: "Le montant versé de la scolarité de l'étudiant est requis",
                    },
                    urgent_phone: {
                        required: "Le numéro de téléphone d'urgence de l'étudiant est requis",
                        minlength: "Le numéro de téléphone d'urgence de l'étudiant doit contenir 9 chiffres",
                        maxlength: "Le numéro de téléphone d'urgence de l'étudiant doit contenir 9 chiffres",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    return false;
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    return false;
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    return true;
                }
            });


        }

        function parseData() {
            // {{-- field for this are : first, last, email, phone, gender, address, avatar, annee_scolaire, nationality --}}
            // {{-- field for this are : student_mat, classe_id, card_id, birth_date, birth_place, cni --}}
            // {{-- field for this are : amount, is_paid, versement_amount, urgent_phone --}}
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
        }

        function generateMatricule() {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var birth_date = $('#birth_date').val();
            if (!first_name || !last_name || !birth_date) {
                // Créer un élément span avec le message d'avertissement
                var $alertSpan = $('<span>', {
                    'class': 'text-danger',
                    'text': 'Veuillez remplir toutes les données essentielles avant de continuer.'
                });

                // Ajouter le span après l'élément #card_id
                $('#card_id').after($alertSpan);

                // Supprimer le span après 5 secondes
                setTimeout(function() {
                    $alertSpan.remove();
                }, 5000);
                return;
            }
            //trois premier caractère du nom, 1er caractère du prénom, jour de naissance, mois de naissance, année de naissance + 0001
            var matricule = last_name.substring(0, 3) + first_name.substring(0, 1) + birth_date.substring(8, 10) +
                birth_date.substring(5, 7) + birth_date.substring(2, 4) + '0001';
            $('#card_id').val(matricule.toUpperCase());
        }
    </script>
@endpush
