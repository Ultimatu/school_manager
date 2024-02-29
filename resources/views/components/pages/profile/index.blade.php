@extends('layouts.app')


@section('title', 'Profile')
@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}
    @include('components.shared.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary mb-1 mt-1">
                    <ul class="nav nav-tabs mt-1">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#infos"><i class="fas fa-info-circle"></i>
                                Information Generale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#edits">
                                <i class="fas fa-edit"></i>
                                Modifier les informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#secure">
                                <i class="fas fa-lock"></i>Securité</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show " id="edits">
                            <div class="card-body">
                                @include('components.shared.profile-edit')
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="secure">
                            <div class="card-body">
                                @include('components.shared.profile-secure')
                            </div>
                        </div>
                        <div class="tab-pane show active" id="infos">
                            <div class="card-body">
                                @include('components.shared.profile-info')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // generate password
        let gender = $('#gender')
        if (gender.length) {
            gender.select2({
                placeholder: "Selectionnez le genre",
                allowClear: true,
            })
        }
        let genPass = $('#generatePassword');
        if (genPass.length) {
            genPass.on('click', generatePassword)

        }

        function generatePassword() {
            Swal.fire({
                title: "Veuillez entrer la longueur du mot de passe, de 8 à 16 caractères",
                input: "number",
                inputAttributes: {
                    min: 8,
                    max: 16,
                    step: 1,
                },
                showCancelButton: true,
                confirmButtonText: "Générer",
                showLoaderOnConfirm: true,
                preConfirm: (length) => {
                    password = generateRandomPassword(length);
                    return password;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    //display the generated password and copy button
                    Swal.fire({
                        title: "Mot de passe généré",
                        html: `<input type="text" value="${result.value}" id="generatedPassword" class="form-control" readonly>
                        <button class="btn btn-outline-primary mt-3" onclick="copyPassword()"><i class="ri-file-copy-2-line"></i> Copier</button>`,
                    });
                }
            });
        }

        function generateRandomPassword(length = 8) {
            var uppercaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
            var numberChars = "0123456789";
            var specialChars = "!@#$%^&*()-_+=[]{}|;:,.<>?";

            var allChars = uppercaseChars + lowercaseChars + numberChars + specialChars;

            var password = "";
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * allChars.length);
                password += allChars.charAt(randomIndex);
            }

            return password;
        }

        function copyPassword() {
            const generatedPassword = document.getElementById("generatedPassword");
            generatedPassword.select();
            navigator.clipboard.writeText(generatedPassword.value);
            $('#password').val(generatedPassword.value);
            $('#password_confirmation').val(generatedPassword.value);
            Swal.fire({
                title: "Mot de passe copié",
                icon: "success",
            });
        }

        $(document).ready(function() {
            let hash = window.location.hash;
            if (hash) {
                $('.nav-tabs a[href="' + hash + '"]').tab('show');
            }

            $('.nav-tabs a').click(function() {
                $(this).tab('show');
            });
        });
    </script>
@endpush
