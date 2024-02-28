<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarInscriptionRequest extends FormRequest
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
            'etudiant_id' => 'required|exists:etudiants,id',
            'trajet_id' => 'required|exists:trajets,id',
            'is_paid' => 'required|boolean',
            'versements' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
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
            'etudiant_id.required' => 'L\'id de l\'étudiant est obligatoire',
            'etudiant_id.exists' => 'L\'id de l\'étudiant n\'existe pas',
            'trajet_id.required' => 'L\'id du trajet est obligatoire',
            'trajet_id.exists' => 'L\'id du trajet n\'existe pas',
            'is_paid.required' => 'Le statut de paiement est obligatoire',
            'versements.required' => 'Les versements sont obligatoires',
            'versements.numeric' => 'Les versements doivent être des nombres',
            'versements.min' => 'Les versements doivent être supérieurs à 0',
            'total_amount.required' => 'Le montant total est obligatoire',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
        ];
    }

    //before validation
    public function prepareForValidation()
    {
        $this->merge([
            'etudiant_id' => (int)$this->etudiant_id,
            'trajet_id' => (int)$this->trajet_id,
            'is_paid' =>  $this->has('is_paid') ? (bool)$this->is_paid : false,
            'versements' => (array)$this->versements,
            'total_amount' => (float)$this->total_amount,
            'annee_scolaire' => AnneeScolaire::where('status', 'en_cours')->first()->annee_scolaire,
        ]);
    }

}
