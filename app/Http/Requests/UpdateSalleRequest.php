<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalleRequest extends FormRequest
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
            'id' => 'required|integer|exists:salles,id', // 'id' is required, must be an integer and must exist in the 'salles' table
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'is_available' => 'required|boolean',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
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
            'id.required' => 'L\'identifiant de la salle est obligatoire',
            'name.required' => 'Le nom de la salle est obligatoire',
            'name.string' => 'Le nom de la salle doit être une chaîne de caractères',
            'name.max' => 'Le nom de la salle ne peut pas dépasser 255 caractères',
            'capacity.required' => 'La capacité de la salle est obligatoire',
            'capacity.integer' => 'La capacité de la salle doit être un entier',
            'is_available.required' => 'La disponibilité de la salle est obligatoire',
            'is_available.boolean' => 'La disponibilité de la salle doit être un booléen',
            'type.required' => 'Le type de la salle est obligatoire',
            'type.string' => 'Le type de la salle doit être une chaîne de caractères',
            'type.max' => 'Le type de la salle ne peut pas dépasser 255 caractères',
            'location.required' => 'L\'emplacement de la salle est obligatoire',
            'location.string' => 'L\'emplacement de la salle doit être une chaîne de caractères',
            'location.max' => 'L\'emplacement de la salle ne peut pas dépasser 255 caractères',
        ];
    }
}
