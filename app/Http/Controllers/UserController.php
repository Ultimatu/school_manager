<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->isParent()){
            return view('parents.profile'); 
        }
        return view('components.pages.profile.index');
    }



    /**
     * Changer le mode de passe 
     */
    public function changePassword(Request $request)
    {
        //validation and validation messages
        $user = auth()->user();
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
        if (!password_verify($request->input('old_password'), $user->password)){
            return redirect()->back()->with('error', 'Mot de passe actuel incorrect');
        }

        //verifier que le nouveau mot de passe est different de l'ancien
        if (password_verify($request->input('password'), $user->password)){
            return redirect()->back()->with('error', 'Le nouveau mot de passe doit être différent de l\'ancien');
        }
        //update the password
        auth()->user()->update(['password' => bcrypt($request->input('password')), 'email' => $request->email]);
        if (auth()->user()->isEtudiant()) {
            auth()->user()->etudiant->update(['password' => bcrypt($request->input('password')), 'email' => $request->email]);
        } elseif (auth()->user()->isProfesseur()) {
            auth()->user()->professeur->update(['password' => bcrypt($request->input('password')), 'email' => $request->email]);
        } else {
            auth()->user()->administration->update(['password' => bcrypt($request->input('password')), 'email' => $request->email]);
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
            $rules['phone'] .= '|unique:etudiants,phone,' . $user->etudiant->id.'|unique:users,phone,' . $user->id;
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
            $rules['phone'] .= '|unique:professeurs,phone,' . $user->professeur->id.'|unique:users,phone,' . $user->id;
            $rules['specialities'] = 'required|string|max:255';
        }
        elseif($key === "parent"){
            $rules['phone'] .= '|unique:parents,phone,' . $user->parent->id.'|unique:users,phone,' . $user->id;
            $rules['profession'] = 'nullable|string|max:255';
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
}
