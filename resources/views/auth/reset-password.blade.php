@extends('layouts.auth')

@section('title', 'Page de connexion')

@section('content')

    <div class="card card-sign">
        <div class="card-header">
            <a href="../" class="header-logo mb-4">UTA</a>
            {{-- ask if user is parent and lead to parent_login.blade.php --}}
            {{-- <div class="d-flex justify-content-between">
                <a href="{{ route('login') }}" class="btn btn-primary">Se connecter en tant que parent</a>
            </div> --}}

            <h3 class="card-title">Réinitialisation de mot passe!</h3>
            <p class="card-text">Bienvenue! Veuillez entrez votre email svp.</p>
        </div><!-- card-header -->
        <div class="card-body">
            @if ($step === 1)
                <form action="{{ route('passowrd.send-reset-link') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Addresse email</label>
                        <input type="text" class="form-control" placeholder="Entrez votre adresse email" name="email"
                            value="{{ old('email') }}">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-sign">Envoyer le lien de réinitialisation</button>
                </form>
            @elseif($step === 2)
                <form action="{{ route('passowrd.reset-action') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    {{-- email, password, password_confirmation --}}
                    <div class="mb-4">
                        <label class="form-label d-flex justify-content-between">Mot de passe <a href="{{ route('passowrd.forgot') }}">Mot de passe
                                oublié?</a></label>
                        <input type="password" class="form-control" placeholder="Entrez votre adresse mot de passe" name="password">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label d-flex justify-content-between">Confirmer mot de passe</label>
                        <input type="password" class="form-control" placeholder="Confirmer votre adresse mot de passe"
                            name="password_confirmation">
                        @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-sign">Réinitialiser</button>
                    <hr class="divider my-4">

                    {{--display trottle timeout --}}

                </form>
            @else
                <div class="alert alert-danger">
                    <p>Le lien de réinitialisation est invalide ou expiré.</p>
                </div>
            @endif

        </div><!-- card-body -->
        <div class="card-footer">
            je me rappelle? <a href="{{ route('login') }}">se connecter </a>
        </div><!-- card-footer -->
    </div><!-- card -->

@endsection
