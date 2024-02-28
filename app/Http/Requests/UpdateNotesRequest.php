<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNotesRequest extends FormRequest
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
            'classe_cours_id' => 'required|exists:classe_cours,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'note' => 'required|numeric',
            'observation' => 'nullable|string',
            'type' => 'required|string',
            'date' => 'required|date',
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
            'classe_cours_id.required' => 'L\'id de la classe_cours est obligatoire',
            'classe_cours_id.exists' => 'L\'id de la classe_cours n\'existe pas',
            'professeur_id.required' => 'L\'id du professeur est obligatoire',
            'professeur_id.exists' => 'L\'id du professeur n\'existe pas',
            'note.required' => 'La note est obligatoire',
            'note.numeric' => 'La note doit être un nombre',
            'observation.string' => 'L\'observation doit être une chaîne de caractères',
            'type.required' => 'Le type est obligatoire',
            'date.required' => 'La date est obligatoire',
            'date.date' => 'La date doit être une date',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'note' => (float)$this->note,
            'type' => (string)$this->type,
            'date' => (string)$this->date,
            'annee_scolaire' => AnneeScolaire::where('status', 'en_cours')->first()->annee_scolaire,
        ]);
    }
}
