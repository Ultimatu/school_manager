<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class StoreEtudiantRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'address' => 'required|string',
            'student_mat' => 'required|string|unique:etudiants',
            'classe_id' => 'required|integer|exists:classes,id',
            'annee_scolaire' => 'required|string',
            'card_id' => 'nullable|string|unique:etudiants',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'cni' => 'nullable|string|unique:etudiants',
            //'user_id' => 'required|integer|exists:users,id',
            'status' => 'required|string',
            'urgent_phone' => 'required|string|max:20|min:8',
            'amount'=>'required|numeric|min:0',
            'is_paid'=>'required|boolean',
            'versement_amount'=>'required|numeric|min:0',
            'gender' => 'required|string'
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
            'email.required' => 'L\'email est obligatoire',
            'password.required' => 'Le mot de passe est obligatoire',
            'phone.required' => 'Le téléphone est obligatoire',
            'address.required' => 'L\'adresse est obligatoire',
            'student_mat.required' => 'La matricule est obligatoire',
            'classe_id.required' => 'La classe est obligatoire',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'card_id.required' => 'La carte d\'identité est obligatoire',
            'birth_date.required' => 'La date de naissance est obligatoire',
            'birth_place.required' => 'Le lieu de naissance est obligatoire',
            'cni.required' => 'Le numero cni est obligatoire',
            //'user_id.required' => 'L\'utilisateur est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'urgent_phone.required' => 'Le téléphone d\'urgence est obligatoire',
            'amount.required' => 'Le montant de la scolarité est obligatoire',
            'is_paid.required' => 'Le statut de paiement est obligatoire',
            'versement_amount.required' => 'Le montant versé est obligatoire',
            'gender.required' => 'Le sexe est obligatoire',
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
            'email' => 'email',
            'password' => 'mot de passe',
            'phone' => 'téléphone',
            'address' => 'adresse',
            'student_mat' => 'matricule',
            'classe_id' => 'classe',
            'annee_scolaire' => 'année scolaire',
            'card_id' => 'carte d\'identité',
            'birth_date' => 'date de naissance',
            'birth_place' => 'lieu de naissance',
            'cni' => 'Carte d\'identité nationale',
            'user_id' => 'utilisateur',
            'status' => 'statut',
            'urgent_phone' => 'téléphone d\'urgence',
            'amount' => 'montant de la scolarité',
            'is_paid' => 'statut de paiement',
            'versement_amount' => 'montant versé',
            'gender' => 'sexe',

        ];
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => ucfirst($this->first_name),
            'last_name' => ucfirst($this->last_name),
            'email' => strtolower($this->email),
            'address' => ucfirst($this->address),
            'birth_place' => ucfirst($this->birth_place),
            'annee_scolaire' => AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire,
            'status' => 'active',
            'is_paid' => (float)$this->amount <= (float)$this->versement_amount ? true : false,
        ]);
    }

}
