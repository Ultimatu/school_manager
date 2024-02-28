<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Http\Requests\StoreAdministrationRequest;
use App\Http\Requests\UpdateAdministrationRequest;
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
        $user = User::create([
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'role_auth'=>$request->role,
            'password'=>Hash::make($request->phone)
        ]);

        $request->merge([
            'user_id'=>$user->id,
            'status'=>1,
            'password'=>Hash::make($request->phone),
        ]);
        $admin = Administration::create($request->all());

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
        $user = User::find($administration->user_id);
        $user->update([
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'role_auth'=>$request->role,
            'permissions'=>Role::getAbilities($request->role)
        ]);
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file->move('administraions', $name);
            $request->merge([
                'avatar'=>$name,
            ]);
        }
        $request->merge([
            'password'=>Hash::make($request->phone),
        ]);
        $administration->update($request->all());

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
