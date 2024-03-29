@extends('layouts.auth')

@section('title', 'Page de connexion')

@section('content')

    <div class="card card-sign">
        @if (isset($displayAlert))
            @include('components.shared.alert')
        @endif
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
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" placeholder="Entrez votre adresse email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label d-flex justify-content-between">Mot de passe <a href="{{ route('passowrd.forgot') }}">Mot de passe oublié?</a></label>
                    <input type="password" class="form-control" placeholder="Entrez votre adresse mot de passe" name="password">
                </div>
                {{-- remmber me token --}}
                <div class="mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" value="true">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                </div>
                <button class="btn btn-primary btn-sign">Connexion</button>
            </form>

        </div><!-- card-body -->
    </div><!-- card -->
@endsection
