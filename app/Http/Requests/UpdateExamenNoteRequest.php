<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamenNoteRequest extends FormRequest
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
            'id' => 'required|integer|exists:examen_notes,id',
            'etudiant_id' => 'required|integer|exists:etudiants,id',
            'examen_id' => 'required|integer|exists:examens,id',
            'note' => 'required|numeric|min:0|max:20',
            'annee_scolaire' => 'required|string|exists:examens,annee_scolaire|regex:/^\d{4}-\d{4}$/'
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
            'id.required' => 'La note est obligatoire',
            'id.integer' => 'La note doit être un entier',
            'id.exists' => 'La note n\'existe pas',
            'etudiant_id.required' => 'L\'étudiant est obligatoire',
            'etudiant_id.integer' => 'L\'étudiant doit être un entier',
            'etudiant_id.exists' => 'L\'étudiant n\'existe pas',
            'examen_id.required' => 'L\'examen est obligatoire',
            'examen_id.integer' => 'L\'examen doit être un entier',
            'examen_id.exists' => 'L\'examen n\'existe pas',
            'note.required' => 'La note est obligatoire',
            'note.numeric' => 'La note doit être un nombre',
            'note.min' => 'La note doit être supérieure ou égale à 0',
            'note.max' => 'La note doit être inférieure ou égale à 20',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'annee_scolaire.string' => 'L\'année scolaire doit être une chaine de caractères',
            'annee_scolaire.exists' => 'L\'année scolaire n\'existe pas',
            'annee_scolaire.regex' => 'L\'année scolaire doit être au format YYYY-YYYY'
        ];

    }



    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'annee_scolaire' => $this->examen->annee_scolaire
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
            'id' => 'note',
            'etudiant_id' => 'étudiant',
            'examen_id' => 'examen',
            'note' => 'note',
            'annee_scolaire' => 'année scolaire'
        ];
    }

}
