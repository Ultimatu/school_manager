<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Http\Requests\StoreAdministrationRequest;
use App\Http\Requests\UpdateAdministrationRequest;
use App\Mail\AccountActivatedMail;
use App\Models\Administration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('components.pages.administration.list', [
            'administrations' => Administration::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $administration = new Administration();
        return view('components.pages.administration.form', compact('administration'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdministrationRequest $request)
    {
        $request->validated();
        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();
        if ($user){
            return redirect()->back()->withInput()->with('error', 'Cet email/phone est déjà associé à un utilisateur');
        }
        $password = User::generatePassword();
        $user = User::create([
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'role_auth'=>$request->role,
            'password'=>\bcrypt($password),
        ]);

        $request->merge([
            'user_id'=>$user->id,
            'status'=>1,
            'password'=>\bcrypt($password),
        ]);
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file->move('images/administraions', $name);
            $request->merge([
                'avatar'=> "images/administraions/".$name,
            ]);
        }
        $admin = Administration::create($request->all());

        if (env('MAIL_SERVICE_STATE') === 'on'){
            $user->notify(new AccountActivatedMail('admin', $user, $password, "created"));
        }

        return redirect()->route('administration.index')->with('success', 'Administrateur ajouté avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Administration $administration)
    {
        return view('components.pages.administration.show', compact('administration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administration $administration)
    {
        return view('components.pages.administration.form', compact('administration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministrationRequest $request, Administration $administration)
    {
        $request->validated();
        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();
        if ($user && $user->id != $administration->user_id){
            return redirect()->back()->withInput()->with('error', 'Cet email/phone est déjà associé à un utilisateur');
        }
        //build password of 8 characters, maj, min, number
        $password = User::generatePassword();
        $user = User::find($administration->user_id);
        $user->update([
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'role_auth'=>$request->role,
            'permissions'=>Role::getAbilities($request->role),
            'password'=>\bcrypt($password)
        ]);
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file->move('images/administraions', $name);
            $request->merge([
                'avatar'=> "images/administraions/".$name,
            ]);
        }
        $request->merge([
            'password'=>\bcrypt($password),
        ]);
        $administration->update($request->all());

        if (env('MAIL_SERVICE_STATE') === 'on'){
            $user->notify(new AccountActivatedMail('admin', $user, $password, "updated"));
        }

        return redirect()->route('administration.index')->with('success', 'Administrateur modifié avec succès');
    }


    public function changeStatus($id)
    {
       //for api
       $administration = Administration::find($id);
       $administration->status = !$administration->status;
       $administration->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administration $administration)
    {
        $user = User::find($administration->user_id);
        $administration->delete();
        $user->delete();
        return redirect()->route('administration.index')->with('success', 'Administrateur supprimé avec succès');
    }
}
