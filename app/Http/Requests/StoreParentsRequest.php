<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class StoreParentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'address' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'is_legal_tutor' => 'nullable|boolean',
            'status' => 'required|boolean',
            'etudiant_id' => 'required|exists:etudiants,id',
            'email' => 'nullable|email|unique:users',
            'type' => 'required|string|max:255',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Le prénom est obligatoire',
            'last_name.required' => 'Le nom est obligatoire',
            'phone.required' => 'Le numéro de téléphone est obligatoire',
            'email.unique' => 'L\'email est déjà utilisé',
            'email.email' => 'L\'email est invalide',
            'address.required' => 'L\'adresse est obligatoire',
            'profession.required' => 'La profession est obligatoire',
            'is_legal_tutor.required' => 'Le statut de tuteur légal est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'etudiant_id.required' => 'L\'étudiant est obligatoire',
            'type.required' => 'Le type est obligatoire'
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'prénom',
            'last_name' => 'nom',
            'phone' => 'numéro de téléphone',
            'address' => 'adresse',
            'profession' => 'profession',
            'is_legal_tutor' => 'statut de tuteur légal',
            'status' => 'statut',
            'etudiant_id' => 'étudiant',
            'type' => 'type de parent',
        ];
    }



    //before validation
    public function prepareForValidation()
    {
        $annneScolaire = AnneeScolaire::where('status', 'en cours')->first();

        $this->merge([
            'status' => $this->status = 1,
            'is_legal_tutor' => $this->has('is_legal_tutor') ? 1 : 0,
            'annee_scolaire' => $this->annee_scolaire = $annneScolaire->annee_scolaire,
        ]);
    }


}
