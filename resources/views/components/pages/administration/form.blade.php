@extends('layouts.app')

@section('title', $administration->id ? 'Modifier administrateur' : 'Ajouter administrateur')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">
                            {{ $administration->id ? 'Modifier administrateur' : 'Ajouter administrateur' }}</h4>
                        <p class="card-category">
                            {{ $administration->id ? 'Modifier les informations de l\'administrateur' : 'Ajouter les informations de l\'administrateur' }}
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $administration->id ? route('administration.update', $administration->id) : route('administration.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($administration->id)
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $administration->id }}">
                                <input type="hidden" name="user_id" value="{{ $administration->user_id }}">
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="first_name" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ old('first_name', $administration->first_name) }}" required
                                            placeholder="Entrez le nom">
                                        @error('first_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="last_name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ old('last_name', $administration->last_name) }}" required
                                            placeholder="Entrez le prénom">
                                        @error('last_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $administration->email) }}" required
                                            placeholder="Entrez l'email">
                                        @error('email')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone', $administration->phone) }}" required
                                            placeholder="Entrez le téléphone">
                                        @error('phone')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address', $administration->address) }}" required
                                            placeholder="Entrez l'adresse">
                                        @error('address')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="avatar" class="form-label">Photo</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar"
                                            value="{{ old('avatar', $administration->avatar) }}"
                                            placeholder="Ajouter une photo">
                                        @error('avatar')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- role --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="">Selectionnez le role</option>
                                            <option value="admin"
                                                {{ old('role', $administration->role) == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="consellor"
                                                {{ old('role', $administration->role) == 'consellor' ? 'selected' : '' }}>
                                                Conseiller</option>
                                            <option value="secretaire"
                                                {{ old('role', $administration->role) == 'secretaire' ? 'selected' : '' }}>
                                                Secretaire</option>
                                            <option value="comptable"
                                                {{ old('role', $administration->role) == 'comptable' ? 'selected' : '' }}>
                                                Comptable</option>
                                        </select>
                                        @error('role')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                {{-- responsability --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="responsability" class="form-label">Responsabilité</label>
                                        <textarea class="form-control" id="responsability" name="responsability" required
                                            placeholder="Entrez la responsabilité">{{ old('responsability', $administration->responsability) }}</textarea>
                                        @error('responsability')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- genre --}}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="">Selectionnez le genre</option>
                                            <option value="M" {{ $administration->gender == 'M' ? 'selected' : '' }}>
                                                Masculin</option>
                                            <option value="F" {{ $administration->gender == 'F' ? 'selected' : '' }}>
                                                Feminin</option>
                                        </select>
                                        @error('gender')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around gap-2 mb-3">
                                <button type="submit"
                                    class="btn btn-primary">{{ $administration->id ? 'Modifier' : 'Ajouter' }}</button>
                                <a href="{{ route('administration.index') }}" class="btn btn-danger">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //phone : prefix ex: +225 00 00 00 00 00 .. possible to limit to 8 at 10
            $('#phone').mask('+225 00 00 00 00 00', {
                translation: {
                    '0': {
                        pattern: /[0-9]/
                    }
                },
                placeholder: '+225 00 00 00 00 00'
            });
            $('#role').select2({
                placeholder: 'Selectionnez le role'
            });

            $('#gender').select2({
                placeholder: 'Selectionnez le genre'
            });


        });
    </script>
@endpush
