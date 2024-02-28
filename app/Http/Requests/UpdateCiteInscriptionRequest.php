<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCiteInscriptionRequest extends FormRequest
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
            'id' => 'required|exists:cite_inscriptions,id', // 'id' => 'required|exists:cite_inscriptions,id
            'etudiant_id' => 'required|exists:etudiants,id',
            'chambre_id' => 'required|exists:chambres,id',
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
            'id.required' => 'L\'id de l\'inscription est obligatoire', // 'id.required' => 'L\'id de la chambre est requis',
            'etudiant_id.required' => 'L\'id de l\'étudiant est obligatoire',
            'etudiant_id.exists' => 'L\'id de l\'étudiant n\'existe pas',
            'chambre_id.required' => 'L\'id de la chambre est obligatoire',
            'chambre_id.exists' => 'L\'id de la chambre n\'existe pas',
            'is_paid.required' => 'Le statut de paiement est obligatoire',
            'versements.required' => 'Les versements sont obligatoires',
            'versements.numeric' => 'Les versements doivent être des nombres',
            'versements.min' => 'Les versements doivent être supérieurs à 0',
            'total_amount.required' => 'Le montant total est obligatoire',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'etudiant_id' => (int)$this->etudiant_id,
            'chambre_id' => (int)$this->chambre_id,
            'is_paid' =>  $this->has('is_paid') ? (bool)$this->is_paid : false,
            'versements' => (array)$this->versements,
            'total_amount' => (float)$this->total_amount,
            'annee_scolaire' => AnneeScolaire::where('status', 'en_cours')->first()->annee_scolaire,
        ]);
    }
}
