<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnneeScolaireRequest extends FormRequest
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
            'annee_scolaire' => 'required|string|unique:annee_scolaires',
            'debut' => 'required|date',
            'fin' => 'required|date|after:debut',
            'is_finish' => 'required|boolean',
            'status' => 'required|string',
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
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'debut.required' => 'La date de début est obligatoire',
            'fin.required' => 'La date de fin est obligatoire',
            'is_finish.required' => 'Veuillez préciser si l\'année est terminée',
            'status.required' => 'Le statut est obligatoire',
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
            'annee_scolaire' => 'année scolaire',
            'debut' => 'date de début',
            'fin' => 'date de fin',
            'is_finish' => 'l\'année est la terminée',
            'status' => 'statut',
        ];
    }


    protected function prepareForValidation()
    {

        $this->merge([
            'annee_scolaire' => strtoupper($this->annee_scolaire),
            'is_finish' => $this->is_finish ?? false,
        ]);
    }


}
