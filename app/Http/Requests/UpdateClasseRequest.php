<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClasseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:classes,id',
            'name' => 'required|string',
            'status' => 'required|string',
            'level' => 'required|string',
            'year' => 'required|string',
            'filiere_id' => 'required|integer|exists:filieres,id',
            'credits' => 'required|integer|max:60',
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
            'id.required' => 'L\'identifiant de la classe est obligatoire',
            'id.exists' => 'La classe n\'existe pas',
            'id.integer' => 'L\'identifiant de la classe doit être un entier',
            'name.required' => 'Le nom de la classe est obligatoire',
            'status.required' => 'Le status de la classe est obligatoire',
            'level.required' => 'Le niveau de la classe est obligatoire',
            'year.required' => 'L\'année de la classe est obligatoire',
            'filiere_id.required' => 'La filière de la classe est obligatoire',
            'credits.required' => 'Le nombre de crédits de la classe est obligatoire',
            'credits.max' => 'Le nombre de crédits de la classe ne peut pas dépasser 60',
            'filiere_id.exists' => 'La filière de la classe n\'existe pas',
            'filiere_id.integer' => 'La filière de la classe doit être un entier',
            'credits.integer' => 'Le nombre de crédits de la classe doit être un entier',
            'name.string' => 'Le nom de la classe doit être une chaîne de caractères',
            'status.string' => 'Le status de la classe doit être une chaîne de caractères',

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
            'id' => 'identifiant de la classe',
            'name' => 'nom de la classe',
            'status' => 'status de la classe',
            'level' => 'niveau de la classe',
            'year' => 'année de la classe',
            'filiere_id' => 'filière de la classe',
            'credits' => 'nombre de crédits de la classe',
        ];
    }
}
