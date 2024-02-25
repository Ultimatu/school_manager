<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AccountActivatedMail;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les données fournies ne corresponde à aucune de nos informations.',
        ])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }


    public function register()
    {
        $classes = Classe::all();
        $parents = Parents::all();
        return view('auth.register', compact('classes', 'parents'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'address' => 'required|string|max:255',
            'classe_id' => 'required|integer',
            'student_mat' => 'required|string|max:255|unique:etudiants',
            'card_id' => 'required|string|max:255|unique:etudiants',
            'urgent_phone' => 'required|string|max:255',
            'cin'=> 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nationality' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'parent_first_name' => 'required|string|max:255',
            'parent_last_name' => 'required|string|max:255',
            'parent_email' => 'required|string|email|max:255|unique:users',
            'parent_phone' => 'required|string|max:255|unique:users',
            'parent_address' => 'required|string|max:255',
            'parent_type' => 'required|string|max:255',
            'parent_is_legal_tutor' => 'required|boolean',
            'parent_profession' => 'required|string|max:255',
            'parent_status' => 'required|string|max:255',

        ]);

        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();
        if ($user){
            $etudiant = Etudiant::where('email', $request->email)->orWhere('phone', $request->phone)->first();
            if ($etudiant->status === 'is_active'){
                return back()->withErrors([
                    'email' => 'Cet email est déjà utilisé',
                    'phone' => 'Ce numéro de téléphone est déjà utilisé',
                ]);
            }
            return redirect()->route('account-pending')->with('success', 'Votre compte a été créé avec succès. Veuillez attendre la validation de votre compte par l\'administrateur');

        }

        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->student_mat);
        $user->role_auth = 'etudiant';
        $user->save();

        $etudiant = new Etudiant();
        $etudiant->first_name = $request->first_name;
        $etudiant->last_name = $request->last_name;
        $etudiant->email = $request->email;
        $etudiant->phone = $request->phone;
        $etudiant->address = $request->address;
        $etudiant->classe_id = $request->classe_id;
        $etudiant->student_mat = $request->student_mat;
        $etudiant->card_id = $request->card_id;
        $etudiant->urgent_phone = $request->urgent_phone;
        $etudiant->cin = $request->cin;
        $etudiant->birth_date = $request->birth_date;
        $etudiant->birth_place = $request->birth_place;
        $etudiant->nationality = $request->nationality;
        $etudiant->status = $request->status;
        $etudiant->user_id = $user->id;
        if ($request->hasFile('avatar')){
            $photo = $request->file('avatar');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('students'), $photo_name);
            $etudiant->avatar = $photo_name;

        }
        $etudiant->save();

        if ($request->has('parent_id')){
            $parent = Parents::find($request->parent_id);
            $parent->etudiants_ids = $parent->etudiants_ids . ';' . $etudiant->id;
            $parent->save();
        }else{
            $parent = new Parents();
            $parent->first_name = $request->parent_first_name;
            $parent->last_name = $request->parent_last_name;
            $parent->email = $request->parent_email;
            $parent->phone = $request->parent_phone;
            $parent->address = $request->parent_address;
            $parent->profession = $request->parent_profession;
            $parent->etudiants_ids = $etudiant->id;
            $parent->type = $request->parent_type;
            $parent->is_legal_tutor = $request->parent_is_legal_tutor;
            $parent->status = $request->parent_status;

            $user = new User();
            $user->name = $request->parent_first_name . ' ' . $request->parent_last_name;
            $user->email = $request->parent_email;
            $user->phone = $request->parent_phone;
            $user->password = bcrypt($request->parent_phone);
            $user->role_auth = 'parent';
            $user->save();

            $parent->user_id = $user->id;
            $parent->save();

            return redirect()->route('account-pending')->with('success', 'Votre compte a été créé avec succès. Veuillez attendre la validation de votre compte par l\'administrateur');
        }

        return redirect()->route('account-pending')->with('success', 'Votre compte a été créé avec succès. Veuillez attendre la validation de votre compte par l\'administrateur');
    }


    public function accountPending()
    {
        return view('auth.account-pending');
    }

    public function activateAccount(Request $request)
    {
        $etudiant = Etudiant::find($request->etudiant_id);
        $etudiant->status = 'is_active';
        $etudiant->save();

        $parent = Parents::find($request->parent_id);
        $parent->status = 'is_active';
        $parent->save();

        if (env('MAIL_SERVICE_STATE' === 'on')){
            $etudiant->user->notify(new AccountActivatedMail('etudiant', $etudiant));
            $parent->user->notify(new AccountActivatedMail('parent', $parent));
        }

        return redirect()->route('account-askings.index')->with('success', 'Compte activé avec succès');
    }


    public function resetPassword()
    {
        return view('auth.reset-password');
    }
}
