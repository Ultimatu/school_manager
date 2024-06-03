@switch(auth()->user()->role_auth)
    {{--  all data except email and password --}}
    @case('etudiant')
        <form action="{{ route('profile.update', ['key' => 'etudiant']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="first_name" class="bmd-label-floating">Nom</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="{{ auth()->user()->etudiant->first_name }}">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="last_name" class="bmd-label-floating">Prénom</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="{{ auth()->user()->etudiant->last_name }}">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="birth_date" class="bmd-label-floating">Date de naissance</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control"
                            value="{{ auth()->user()->etudiant->birth_date }}">
                        @error('birth_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group  bmd-form-group">
                        <label for="birth_place" class="bmd-label-floating">Lieu de naissance</label>
                        <input type="text" name="birth_place" id="birth_place" class="form-control"
                            value="{{ auth()->user()->etudiant->birth_place }}">
                        @error('birth_place')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="address" class="bmd-label-floating">Adresse</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ auth()->user()->etudiant->address }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="phone" class="bmd-label-floating">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ auth()->user()->etudiant->phone }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="urgent_phone" class="bmd-label-floating">Numéro de téléphone
                            d'urgence</label>
                        <input type="text" name="urgent_phone" id="urgent_phone" class="form-control"
                            value="{{ auth()->user()->etudiant->urgent_phone }}">
                        @error('urgent_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="cni" class="bmd-label-floating">Numéro de la carte nationale
                            d'identité</label>
                        <input type="text" name="cni" id="cni" class="form-control"
                            value="{{ auth()->user()->etudiant->cni }}">
                        @error('cni')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="card_id" class="bmd-label-floating">Numéro de la carte
                            étudiante</label>
                        <input type="text" name="card_id" id="card_id" class="form-control"
                            value="{{ auth()->user()->etudiant->card_id }}">
                        @error('card_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                   {{-- student_mat --}}
                    <div class="form-group bmd-form-group">
                        <label for="student_mat" class="bmd-label-floating">Matricule MENET</label>
                        <input type="text" name="student_mat" id="student_mat" class="form-control"
                            value="{{ auth()->user()->etudiant->student_mat }}">
                        @error('student_mat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="gender" class="form-label">Genre</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Selectionnez le genre</option>
                            <option value="M" {{ auth()->user()->etudiant->gender == 'M' ? 'selected' : '' }}>
                                Masculin</option>
                            <option value="F" {{ auth()->user()->etudiant->gender == 'F' ? 'selected' : '' }}>
                                Feminin</option>
                        </select>
                        @error('gender')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="nationality" class="bmd-label-floating">Nationalité</label>
                        <input type="text" name="nationality" id="nationality" class="form-control"
                            value="{{ auth()->user()->etudiant->nationality }}">
                        @error('nationality')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                        <label for="avatar" class="bmd-label-floating">Photo</label>
                        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                        @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-warning pull-right w-100">Modifier</button>
            <div class="clearfix"></div>
        </form>
    @break

    @case('professeur')
        <form action="{{ route('profile.update', ['key' => 'professeur']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="first_name" class="bmd-label-floating">Nom</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="{{ auth()->user()->professeur->first_name }}">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="last_name" class="bmd-label-floating">Prénom</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="{{ auth()->user()->professeur->last_name }}">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="address" class="bmd-label-floating">Adresse</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ auth()->user()->professeur->address }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="phone" class="bmd-label-floating">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ auth()->user()->professeur->phone }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="specialities" class="bmd-label-floating">Specialités</label>
                        <textarea name="specialities" id="specialities" class="form-control">{{ auth()->user()->professeur->specialities }}</textarea>
                        @error('specialities')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="avatar" class="bmd-label-floating">Photo</label>
                        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                        @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="gender" class="form-label">Genre</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Selectionnez le genre</option>
                            <option value="M" {{ auth()->user()->professeur->gender == 'M' ? 'selected' : '' }}>
                                Masculin</option>
                            <option value="F" {{ auth()->user()->professeur->gender == 'F' ? 'selected' : '' }}>
                                Feminin</option>
                        </select>
                        @error('gender')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-warning pull-right w-100">Modifier</button>
            <div class="clearfix"></div>
        </form>
    @break

    @case('parent')
        {{-- 
        'first_name',
        'last_name',
        'phone',
        'address',
        'profession',
        'type', --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group bmd-form-group">
                    <label for="first_name" class="bmd-label-floating">Nom</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        value="{{ auth()->user()->parent->first_name }}">
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group bmd-form-group">
                    <label for="last_name" class="bmd-label-floating">Prénom</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        value="{{ auth()->user()->parent->last_name }}">
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group bmd-form-group">
                    <label for="address" class="bmd-label-floating">Adresse</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ auth()->user()->parent->address }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group bmd-form-group">
                    <label for="phone" class="bmd-label-floating">Numéro de téléphone</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ auth()->user()->parent->phone }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group bmd-form-group">
                    <label for="profession" class="bmd-label-floating">Profession</label>
                    <textarea name="profession" id="profession" class="form-control">{{ auth()->user()->parent->profession }}</textarea>
                    @error('profession')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group bmd-form-group">
                    <label for="avatar" class="bmd-label-floating">Photo</label>
                    <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                    @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <div class="form-group bmd-form-group">
                    <label for="type" class="form-label">type de parent</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="">Selectionnez le type de parent</option>
                        <option value="pere" {{ auth()->user()->parent->type == 'pere' ? 'selected' : '' }}>
                            Pere</option>
                        <option value="mere" {{ auth()->user()->parent->type == 'mere' ? 'selected' : '' }}>
                            Mere</option>
                        <option value="tuteur" {{ auth()->user()->parent->type == 'tuteur' ? 'selected' : '' }}>
                            Tuteur</option>
                        <option value="autre" {{ auth()->user()->parent->type == 'autre' ? 'selected' : '' }}>
                            Autre</option>
                    </select>
                    @error('type')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-warning pull-right w-100">Modifier</button>
        <div class="clearfix"></div>
        </form>
    @break

    @default
        <form action="{{ route('profile.update', ['key' => 'administration']) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="first_name" class="bmd-label-floating">Nom</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="{{ auth()->user()->administration->first_name }}">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="last_name" class="bmd-label-floating">Prénom</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="{{ auth()->user()->administration->last_name }}">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="address" class="bmd-label-floating">Adresse</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ auth()->user()->administration->address }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="phone" class="bmd-label-floating">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ auth()->user()->administration->phone }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group">
                        <label for="avatar" class="bmd-label-floating">Photo</label>
                        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                        @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- gender select --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group bmd-form-group w-100">
                        <label for="gender" class="form-label">Genre</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="M" {{ auth()->user()->administration->gender == 'M' ? 'selected' : '' }}>
                                Masculin</option>
                            <option value="F" {{ auth()->user()->administration->gender == 'F' ? 'selected' : '' }}>
                                Feminin</option>
                        </select>
                        @error('gender')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-warning pull-right w-100">Modifier</button>
            <div class="clearfix"></div>
        </form>
@endswitch
