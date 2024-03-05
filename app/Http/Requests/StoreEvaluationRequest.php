<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
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
            'professeur_id' => 'required|exists:professeurs,id',
            'classe_cours_id' => 'required|exists:classe_cours,id',
            'sujet' => 'required|string',
            'duree' => 'required|string',
            'date' => 'required|date',
            'annee_scolaire'=>'required',
            'coefficient' => 'required|numeric|min:1|max:5',
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
            'professeur_id.required' => 'L\'id du professeur est obligatoire',
            'professeur_id.exists' => 'L\'id du professeur n\'existe pas',
            'classe_cours_id.required' => 'L\'id de la classe cours est obligatoire',
            'classe_cours_id.exists' => 'L\'id de la classe cours n\'existe pas',
            'sujet.required' => 'Le sujet est obligatoire',
            'sujet.string' => 'Le sujet doit être une chaîne de caractères',
            'duree.required' => 'La durée est obligatoire',
            'duree.string' => 'La durée doit être une chaîne de caractères',
            'date.required' => 'La date est obligatoire',
            'date.string' => 'La date doit être une chaîne de caractères',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'coefficient.required' => 'Le coefficient est obligatoire',
            'coefficient.numeric' => 'Le coefficient doit être un nombre',
            'coefficient.min' => 'Le coefficient doit être supérieur ou égal à 1',
            'coefficient.max' => 'Le coefficient doit être inférieur ou égal à 5',
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
            'professeur_id' => $this->professeur_id,
            'classe_cours_id' => $this->classe_cours_id,
            'sujet' => $this->sujet,
            'duree' => $this->duree,
            'date' => $this->date,
            'annee_scolaire' => AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire,
            'coefficient' => (float)$this->coefficient,
            'max_note' => $this->max_note,
        ]);
    }
}
