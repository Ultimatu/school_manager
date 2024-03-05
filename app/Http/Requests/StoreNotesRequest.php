<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class StoreNotesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isProfesseur();
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
            'evaluation_id' => 'required|exists:evaluations,id', // Add this line
            'note' => 'required|numeric',
            'observation' => 'nullable|string',
            'annee_scolaire'=> 'required|string'
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
            'evaluation_id.required' => 'L\'id de l\'évaluation est obligatoire', // Add this line
            'evaluation_id.exists' => 'L\'id de l\'évaluation n\'existe pas', // Add this line
            'note.required' => 'La note est obligatoire',
            'note.numeric' => 'La note doit être un nombre',
            'observation.string' => 'L\'observation doit être une chaîne de caractères',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'note' => (float)$this->note,
            'annee_scolaire' => AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire,
        ]);
    }
}
