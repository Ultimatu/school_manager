<?php

namespace App\Http\Requests;

use App\Models\ClasseCours;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExamenRequest extends FormRequest
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
            'id' => 'required|integer|exists:examens,id', // 'id' => 'required|integer|exists:examens,id
            'classe_id' => 'required|integer|exists:classes,id',
            'salle_id' => 'required|integer|exists:salles,id',
            'classe_cours_id' => 'required|integer|exists:classe_cours,id',
            'day' => 'required|string',
            'professeur_id' => 'required|integer|exists:professeurs,id', // 'professeur_id' => 'required|integer|exists:professeurs,id',
            'start_date_time' => 'required|date|date_format:Y-m-d H:i:s|after:now',
            'end_date_time' => 'required|date|date_format:Y-m-d H:i:s|after:start_date_time',
            'annee_scolaire' => 'required|string'
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
            'id.required' => 'L\'examen est obligatoire',
            'id.integer' => 'L\'examen doit être un entier',
            'id.exists' => 'L\'examen n\'existe pas',
            'classe_id.required' => 'La classe est obligatoire',
            'classe_id.integer' => 'La classe doit être un entier',
            'classe_id.exists' => 'La classe n\'existe pas',
            'salle_id.required' => 'La salle est obligatoire',
            'salle_id.integer' => 'La salle doit être un entier',
            'salle_id.exists' => 'La salle n\'existe pas',
            'classe_cours_id.required' => 'Le cours est obligatoire',
            'classe_cours_id.integer' => 'Le cours doit être un entier',
            'classe_cours_id.exists' => 'Le cours n\'existe pas',
            'day.required' => 'Le jour est obligatoire',
            'start_date_time.required' => 'La date de début est obligatoire',
            'start_date_time.date' => 'La date de début doit être une date',
            'start_date_time.date_format' => 'La date de début doit être au format Y-m-d H:i',
            'start_date_time.after' => 'La date de début doit être après maintenant',
            'end_date_time.required' => 'La date de fin est obligatoire',
            'end_date_time.date' => 'La date de fin doit être une date',
            'end_date_time.date_format' => 'La date de fin doit être au format Y-m-d H:i',
            'end_date_time.after' => 'La date de fin doit être après la date de début',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'annee_scolaire.string' => 'L\'année scolaire doit être une chaine de caractères',
            'professeur_id.required' => 'L\'identifiant du professeur est obligatoire',
            'professeur_id.integer' => 'L\'identifiant du professeur doit être un entier',
            'professeur_id.exists' => 'L\'identifiant du professeur n\'existe pas',

        ];
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $classeCours = ClasseCours::find($this->classe_cours_id);
        $this->merge([
            'classe_id' => $classeCours->classe_id,
            'salle_id' => $this->salle_id,
            'classe_cours_id' => $this->classe_cours_id,
            'professeur_id' => $classeCours->professeur_id,
            'day' => $this->getDay($this->start_date_time),
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
            'annee_scolaire' => $this->annee_scolaire,
        ]);
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id' => 'examen',
            'classe_id' => 'classe',
            'salle_id' => 'salle',
            'classe_cours_id' => 'cours',
            'day' => 'jour',
            'start_date_time' => 'date de début',
            'end_date_time' => 'date de fin',
            'annee_scolaire' => 'année scolaire'
        ];
    }

    private function getDay($date){
        $days = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        return $days[date('w', strtotime($date))];
    }

}
