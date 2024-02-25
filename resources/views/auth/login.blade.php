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

            <h3 class="card-title">Connexion!</h3>
            <p class="card-text">Bienvenue! Connectez-vous pour continuer s'il vous plaît.</p>
        </div><!-- card-header -->
        <div class="card-body">
            <form action="{{ route('authenticate') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Addresse email</label>
                    <input type="text" class="form-control" placeholder="Entrez votre adresse email" name="email"
                        value="{{ old('email') }}">
                    @error('email')
                       <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label d-flex justify-content-between">Mot de passe <a href="">Mot de passe
                            oublié?</a></label>
                    <input type="password" class="form-control" placeholder="Entrez votre adresse mot de passe" name="password">
                </div>
                <button class="btn btn-primary btn-sign">Connexion</button>
            </form>
            <div class="divider"><span>ou connectez-vous avec</span></div>

            <div class="row gx-2">
                <div class="col"><button class="btn btn-facebook"><i class="ri-facebook-fill"></i> Facebook</button>
                </div>
                <div class="col"><button class="btn btn-google"><i class="ri-google-fill"></i> Google</button></div>
            </div><!-- row -->
        </div><!-- card-body -->
        <div class="card-footer">
            Vous êtes étudiant et vous n'avez pas de compte? <a href="{{ route('register') }}">Faites une demande
                d'inscription</a>
        </div><!-- card-footer -->
    </div><!-- card -->

@endsection
