<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEvaluationRequest extends FormRequest
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
            'duree' => 'required|string',
            'date' => 'required|date',
            'sujet' => 'required|string',
            'classe_cours_id' => 'required|exists:classe_cours,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'annee_scolaire'=>'required',
            'coffecient' => 'required|numeric',
            'max_note'=> 'required|numeric|min:10|max:20',
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
            'duree.required' => 'La durée est obligatoire',
            'duree.string' => 'La durée doit être une chaîne de caractères',
            'date.required' => 'La date est obligatoire',
            'date.date' => 'La date doit être une date',
            'sujet.required' => 'Le sujet est obligatoire',
            'sujet.string' => 'Le sujet doit être une chaîne de caractères',
            'classe_cours_id.required' => 'L\'id de la classe cours est obligatoire',
            'classe_cours_id.exists' => 'L\'id de la classe cours n\'existe pas',
            'professeur_id.required' => 'L\'id du professeur est obligatoire',
            'professeur_id.exists' => 'L\'id du professeur n\'existe pas',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'coffecient.required' => 'Le coefficient est obligatoire',
            'coffecient.numeric' => 'Le coefficient doit être un nombre',
            'coffecient.min' => 'Le coefficient doit être supérieur ou égal à 1',
            'coffecient.max' => 'Le coefficient doit être inférieur ou égal à 5',
            'max_note.required' => 'La note maximale est obligatoire',
            'max_note.numeric' => 'La note maximale doit être un nombre',
            'max_note.min' => 'La note maximale doit être supérieure ou égale à 10',
            'max_note.max' => 'La note maximale doit être inférieure ou égale à 20',
            'max_note.regex' =>  "L'evaluation doit être notée sur 10 ou 20 points, si vous voulez plus de 20 points, servez-vous des coefficients."
        ];
    }

     /**
      * Prepare the data for validation.
      */
    public function prepareForValidation(): void
    {
        $this->merge([
            'professeur_id' => (int)$this->professeur_id,
            'classe_cours_id' => (int)$this->classe_cours_id,
            'sujet' => (string)$this->sujet,
            'duree' => (string)$this->duree,
            'date' => $this->date,
            'annee_scolaire' => AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire,
            'coefficient' => (int)$this->coefficient,
        ]);
    }
}
