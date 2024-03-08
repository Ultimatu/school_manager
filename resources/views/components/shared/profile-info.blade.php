@if (auth()->user()->isEtudiant())
    <img src="{{ asset(auth()->user()->etudiant->avatar ?? 'users/avatar.png') }}" class="img-thumbnail" width="150"
        height="150" alt="">
    <p class="mb-3"><strong>Matricule:</strong> {{ auth()->user()->etudiant->student_mat }}
    </p>
    <p class="mb-3"><strong>Nom:</strong> {{ auth()->user()->etudiant->first_name }}</p>
    <p class="mb-3"><strong>Prénom:</strong> {{ auth()->user()->etudiant->last_name }}</p>
    <p class="mb-3"><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p class="mb-3"><strong>Sexe:</strong> {{ auth()->user()->etudiant->gender }}</p>
    <p class="mb-3"><strong>Date de naissance & lieu:</strong>
        {{ auth()->user()->etudiant->birth_date }} {{ auth()->user()->etudiant->birth_place }}
    </p>
    <p class="mb-3"><strong>Adresse:</strong> {{ auth()->user()->etudiant->address }}</p>
    <p class="mb-3"><strong>Numéro de téléphone:</strong>
        {{ auth()->user()->etudiant->phone }}</p>
    <p class="mb-3"><strong>Classe:</strong> {{ auth()->user()->etudiant->classe->name }}</p>
    <p class="mb-3"><strong>Année académique:</strong>
        {{ auth()->user()->etudiant->annee_scolaire }}</p>
    {{-- urgent_phone, cni, card_id(carte etudiante) --}}
    <p class="mb-3"><strong>Numéro de téléphone d'urgence:</strong>
        {{ auth()->user()->etudiant->urgent_phone }}</p>
    <p class="mb-3"><strong>Numéro de la carte nationale d'identité:</strong>
        {{ auth()->user()->etudiant->cni }}</p>
    <p class="mb-3"><strong>Numéro de la carte étudiante:</strong>
        {{ auth()->user()->etudiant->card_id }}</p>
@elseif (auth()->user()->isProfesseur())
    <img src="{{ asset(auth()->user()->professeur->avatar ?? 'users/avatar.png') }}" class="img-thumbnail"
        width="150" height="150" alt="">
    <p class="mb-3"><strong>Nom:</strong> {{ auth()->user()->professeur->first_name }}</p>
    <p class="mb-3"><strong>Prénom:</strong> {{ auth()->user()->professeur->last_name }}</p>
    <p class="mb-3"><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p class="mb-3"><strong>Sexe:</strong> {{ auth()->user()->professeur->gender }}</p>

    <p class="mb-3"><strong>Adresse:</strong> {{ auth()->user()->professeur->address }}</p>
    <p class="mb-3"><strong>Numéro de téléphone:</strong>
        {{ auth()->user()->professeur->phone }}</p>
    <p class="mb-3"><strong>Specialité:</strong>
        {{ auth()->user()->professeur->specialities }}</p>
@elseif (auth()->user()->isParent())
    <img src="{{ asset(auth()->user()->parent->avatar ?? 'users/avatar.png') }}" class="img-thumbnail" width="150"
        height="150" alt="">
    <p class="mb-3"><strong>Nom:</strong> {{ auth()->user()->parent->first_name }}</p>
    <p class="mb-3"><strong>Prénom:</strong> {{ auth()->user()->parent->last_name }}</p>
    <p class="mb-3"><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p class="mb-3"><strong>Adresse:</strong> {{ auth()->user()->parent->address }}
    </p>
    <p class="mb-3"><strong>Numéro de téléphone:</strong>
        {{ auth()->user()->parent->phone }}</p>
    <p class="mb-3"><strong>Profession:</strong>
        {{ auth()->user()->parent->profession }}</p>
    <p class="mb-3"><strong>Nombre d'enfants:</strong>
        {{ auth()->user()->parent->etudiants->count() }}</p>
@elseif (auth()->user()->administrations != null)
    <img src="{{ asset(auth()->user()->administration->avatar ?? 'users/avatar.png') }}" class="img-thumbnail"
        width="150" height="150" alt="">
    <p class="mb-3"><strong>Nom:</strong> {{ auth()->user()->administration->first_name }}
    </p>
    <p class="mb-3"><strong>Prénom:</strong> {{ auth()->user()->administration->last_name }}
    </p>
    <p class="mb-3"><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p class="mb-3"><strong>Sexe:</strong> {{ auth()->user()->administration->gender }}</p>
    <p class="mb-3"><strong>Adresse:</strong> {{ auth()->user()->administration->address }}
    </p>
    <p class="mb-3"><strong>Numéro de téléphone:</strong>
        {{ auth()->user()->administration->phone }}</p>
    <p class="mb-3"><strong>Role:</strong> {{ auth()->user()->administration->role }}</p>
    <p class="mb-3"><strong>Responsabilité:</strong>
        {{ auth()->user()->administration->responsability }}</p>
@endif
