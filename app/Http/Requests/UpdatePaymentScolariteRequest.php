<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentScolariteRequest extends FormRequest
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
            'id' => 'required|integer|exists:payment_scolarites,id',
            'etudiant_id' => 'required|integer|exists:etudiants,id',
            'amount' => 'required|numeric|min:0',
            'is_paid' => 'required|boolean',
            'observation' => 'nullable|string',
            'annee_scolaire' => 'required|string',
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
            'etudiant_id.required' => 'L\'id de l\'étudiant est obligatoire',
            'etudiant_id.integer' => 'L\'id de l\'étudiant doit être un entier',
            'etudiant_id.exists' => 'L\'id de l\'étudiant n\'existe pas',
            'amount.required' => 'Le montant est obligatoire',
            'amount.numeric' => 'Le montant doit être un nombre',
            'amount.min' => 'Le montant doit être supérieur à 0',
            'is_paid.required' => 'Le statut de paiement est obligatoire',
            'is_paid.boolean' => 'Le statut de paiement doit être un booléen',
            'observation.string' => 'L\'observation doit être une chaîne de caractères',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
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
            'id'=> 'identifiant',
            'etudiant_id' => 'identifiant de l\'étudiant',
            'amount' => 'montant',
            'is_paid' => 'statut de paiement',
            'observation' => 'observation',
            'annee_scolaire' => 'année scolaire',
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'amount' => (float)$this->amount,
            'is_paid' =>  $this->has('is_paid') ? (bool)$this->is_paid : false,
            'annee_scolaire' => AnneeScolaire::where('status', 'en_cours')->first()->annee_scolaire,
        ]);
    }
}
