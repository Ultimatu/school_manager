<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClasseCoursRequest extends FormRequest
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
            'cours_id' => 'required|integer|exists:cours,id',
            'professor_id' => 'required|integer|exists:professeurs,id',
            'semester' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_available' => 'required|boolean',
            'is_done' => 'required|boolean',
            'credit' => 'required|integer',
            'total_hours' => 'required|integer',
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
            'classe_id.required' => 'L\'identifiant de la classe est obligatoire',
            'classe_id.exists' => 'La classe n\'existe pas',
            'classe_id.integer' => 'L\'identifiant de la classe doit être un entier',
            'cours_id.required' => 'L\'identifiant du cours est obligatoire',
            'cours_id.exists' => 'Le cours n\'existe pas',
            'cours_id.integer' => 'L\'identifiant du cours doit être un entier',
            'professor_id.required' => 'L\'identifiant du professeur est obligatoire',
            'professor_id.exists' => 'Le professeur n\'existe pas',
            'professor_id.integer' => 'L\'identifiant du professeur doit être un entier',
            'semester.required' => 'Le semestre est obligatoire',
            'start_date.required' => 'La date de début est obligatoire',
            'end_date.required' => 'La date de fin est obligatoire',
            'is_available.required' => 'La disponibilité est obligatoire',
            'is_done.required' => 'L\'état est obligatoire',
            'credit.required' => 'Le nombre de crédits est obligatoire',
            'total_hours.required' => 'Le nombre d\'heures est obligatoire',
            'start_date.date' => 'La date de début doit être une date',
            'end_date.date' => 'La date de fin doit être une date',
            'is_available.boolean' => 'La disponibilité doit être un booléen',
            'is_done.boolean' => 'L\'état doit être un booléen',
            'credit.integer' => 'Le nombre de crédits doit être un entier',
            'total_hours.integer' => 'Le nombre d\'heures doit être un entier',
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
            'classe_id' => 'identifiant de la classe',
            'cours_id' => 'identifiant du cours',
            'professor_id' => 'identifiant du professeur',
            'semester' => 'semestre',
            'start_date' => 'date de début',
            'end_date' => 'date de fin',
            'is_available' => 'disponibilité',
            'is_done' => 'état',
            'credit' => 'nombre de crédits',
            'total_hours' => 'nombre d\'heures',
        ];
    }
}
