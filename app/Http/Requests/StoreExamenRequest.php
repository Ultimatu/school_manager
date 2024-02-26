<?php

namespace App\Http\Requests;

use App\Models\ClasseCours;
use Illuminate\Foundation\Http\FormRequest;

class StoreExamenRequest extends FormRequest
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
            'classe_id' => 'required|integer|exists:classes,id',
            'salle_id' => 'required|integer|exists:salles,id',
            'classe_cours_id' => 'required|integer|exists:classe_cours,id',
            'day' => 'required|string',
            'professeur_id' => 'required|integer|exists:professeurs,id',
            'start_date_time' => 'required|date|date_format:Y-m-d H:i|after:now',
            'end_date_time' => 'required|date|date_format:Y-m-d H:i|after:start_date_time',
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
            'professeur_id.required' => 'Le professeur est obligatoire',
            'professeur_id.integer' => 'Le professeur doit être un entier',
            'professeur_id.exists' => 'Le professeur n\'existe pas'

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
            'classe_id' => 'classe',
            'salle_id' => 'salle',
            'classe_cours_id' => 'cours',
            'professeur_id' => 'professeur',
            'day' => 'jour',
            'start_date_time' => 'date de début',
            'end_date_time' => 'date de fin',
            'annee_scolaire' => 'année scolaire'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $classeCours = ClasseCours::find($this->classe_cours_id);
        if ($classeCours === null) {
            return;
        }
        $year = date('Y');
        //si on est entre janvier et aout alors $annee_scolaire = year-1/year sinon $annee_scolaire = year/year+1
        $annee_scolaire = date('m') < 9 ? ($year - 1) . '-' . $year : $year . '-' . ($year + 1);
        $this->merge([
            'classe_id' => $classeCours->classe_id,
            'professeur_id' => $classeCours->professor_id,
            'salle_id' => $this->salle_id,
            'classe_cours_id' => $this->classe_cours_id,
            'day' => $this->day,
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
            'annee_scolaire' => $annee_scolaire
        ]);
    }
}
