<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('components.pages.profile.index');
    }



    /**
     * Changer le mode de passe 
     */
    public function changePassword(Request $request)
    {
        //validation and validation messages
        $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'old_password.required' => 'L\'ancien mot de passe est requis',
            'password.required' => 'Le nouveau mot de passe est requis',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.max' => 'Le mot de passe doit contenir au maximum 16 caractères',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre',
        ]);
        $checkEmail = $this->checkEmail($request->email);
        if (!$checkEmail) {
            return back()->with('error', 'Cet email est déjà associé à un autre compte');
        }

        //check if the old password is correct
        if (!\Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', 'L\'ancien mot de passe est incorrect');
        }

        //update the password
        auth()->user()->update(['password' => Hash::make($request->password), 'email' => $request->email]);
        if (auth()->user()->isEtudiant()) {
            auth()->user()->etudiant->update(['password' => Hash::make($request->password), 'email' => $request->email]);
        } elseif (auth()->user()->isProfesseur()) {
            auth()->user()->professeur->update(['password' => Hash::make($request->password), 'email' => $request->email]);
        } else {
            auth()->user()->administration->update(['password' => Hash::make($request->password), 'email' => $request->email]);
        }

        return back()->with('success', 'Le mot de passe et email mis à jours avec succès');
    }




   /**
    * Mettre à jour les informations de l'utilisateur
    * @param string $key
    * @param Request $request
    */
    public function update(Request $request, $key)
    {
        $user = auth()->user();

        // Définissez les règles de validation communes
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:4096',
        ];

        $checkPhone = $this->checkPhone($request->phone);
        if (!$checkPhone) {
            return back()->with('error', 'Ce numéro est déjà associé à un autre compte');
        }

        // Si l'utilisateur est un étudiant
        if ($key === "etudiant") {
            $rules['phone'] .= '|unique:etudiants,phone,' . $user->etudiant->id;
            $rules['student_mat'] = 'required|string|unique:etudiants,student_mat,' . $user->etudiant->id;
            $rules['card_id'] = 'nullable|string|unique:etudiants,card_id,' . $user->etudiant->id;
            $rules['birth_date'] = 'required|date';
            $rules['birth_place'] = 'required|string';
            $rules['cni'] = 'nullable|string|unique:etudiants,cni,' . $user->etudiant->id;
            $rules['urgent_phone'] = 'required|string|max:20|min:8';
            $rules['nationality'] = 'required|string';
        }
        // Si l'utilisateur est un professeur
        elseif ($key === "professeur") {
            $rules['phone'] .= '|unique:professeurs,phone,' . $user->professeur->id;
            $rules['specialities'] = 'required|string|max:255';
        }
        // Si l'utilisateur est un membre de l'administration
        else {
            $rules['phone'] .= '|unique:administrations,phone,' . $user->administration->id;
        }
        // Validation des données reçues
        $validatedData = $request->validate($rules);

        // Mise à jour des informations de l'utilisateur
        $model = $user->{$key};
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_name = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path("images/{$key}s"), $avatar_name);
            $model->update(['avatar' => "images/{$key}s/$avatar_name"]);
            $validatedData['avatar'] = "images/{$key}s/$avatar_name";
        }
        $model->fill($validatedData)->save();

        return back()->with('success', 'Les informations ont été mises à jour avec succès');
    }


    private function checkEmail($email): bool
    {
        if ($email === auth()->user()->email) {
            return true;
        }
        $user = User::where('email', $email)->first();
        if ($user) {
            return false;
        }
        return true;
    }

    private function checkPhone($phone): bool
    {
        if ($phone === auth()->user()->phone) {
            return true;
        }
        $user = User::where('phone', $phone)->first();
        if ($user) {
            return false;
        }
        return true;
    }




    // public function update(Request $request, $key)
    // {
    //     if ($key === "etudiant") {
    //         $request->validate([
    //             'first_name' => 'required|string',
    //             'last_name' => 'required|string',
    //             'phone' => 'required|string|max:15|unique:etudiants,phone,' . auth()->user()->etudiant->id,
    //             'address' => 'required|string',
    //             'student_mat' => 'required|string|unique:etudiants,student_mat,' . auth()->user()->etudiant->id,
    //             'card_id' => 'nullable|string|unique:etudiants,card_id,' . auth()->user()->etudiant->id,
    //             'birth_date' => 'required|date',
    //             'birth_place' => 'required|string',
    //             'cni' => 'nullable|string|unique:etudiants,cni,' . auth()->user()->etudiant->id,
    //             'urgent_phone' => 'required|string|max:20|min:8',
    //             'gender' => 'required|string',
    //             'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //             'nationality' => 'required|string',
    //         ], [
    //             'first_name.required' => 'Le prénom est requis',
    //             'last_name.required' => 'Le nom est requis',
    //             'phone.required' => 'Le numéro de téléphone est requis',
    //             'address.required' => 'L\'adresse est requise',
    //             'student_mat.required' => 'La matricule est requise',
    //             'student_mat.unique' => 'La matricule est déjà utilisée',
    //             'card_id.unique' => 'La carte d\'identité est déjà utilisée',
    //             'birth_date.required' => 'La date de naissance est requise',
    //             'birth_date.date' => 'La date de naissance est invalide',
    //             'birth_place.required' => 'Le lieu de naissance est requis',
    //             'cni.unique' => 'La CNI est déjà utilisée',
    //             'urgent_phone.required' => 'Le numéro de téléphone d\'urgence est requis',
    //             'urgent_phone.max' => 'Le numéro de téléphone d\'urgence est invalide',
    //             'urgent_phone.min' => 'Le numéro de téléphone d\'urgence est invalide',
    //             'phone.unique' => 'Le numéro de téléphone est déjà utilisé',
    //         ]);

    //         $checkPhone = $this->checkPhone($request->phone);
    //         if (!$checkPhone) {
    //             return back()->with('error', 'Ce numéro est déjà associé à un autre compte');
    //         }

    //         $etudiant = auth()->user()->etudiant;
    //         if ($request->hasFile('avatar')) {
    //             $avatar = $request->file('avatar');
    //             $avatar_name = time() . '.' . $avatar->getClientOriginalExtension();
    //             $avatar->move(public_path('images/etudiants'), $avatar_name);
    //             $etudiant->update(['avatar' => "images/etudiants/" . $avatar_name]);
    //         }
    //         $etudiant->last_name = $request->last_name;
    //         $etudiant->first_name = $request->first_name;
    //         $etudiant->phone = $request->phone;
    //         $etudiant->address = $request->address;
    //         $etudiant->student_mat = $request->student_mat;
    //         $etudiant->card_id = $request->card_id;
    //         $etudiant->birth_date = $request->birth_date;
    //         $etudiant->birth_place = $request->birth_place;
    //         $etudiant->cni = $request->cni;
    //         $etudiant->urgent_phone = $request->urgent_phone;
    //         $etudiant->gender = $request->gender;
    //         $etudiant->nationality = $request->nationality;
    //         $etudiant->save();
    //     } else if ($key === "professeur") {

    //         $request->validate([
    //             'first_name' => 'required|string|max:255',
    //             'last_name' => 'required|string|max:255',
    //             'phone' => 'required|string|max:15|unique:professeurs,phone,' . auth()->user()->professeur->id,
    //             'address' => 'required|string|max:255',
    //             'specialities' => 'required|string|max:255',
    //             'gender' => 'required|string|max:255',
    //             'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
    //         ], [
    //             'first_name.required' => 'Le prénom est requis',
    //             'last_name.required' => 'Le nom est requis',
    //             'phone.required' => 'Le numéro de téléphone est requis',
    //             'address.required' => 'L\'adresse est requise',
    //             'specialities.required' => 'Les spécialités sont requises',
    //             'gender.required' => 'Le genre est requis',
    //             'avatar.image' => 'Le fichier doit être une image',
    //             'avatar.mimes' => 'Le fichier doit être une image de type: jpeg, png, jpg, gif, svg',
    //             'avatar.max' => 'Le fichier ne doit pas dépasser 4 Mo',
    //             'phone.unique' => 'Le numéro de téléphone est déjà utilisé',
    //         ]);

    //         $checkPhone = $this->checkPhone($request->phone);
    //         if (!$checkPhone) {
    //             return back()->with('error', 'Ce numéro est déjà associé à un autre compte');
    //         }

    //         $professeur = auth()->user()->professeur;
    //         if ($request->hasFile('avatar')) {
    //             $avatar = $request->file('avatar');
    //             $avatar_name = time() . '.' . $avatar->getClientOriginalExtension();
    //             $avatar->move(public_path('images/professeurs'), $avatar_name);
    //             $professeur->update(['avatar' => "images/professeurs/" . $avatar_name]);
    //         }
    //         $professeur->first_name = $request->first_name;
    //         $professeur->last_name = $request->lastname;
    //         $professeur->address = $request->address;
    //         $professeur->phone = $request->phone;
    //         $professeur->specialities = $request->specialities;
    //         $professeur->gender = $request->gender;
    //         $professeur->save();
    //     } else {
    //         $request->validate([
    //             'first_name' => 'required|string|max:255',
    //             'last_name' => 'required|string|max:255',
    //             'phone' => 'required|string|max:15|unique:administrations,phone,' . auth()->user()->administration->id,
    //             'address' => 'required|string|max:255',
    //             'gender' => 'required|string|max:255',
    //             'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

    //         ], [
    //             'first_name.required' => 'Le prénom est requis',
    //             'last_name.required' => 'Le nom est requis',
    //             'phone.required' => 'Le numéro de téléphone est requis',
    //             'address.required' => 'L\'adresse est requise',
    //             'gender.required' => 'Le genre est requis',
    //             'avatar.image' => 'Le fichier doit être une image',
    //             'avatar.mimes' => 'Le fichier doit être une image de type: jpeg, png, jpg, gif, svg',
    //             'avatar.max' => 'Le fichier ne doit pas dépasser 4 Mo',
    //             'phone.unique' => 'Le numéro de téléphone est déjà utilisé',
    //         ]);
    //         $checkPhone = $this->checkPhone($request->phone);
    //         if (!$checkPhone) {
    //             return back()->with('error', 'Ce numéro est déjà associé à un autre compte');
    //         }

    //         $administration = auth()->user()->administration;
    //         if ($request->hasFile('avatar')) {
    //             $avatar = $request->file('avatar');
    //             $avatar_name = time() . '.' . $avatar->getClientOriginalExtension();
    //             $avatar->move(public_path('images/administrations'), $avatar_name);
    //             $administration->update(['avatar' => "images/administrations/" . $avatar_name]);
    //         }
    //         $administration->first_name = $request->first_name;
    //         $administration->last_name = $request->lastname;
    //         $administration->address = $request->address;
    //         $administration->phone = $request->phone;
    //         $administration->gender = $request->gender;

    //         $administration->save();
    //     }

    //     return back()->with('success', 'Les informations ont été mises à jour avec succès');
    // }


}
