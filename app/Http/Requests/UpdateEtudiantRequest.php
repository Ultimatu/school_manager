<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEtudiantRequest extends FormRequest
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
            'id'=>'required|integer|exists:etudiants,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => 'required|string|unique:users',
            'address' => 'required|string',
            'student_mat' => 'required|string|unique:etudiants',
            'classe_id' => 'required|integer|exists:classes,id',
            'annee_scolaire' => 'required|string',
            'card_id' => 'nullable|string|unique:etudiants',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'cni' => 'nullable|string|unique:etudiants',
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
            'id.required' => 'L\'id est obligatoire',
            'id.integer' => 'L\'id doit être un entier',
            'id.exists' => 'L\'id n\'existe pas',
            'first_name.required' => 'Le prénom est obligatoire',
            'last_name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'phone.required' => 'Le téléphone est obligatoire',
            'address.required' => 'L\'adresse est obligatoire',
            'student_mat.required' => 'La matricule est obligatoire',
            'classe_id.required' => 'La classe est obligatoire',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'birth_date.required' => 'La date de naissance est obligatoire',
            'birth_place.required' => 'Le lieu de naissance est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'urgent_phone.required' => 'Le téléphone d\'urgence est obligatoire',
            'amount.required' => 'Le montant de la scolarité est obligatoire',
            'is_paid.required' => 'Le statut de paiement est obligatoire',
            'versement_amount.required' => 'Le montant versé est obligatoire',
            'email.unique' => 'L\'email est déjà utilisé',
            'student_mat.unique' => 'La matricule est déjà utilisée',
            'card_id.unique' => 'La carte d\'identité est déjà utilisée',
            'cni.unique' => 'Le cni est déjà utilisé',
            'gender.required' => 'Le genre est obligatoire',
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
            'id' => 'id de l\'étudiant',
            'first_name' => 'prénom de l\'étudiant',
            'last_name' => 'nom de l\'étudiant',
            'email' => 'email de l\'étudiant',
            'phone' => 'téléphone de l\'étudiant',
            'address' => 'adresse de l\'étudiant',
            'student_mat' => 'matricule de l\'étudiant',
            'classe_id' => 'classe de l\'étudiant',
            'annee_scolaire' => 'année scolaire de l\'étudiant',
            'card_id' => 'carte d\'identité de l\'étudiant',
            'birth_date' => 'date de naissance de l\'étudiant',
            'birth_place' => 'lieu de naissance de l\'étudiant',
            'cni' => 'cni de l\'étudiant',
            'status' => 'statut de l\'étudiant',
            'urgent_phone' => 'téléphone d\'urgence de l\'étudiant',
            'amount' => 'montant de la scolarité',
            'is_paid' => 'statut de paiement',
            'versement_amount' => 'montant versé',
            'gender' => 'genre de l\'étudiant'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => (int)$this->id,
            'first_name' => ucfirst($this->first_name),
            'last_name' => ucfirst($this->last_name),
            'email' => strtolower($this->email),
            'phone' => $this->phone,
            'address' => ucfirst($this->address),
            'student_mat' => strtoupper($this->student_mat),
            'classe_id' => (int)$this->classe_id,
            'card_id' => $this->card_id,
            'birth_date' => $this->birth_date,
            'birth_place' => ucfirst($this->birth_place),
            'status' => $this->status,
            'urgent_phone' => $this->urgent_phone,
            'amount' => (float)$this->amount,
            'is_paid' => $this->amount >= $this->versement_amount ? true : false,
            'versement_amount' => (float)$this->versement_amount,
            'annee_scolaire' => AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire,
        ]);
    }


}
