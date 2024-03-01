<form action="{{ route('profile.change-password') }}" method="post">
    @csrf
    @method('PUT')
    <div class="row d-flex justify-content-center flex-column overflow-x-auto m-auto">
        <div class="col-md-12 mb-3">
            <div class="form-group  bmd-form-group">
                <label for="email" class="bmd-label-floating">Email</label>
                <input type="text" name="email" id="email" class="form-control" value={{ old('email', auth()->user()->email) }}>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="form-group  bmd-form-group">
                <label for="old_password" class="bmd-label-floating">Ancien mot de
                    passe</label>
                <input type="password" name="old_password" id="old_password" class="form-control" >
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="form-group bmd-form-group">
                <label for="password" class="bmd-label-floating">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" class="form-control"
                    title="8 caractères minimum, au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        {{-- password confirmation --}}
        <div class="col-md-12 mb-3">
            <div class="form-group  bmd-form-group">
                <label for="password_confirmation" class="bmd-label-floating">Confirmer le mot
                    de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6 mb-3">
            {{-- generate password button --}}
            <button type="button" class="btn btn-outline-primary w-100" id="generatePassword"
                title="Générer un mot de passe">Générer un mot de passe</button>
        </div>
        <button type="submit" class="btn btn-outline-danger pull-right w-100">Modifier</button>
        <div class="clearfix"></div>
    </div>
</form>
